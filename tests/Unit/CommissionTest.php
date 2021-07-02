<?php

namespace Tests\Unit;

use App\Models\Commission;
use App\Models\CommissionPreset;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Stripe\Exception\CardException;
use Tests\TestCase;

class CommissionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_commission_has_a_buyer()
    {
        $user = User::factory()->create();
        $commission = Commission::factory()->create(['buyer_id' => $user->id]);

        $this->assertEquals($commission->buyer->id, $user->id);
    }

    /** @test */
    public function a_commission_has_a_creator()
    {
        $user = User::factory()->create();
        $commission = Commission::factory()->create(['creator_id' => $user->id]);

        $this->assertEquals($commission->creator->id, $user->id);
    }

    /** @test */
    public function a_commission_has_a_preset()
    {
        $preset = CommissionPreset::factory()->create();
        $commission = Commission::factory()->create(['commission_preset_id' => $preset->id]);

        $this->assertEquals($commission->preset->id, $preset->id);
    }
    /** @test */
    public function a_commission_has_working_sales_tax()
    {
        $commission = Commission::factory()->create(['price' => 5]);

        $sales_tax = config('commission.sales_tax');
        $stripe_flat_fee = 0.3;

        // Multiply the commission price by the sales tax
        $expected_fee = $commission->price * (1 + $sales_tax);
        // Add the flat fee
        $expected_fee += $stripe_flat_fee;
        echo('Expecting a fee of $' . number_format($expected_fee, 2));

        $this->assertEquals($expected_fee, $commission->total());
    }

    /** @test */
    public function a_commission_can_have_a_null_preset()
    {
        $commission = Commission::factory()->create(['commission_preset_id' => null]);

        $this->assertEquals($commission->preset, null);
    }

    /** @test */
    public function a_commission_with_a_preset_does_not_need_duplicate_fields_assigned()
    {
        // Generates and assigns the preset to this commission, intentionally excluding vital data
        $preset = CommissionPreset::factory()->create();
        $commission = new Commission(
            [
                'buyer_id' => User::factory()->create()->id,
                'creator_id' => User::factory()->create()->id,
                'commission_preset_id' => $preset->id,
                'memo' => 'Test Memo'
            ]
        );
        // Stores the commission in the database
        $commission->save();

        // Asserts that each field was entered automatically by the preset.
        $this->assertEquals($commission->title, $preset->title);
        $this->assertEquals($commission->description, $preset->description);
        $this->assertEquals($commission->price, $preset->price);
        $this->assertEquals($commission->days_to_complete, $preset->days_to_complete);
    }

    /** @test */
    public function a_commission_can_be_paid_for()
    {
        // Create our buyer and seller
        $buyer = User::factory()->create();
        $seller = User::factory()->create();

        // Make the buyer a Stripe customer
        $buyer->createAsStripeCustomer();

        // Create the commission
        $commission = Commission::factory()->create([
            'buyer_id' => $buyer->id,
            'creator_id' => $seller->id,
            'status' => 'Unpaid'
        ]);
        // Initialize Stripe
        $stripe = new \Stripe\StripeClient(
            config('stripe.secret'),
        );
        // Create a payment method
        $paymentmethod = $stripe->paymentMethods->create([
            'type' => 'card',
            'card' => [
                'number' => '4242424242424242',
                'exp_month' => 2,
                'exp_year' => 2022,
                'cvc' => '123',
            ],
        ]);
        // Attach it to the customer
        $stripe->paymentMethods->attach(
            $paymentmethod->id,
            ['customer' => $buyer->stripe_id],
        );
        // Make this payment method their default
        $stripe->customers->update(
            $buyer->stripe_id,
            [
                'invoice_settings' => [
                    'default_payment_method' => $paymentmethod->id,
                ],
            ],
        );
        // Attempt to charge the customer with an invoice.
        $invoice = $commission->attemptCharge();

        $this->assertNotNull($invoice);

        // Assert the customer cannot be billed twice.
        $this->assertNull($commission->attemptCharge());

        // Check the commission to see if the invoice is paid.
        // TESTING ONLY, not live implementation.  Refer to CashierWebhookController.
        $commission->checkInvoiceStatus();

        // Assert the commission is Pending after being paid for.
        $this->assertEquals('Pending', $commission->status);
    }
    /** @test */
    public function a_commission_can_fail_payment()
    {
        // Create our buyer and seller
        $buyer = User::factory()->create();
        $seller = User::factory()->create();

        // Make the buyer a Stripe customer
        $buyer->createAsStripeCustomer();

        // Create the commission
        $commission = Commission::factory()->create([
            'buyer_id' => $buyer->id,
            'creator_id' => $seller->id,
            'status' => 'Unpaid'
        ]);
        // Initialize Stripe
        $stripe = new \Stripe\StripeClient(
            config('stripe.secret'),
        );
        // Create a payment method
        $paymentMethod = $stripe->paymentMethods->create([
            'type' => 'card',
            'card' => [
                'number' => '4000000000000341',
                'exp_month' => 2,
                'exp_year' => 2022,
                'cvc' => '123',
            ],
        ]);
        // Attach it to the customer
        $stripe->paymentMethods->attach(
            $paymentMethod->id,
            ['customer' => $buyer->stripe_id],
        );
        // Make this payment method their default
        $stripe->customers->update(
            $buyer->stripe_id,
            [
                'invoice_settings' => [
                    'default_payment_method' => $paymentMethod->id,
                ],
            ],
        );
        // Attempt to charge the customer with an invoice.
        $commission->attemptCharge();

        // We know this card will fail, so we expect an exception message.
        $this->expectException(CardException::class);

        // Finalize the invoice and charge the invalid card.
        $commission->accept();
    }
}
