@component('mail::message')
# Order Sent

Your order has been submitted!
We sent your commission to {{ $commission->creator->name }}, and will keep you updated on its progress.

@component('mail::button', ['url' => route('commissions.show', $commission)])
View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
