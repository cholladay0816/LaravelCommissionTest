@component('mail::message')
# Order Canceled

Your order has been canceled.


No further actions need to be taken.

@component('mail::button', ['url' => route('commissions.show', $commission)])
    View Order
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
