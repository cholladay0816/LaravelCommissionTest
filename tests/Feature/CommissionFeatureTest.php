<?php

namespace Tests\Feature;

use App\Models\Attachment;
use App\Models\Commission;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Cashier\Exceptions\PaymentFailure;
use phpseclib3\Crypt\Random;
use Stripe\Account;
use Stripe\Card;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use Tests\TestCase;

class CommissionFeatureTest extends TestCase
{
    /** @test */
    public function a_commission_can_be_created()
    {
        // Generate a buyer and seller
        [$buyer, $seller] = $this->createBuyerAndSeller();

        // Make a working commission
        $commission = Commission::factory()->make([
            'buyer_id'=>$buyer->id,
            'creator_id'=>$seller->id
        ]);
        $commission->memo = 'Test Memo';

        // As the buyer, visit the create commission page
        $this->actingAs($buyer)
            ->get(route('commissions.create', [$seller, $commission->preset]))
            ->assertOk();

        // As the buyer, submit a POST using the commission as form data.
        $res = $this->actingAs($buyer)
            ->post(
                route('commissions.store', [$seller, $commission->preset]),
                $commission->attributesToArray()
            )
            ->assertSessionHas(['success' => 'Commission created successfully']);

        // Grab a fresh copy of our commission
        $commission = Commission::where('memo', 'Test Memo')->firstOrFail();

        // Assert that we redirect back to the commission show page.
        $res->assertRedirect('/commissions/' . $commission->getSlug());
    }

    // TODO: test to make sure unauthorized users (logged in or otherwise) cannot view.
    /** @test */
    public function a_commission_cannot_be_viewed_by_guests()
    {
        $commission = Commission::factory()->create();
        $this->get(route('commissions.show', $commission))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function a_commission_cannot_be_viewed_by_third_parties()
    {
        $commission = Commission::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user)
            ->get(route('commissions.show', $commission))
            ->assertNotFound();
    }

    /** @test */
    public function a_commission_can_be_deleted()
    {
        [$buyer, $seller] = $this->createBuyerAndSeller();
        $commission = Commission::factory()->create([
            'buyer_id' => $buyer->id,
            'creator_id' => $seller->id,
            'status' => 'Unpaid'
        ]);
        $this->actingAs($buyer)
            ->delete(route('commissions.destroy', $commission->fresh()))
            ->assertSessionHas('success', 'Commission deleted')
            ->assertRedirect(route('commissions.orders'));

        $this->assertNull($commission->fresh());
    }

    /** @test */
    public function a_commission_can_be_declined()
    {
        [$buyer, $seller] = $this->createBuyerAndSeller();
        $commission = $this->getChargedCommission($buyer, $seller);
        $this->actingAs($seller)
            ->delete(route('commissions.destroy', $commission->fresh()))
            ->assertSessionHas('success', 'Commission declined')
            ->assertRedirect(route('commissions.index'));

        $this->assertEquals('Declined', $commission->fresh()->status);
    }

    /** @test */
    public function a_commission_can_be_accepted()
    {
        [$buyer, $seller] = $this->createBuyerAndSeller();
        $commission = $this->getChargedCommission($buyer, $seller);

        $this->actingAs($seller)
            ->put(route('commissions.update', $commission->fresh()))
            ->assertRedirect(route('commissions.show', $commission))
            ->assertSessionHas('success', 'Commission accepted');
        // Check the invoice is paid (test only, skips webhook)
        $commission->checkInvoiceStatus();

        $this->assertEquals('Active', $commission->fresh()->status);
    }

    /** @test */
    public function a_commission_can_not_be_completed_without_attachments()
    {
        [$buyer, $seller] = $this->createBuyerAndSeller();
        // Create an active commission
        $commission = Commission::factory()->create([
            'buyer_id' => $buyer->id,
            'creator_id' => $seller->id,
            'status' => 'Active'
        ]);
        // Attempt to complete the order
        $this->actingAs($seller)
            ->put(route('commissions.update', $commission->fresh()))
            // Assert that this attempt to complete the order failed, as we do not have an attachment.
            ->assertStatus(401);
    }

