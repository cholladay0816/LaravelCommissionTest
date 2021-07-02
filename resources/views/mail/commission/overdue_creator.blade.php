@component('mail::message')
# Order Disputed

Your commission is now overdue.
Your client is now able to issue a refund, so be sure to reach out and keep them updated on your progress.

@component('mail::button', ['url' => route('commissions.show', $commission)])
    View Order
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
