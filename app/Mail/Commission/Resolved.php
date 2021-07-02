<?php

namespace App\Mail\Commission;

use App\Models\Commission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Resolved extends Mailable
{
    use Queueable, SerializesModels;

    public Commission $commission;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($commission)
    {
        $this->commission = $commission;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.commission.resolved', ['commission' => $this->commission])
            ->subject('Commission Resolved');
    }
}