    /** @test */
    public function a_commission_can_be_completed()
    {
        [$buyer, $seller] = $this->createBuyerAndSeller();
        // Create an active commission
        $commission = $this->getChargedCommission($buyer, $seller);
        $commission->accept();
        $commission->checkInvoiceStatus();

        // Create an attachment, one is needed to complete the order
        Attachment::factory()->create([
            'commission_id' => $commission->id,
            'user_id' => $seller->id
        ]);
        // Put an update to cycle the commission into completion.
        $this->actingAs($seller)
            ->put(route('commissions.update', $commission->fresh()))
            // Assert the session contains a success field
            ->assertSessionHas('success', 'Commission completed')
            // Assert we are redirected back to the commission list
            ->assertRedirect(route('commissions.index'));

        // Assert that the commission is completed
        $this->assertEquals('Completed', $commission->fresh()->status);
    }

    /** @test */
    public function a_commission_can_be_disputed()
    {
        [$buyer, $seller] = $this->createBuyerAndSeller();
        $commission = $this->getChargedCommission($buyer, $seller);
        $commission->accept();
        $commission->checkInvoiceStatus();
        $commission->complete();

        $this->actingAs($buyer)
            ->delete(route('commissions.destroy', $commission->fresh()))
            ->assertSessionHas('success', 'Commission disputed')
            ->assertRedirect(route('commissions.orders'));

        $this->assertEquals('Disputed', $commission->fresh()->status);
    }

    /** @test */
    public function a_disputed_commission_can_be_resolved()
    {
        $this->seed(RoleSeeder::class);
        $admin = Role::where('title', 'Administrator')->first();
        $administrator = User::factory()->create();
        $admin->users()->attach($administrator->id);

        [$buyer, $seller] = $this->createBuyerAndSeller();
        $commission = $this->getChargedCommission($buyer, $seller);
        $commission->accept();
        $commission->checkInvoiceStatus();
        $commission->complete();
        $commission->dispute();
        $this->actingAs($administrator)
            ->put(route('commissions.update', $commission->fresh()));
        $this->assertEquals('Archived', $commission->fresh()->status);
    }

    /** @test */
    public function a_disputed_commission_can_be_refunded()
    {
        $this->seed(RoleSeeder::class);
        $admin = Role::where('title', 'Administrator')->firstOrCreate();
        $administrator = User::factory()->create();
        $admin->users()->attach($administrator->id);

        [$buyer, $seller] = $this->createBuyerAndSeller();
        $commission = $this->getChargedCommission($buyer, $seller);
        $commission->accept();
        $commission->checkInvoiceStatus();
        $commission->complete();
        $commission->dispute();

        $this->actingAs($administrator)
            ->delete(route('commissions.destroy', $commission->fresh()));

        $this->assertEquals('Refunded', $commission->fresh()->status);
    }

    /** @test */
    public function a_commission_can_be_expired()
    {
        [$buyer, $seller] = $this->createBuyerAndSeller();
        $commission = $this->getChargedCommission($buyer, $seller);
        $commission->accept();
        $commission->checkInvoiceStatus();

        // Make sure the commission is overdue
        $commission->expires_at = now()->addDays(-1);
        $commission->save();
        $this->actingAs($buyer)
            ->delete(route('commissions.destroy', $commission->fresh()))
            ->assertRedirect(route('commissions.orders'))
            ->assertSessionHas('success', 'Commission canceled');

        $this->assertEquals('Expired', $commission->fresh()->status);
    }

    /** @test */
    public function a_commission_can_be_archived()
    {
        [$buyer, $seller] = $this->createBuyerAndSeller();
        $commission = $this->getChargedCommission($buyer, $seller);
        $commission->accept();
        $commission->checkInvoiceStatus();
        $commission->complete();

        $res = $this->actingAs($buyer)
            ->put(route('commissions.update', $commission->fresh()));
        $res->assertSessionHas('success', 'Commission archived')
            ->assertRedirect(route('commissions.orders'));

        $this->assertEquals('Archived', $commission->fresh()->status);

        $stripe = new StripeClient(config('stripe.secret'));
        $balance = $stripe->balance->retrieve([], ['stripe_account' => $seller->stripe_account_id]);
        $this->assertEquals($commission->price * 100, $balance->pending[0]->amount);
    }
}
