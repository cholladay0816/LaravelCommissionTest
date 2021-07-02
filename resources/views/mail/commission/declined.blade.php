@component('mail::message')
# Order Declined

Your order has been declined by {{ $commission->creator->name }}.

Your card has not been charged.

@component('mail::button', ['url' => route('commissions.show', $commission)])
    View Order
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
