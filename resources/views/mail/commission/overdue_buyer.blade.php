@component('mail::message')
# Order Disputed

Your commission is now overdue.  You may cancel the order and receive a full refund at any point.


@component('mail::button', ['url' => route('commissions.show', $commission)])
    View Order
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
