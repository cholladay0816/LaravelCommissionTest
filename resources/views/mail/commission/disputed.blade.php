@component('mail::message')
# Order Disputed

Your commission has been disputed, and a third party will audit the transaction.

No further actions need to be taken.


@component('mail::button', ['url' => route('commissions.show', $commission)])
    View Order
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
