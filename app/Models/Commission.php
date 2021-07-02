<?php

namespace App\Models;

use App\Mail\Commission\Accepted;
use App\Mail\Commission\Archived;
use App\Mail\Commission\Canceled;
use App\Mail\Commission\Completed;
use App\Mail\Commission\Declined;
use App\Mail\Commission\Disputed;
use App\Mail\Commission\Failed;
use App\Mail\Commission\OverdueBuyer;
use App\Mail\Commission\OverdueCreator;
use App\Mail\Commission\Pending;
use App\Mail\Commission\Refunded;
use App\Mail\Commission\Resolved;
use App\Mail\Commission\Sent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Stripe\StripeClient;

class Commission extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
        'expires_at',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function statuses()
    {
        return [
            'Unpaid'=>'Unpaid',
            'Pending'=>'Pending',
            'Declined'=>'Declined',
            'Purchasing'=>'Purchasing',
            'Failed'=>'Failed',
            'Active'=>'Active',
            'Overdue'=>'Overdue',
            'Expired'=>'Expired',
            'Completed'=>'Completed',
            'Disputed'=>'Disputed',
            'Refunded'=>'Refunded',
            'Archived'=>'Archived',
        ];
    }
    public static function statusesCommissions()
    {
        return [
            'Pending'=>'Pending',
            'Active'=>'Active',
            'Overdue'=>'Overdue',
            'Expired'=>'Expired',
            'Completed'=>'Completed',
            'Disputed'=>'Disputed',
            'Refunded'=>'Refunded',
            'Archived'=>'Archived',
        ];
    }
    public static function statusPriorityCommissions()
    {
        return [
            'Overdue' => 0,
            'Active' => 1,
            'Pending' => 2,
            'Disputed' => 3,
            'Completed' => 4,
            'Archived' => 5,
            'Refunded' => 6,
            'Expired' => 7,
            'Purchasing' => 11,
            'Declined' => 11,
            'Unpaid' => 11,
            'Failed' => 11,
        ];
    }
    public static function statusPriorityOrders()
    {
        return [
            'Unpaid' => 0,
            'Failed' => 1,
            'Pending' => 2,
            'Overdue' => 3,
            'Active' => 4,
            'Disputed' => 5,
            'Completed' => 6,
            'Purchasing' => 7,
            'Archived' => 8,
            'Refunded' => 9,
            'Expired' => 10,
            'Declined' => 11
        ];
    }

    public function displayTitle()
    {
        return '[$' . $this->price . '] ' . $this->title;
    }
    public function getDisplayTitleAttribute()
    {
        return $this->displayTitle();
    }

    public function canView()
    {
        if (Gate::allows('manage-content')) {
            return true;
        }
        if (auth()->guest()) {
            return false;
        }
        if (!$this->isBuyer() && !$this->isCreator()) {
            return false;
        }

        return true;
    }
    public function canEdit()
    {
        if (Gate::allows('manage-content')) {
            return true;
        }
        if ($this->isCreator() && in_array($this->status, ['Active', 'Overdue'])) {
            return true;
        }
        return false;
    }
    public function isBuyer()
    {
        if (auth()->guest()) {
            return false;
        }
        return auth()->id() == $this->buyer_id;
    }
    public function isCreator()
    {
        if (auth()->guest()) {
            return false;
        }
        return auth()->id() == $this->creator_id;
    }
    public function partner()
    {
        return $this->isCreator()?$this->buyer:$this->creator;
    }
    public function getPartnerAttribute()
    {
        return $this->partner();
    }

    public function events(): HasMany
    {
        return $this->hasMany(CommissionEvent::class);
    }
    public function review()
    {
        return $this->hasOne(Review::class);
    }
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    public function preset(): BelongsTo
    {
        return $this->belongsTo(CommissionPreset::class, 'commission_preset_id');
    }
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'commission_id');
    }

    public function getSlug()
    {
        return Str::slug(($this->id??(Commission::count() + 1)) . '-' . $this->title);
    }
    public function getExpiresAtLocalAttribute()
    {
        return $this->expires_at->setTimezone('America/Chicago');
    }
    protected static function boot()
    {
        self::creating(function ($commission) {
            if ($commission->commission_preset_id != null) {
                $preset = $commission->preset;
                $commission->title = $preset->title;
                $commission->description = $preset->description;
                $commission->price = $preset->price;
                $commission->days_to_complete = $preset->days_to_complete;
            }
            $commission->slug = $commission->getSlug();
        });
        self::created(function ($commission) {
            $commission->slug = $commission->getSlug();
            CommissionEvent::create(
                [
                    'commission_id' => $commission->id,
                    'title' => 'Created Commission', 'color' => 'bg-gray-400', 'status' => 'Unpaid'
                ]
            );
        });
        self::factory(function ($commission) {
            $commission->slug = $commission->getSlug();
        });

        parent::boot();
    }
    public function decline()
    {
        // TODO: send notifications
        Mail::to($this->buyer->email)->queue(new Declined($this));
        $this->status = 'Declined';
        $this->save();
        CommissionEvent::create(
            [
                'commission_id' => $this->id,
                'title' => 'Declined by ' . $this->buyer->name, 'color' => 'bg-red-500', 'status' => 'Declined'
            ]
        );
        $stripe = new StripeClient(config('stripe.secret'));

        $invoice = $stripe->invoices->retrieve($this->invoice_id);
        if ($invoice->status == 'paid') {
            $stripe->refunds->create([
                'charge' => $invoice->charge,
            ]);
        } else {
            $stripe->invoices->delete($invoice->id);
        }
    }
    public function accept()
    {
        // TODO: send notifications
        Mail::to($this->buyer->email)->queue(new Accepted($this));
        $this->status = 'Purchasing';
        $this->expires_at = now()->addDays($this->days_to_complete);
        $this->save();
        CommissionEvent::create(
            [
                'commission_id' => $this->id,
                'title' => 'Accepted by ' . $this->creator->name, 'color' => 'bg-green-500', 'status' => 'Active'
            ]
        );
        $stripe = new StripeClient(config('stripe.secret'));
        $stripe->invoices->finalizeInvoice(
            $this->invoice_id
        );
        return $stripe->invoices->pay(
            $this->invoice_id,
            [
                'forgive' => 'false'
            ]
        );
    }

    public function fees()
    {
        $amount = $this->price * 100;
        $total = $amount + 30;
        $total += ceil(($this->price * config('commission.sales_tax')) * 100);
        return floatval($total - $amount) / 100;
    }
    public function getFeesAttribute()
    {
        return $this->fees();
    }
    public function total()
    {
        $amount = $this->price * 100;
        $total = $amount + 30;
        $total += ceil(($this->price * config('commission.sales_tax')) * 100);
        return floatval($total) / 100;
    }
    public function getTotalAttribute()
    {
        return $this->total();
    }


    public function attemptCharge($token = null)
    {
        if ($this->invoice_id) {
            return null;
        }

        $customer = $this->buyer->createOrGetStripeCustomer();
        $source = null;
        $stripe = new StripeClient(config('stripe.secret'));
        if ($token != null) {
            $source = $stripe->customers->createSource(
                $customer->id,
                [
                    'source' => $token,
                ]
            );
        }

        if ($this->buyer->hasPaymentMethod()) {
            try {
                $stripe->invoiceItems->create([
                    'customer' => $customer->id,
                    'description' => $this->displayTitle(),
                    'amount' => ($this->total * 100),
                    'currency' => 'usd'
                ]);
                $invoiceData = [
                    'customer' => $customer->id,
                    'collection_method' => 'charge_automatically',
                ];
                if ($source != null) {
                    $invoiceData['default_source'] = $source->id;
                }
                $invoice = $stripe->invoices->create($invoiceData);
                //$invoice = $this->buyer->invoiceFor($this->displayTitle(), $total);
                $this->invoice_id = $invoice->id;
                $this->status = 'Pending';
                $this->save();
                Mail::to($this->buyer->email)->queue(new Sent($this));
                Mail::to($this->creator->email)->queue(new Pending($this));
                return $invoice;
            } catch (\Exception $e) {
                return $e;
            }
        }
        return null;
    }
    // For testing only, verification handled by webhooks.
    public function checkInvoiceStatus()
    {
//        if ($this->invoice_id == null) {
//            return $this->chargeFail();
//        }
        $stripe = new \Stripe\StripeClient(
            config('stripe.secret'),
        );
        $invoice = $stripe->invoices->retrieve(
            $this->invoice_id,
        );
        if ($invoice->status == 'paid') {
            $this->chargeSuccess();
        }
    }

    public function chargeSuccess()
    {
        // TODO: send notifications
        $this->status = 'Active';
        $this->save();

        CommissionEvent::create(
            [
                'commission_id' => $this->id,
                'title' => 'Commission paid', 'color' => 'bg-green-500', 'status' => 'Active'
            ]
        );
    }

    public function overdue()
    {
        // TODO: send notifications
        Mail::to($this->buyer->email)->queue(new OverdueBuyer($this));
        Mail::to($this->creator->email)->queue(new OverdueCreator($this));
        $this->status = 'Overdue';
        $this->save();

        CommissionEvent::create(
            [
                'commission_id' => $this->id,
                'title' => 'Commission passed due date', 'color' => 'bg-yellow-500', 'status' => 'Overdue'
            ]
        );
    }

    public function chargeFail()
    {
        $this->status = 'Failed';
        $this->invoice_id = null;
        $this->save();
        // TODO: send notifications
        Mail::to($this->buyer->email)->queue(new Failed($this));

        CommissionEvent::create(
            [
                'commission_id' => $this->id,
                'title' => 'Payment failed', 'color' => 'bg-red-500', 'status' => 'Failed'
            ]
        );
    }

    public function complete()
    {
        $this->status = 'Completed';
        $this->save();

        Mail::to($this->buyer->email)->queue(new Completed($this));
        // TODO: send notifications
        CommissionEvent::create(
            [
                'commission_id' => $this->id,
                'title' => 'Order completed', 'color' => 'bg-sky-500', 'status' => 'Completed'
            ]
        );
    }
    public function dispute()
    {
        $this->status = 'Disputed';
        $this->save();
        // TODO: send notifications
        Mail::to($this->creator->email)->queue(new Disputed($this));
        CommissionEvent::create(
            [
                'commission_id' => $this->id,
                'title' => 'Disputed by ' . $this->buyer->name, 'color' => 'bg-red-500', 'status' => 'Disputed'
            ]
        );
    }

