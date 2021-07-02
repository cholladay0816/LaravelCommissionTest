@component('mail::message')
# Order Complete

Congratulations, your order has been finalized!

${{ number_format($commission->price, 2) }} has been scheduled for payout to your account.

@component('mail::button', ['url' => route('commissions.show', $commission)])
    View Order
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
