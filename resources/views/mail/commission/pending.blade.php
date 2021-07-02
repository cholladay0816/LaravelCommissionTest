@component('mail::message')
# Order Sent

You've received a new commission from {{ $commission->buyer->name }}!

## {{ $commission->title }}
*{{ $commission->memo }}*

${{ number_format($commission->price, 2) }}

@component('mail::button', ['url' => route('commissions.show', $commission)])
View Order
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