//    public function cancel()
//    {
//        // TODO: send emails and notifications
//        $this->status = 'Canceled';
//        $this->save();
//        $stripe = new StripeClient(config('stripe.secret'));
//        $invoice = $stripe->invoices->retrieve($this->invoice_id, ['expand' => ['charge']]);
//        $stripe->refunds->create([
//            'charge' => $invoice->charge->id,
//            'reason' => 'requested_by_customer'
//        ]);
//
//        $this->creator->addStrike('Canceled commission');
//
//        CommissionEvent::create(
//            [
//                'commission_id' => $this->id,
//                'title' => 'Expired', 'color' => 'bg-red-500', 'status' => 'Canceled'
//            ]
//        );
//    }

    public function expire()
    {
        // TODO: send notifications
        Mail::to($this->creator->email)->queue(new Canceled($this));
        $this->status = 'Expired';
        $this->save();
        $stripe = new StripeClient(config('stripe.secret'));
        $invoice = $stripe->invoices->retrieve($this->invoice_id, ['expand' => ['charge']]);
        $stripe->refunds->create([
            'charge' => $invoice->charge,
            'reason' => 'requested_by_customer'
        ]);
        CommissionEvent::create(
            [
                'commission_id' => $this->id,
                'title' => 'Expired', 'color' => 'bg-red-500', 'status' => 'Expired'
            ]
        );
        foreach ($this->attachments as $attachment) {
            $attachment->delete();
        }
    }
    public function refund()
    {
        // TODO: send notifications
        Mail::to($this->buyer->email)->queue(new Refunded($this));
        Mail::to($this->creator->email)->queue(new Refunded($this));

        $this->status = 'Refunded';
        $this->save();
        $stripe = new StripeClient(config('stripe.secret'));
        $invoice = $stripe->invoices->retrieve($this->invoice_id, ['expand' => ['charge']]);
        $stripe->refunds->create([
            'charge' => $invoice->charge
        ]);
        CommissionEvent::create(
            [
                'commission_id' => $this->id,
                'title' => 'Order refunded', 'color' => 'bg-red-500', 'status' => 'Refunded'
            ]
        );
        foreach ($this->attachments as $attachment) {
            $attachment->delete();
        }
    }
    public function resolve()
    {
        // TODO: send notifications
        Mail::to($this->creator->email)->queue(new Resolved($this));
        Mail::to($this->buyer->email)->queue(new Resolved($this));
        CommissionEvent::create(
            [
                'commission_id' => $this->id,
                'title' => 'Dispute resolved', 'color' => 'bg-yellow-500', 'status' => 'Resolved'
            ]
        );
        $this->archive();
    }
    public function archive()
    {
        // TODO: send notifications to creator
        Mail::to($this->creator->email)->queue(new Archived($this));

        $this->status = 'Archived';
        $this->save();

        $stripe = new StripeClient(config('stripe.secret'));
        $invoice = $stripe->invoices->retrieve($this->invoice_id, ['expand' => ['charge']]);

        $transfer = $stripe->transfers->create(
            [
                'amount' => $this->price * 100,
                'currency' => 'usd',
                'source_transaction' => $invoice->charge->id,
                'destination' => $this->creator->stripe_account_id,
                'transfer_group' => $this->slug,
            ]
        );
        CommissionEvent::create(
            [
                'commission_id' => $this->id,
                'title' => 'Order archived', 'color' => 'bg-green-500', 'status' => 'Archived'
            ]
        );
    }
}
