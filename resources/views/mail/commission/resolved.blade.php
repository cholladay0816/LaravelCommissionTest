@component('mail::message')
# Order Resolved

Your commission has been reviewed, and we found no reason to issue a refund for this order.

No further actions need to be taken.


@component('mail::button', ['url' => route('commissions.show', $commission)])
    View Order
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
