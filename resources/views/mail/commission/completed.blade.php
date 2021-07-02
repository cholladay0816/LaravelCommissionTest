@component('mail::message')
# Order Complete

Congratulations, your order has been completed!

@component('mail::button', ['url' => route('commissions.show', $commission)])
    View Order
@endcomponent


All commissions have a {{ config('commission.days_to_archive') }} day review period before finalizing.
Please be sure to review your order and dispute any issues during this window.


Thanks,<br>
{{ config('app.name') }}
@endcomponent
