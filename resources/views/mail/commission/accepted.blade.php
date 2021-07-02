@component('mail::message')
# Order Accepted

Your order has been accepted!

Your commission has been approved, we'll keep you posted on the status of your order.


@component('mail::button', ['url' => route('commissions.show', $commission)])
    View Order
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
