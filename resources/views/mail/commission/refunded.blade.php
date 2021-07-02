@component('mail::message')
# Order Refunded

Your commission has been reviewed, and we found it necessary to refund the order.

No further actions need to be taken.


@component('mail::button', ['url' => route('commissions.show', $commission)])
    View Order
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
