@component('mail::message')
# Footloose merchendise order paid

Hi {{ $name }}

Your Footloose merchandise order has been paid. You have ordered the following:
{{ $items }}

You can make an appointment with the PR committee to pick up your order, or ask us at a dance evening.

Enjoy your order!
<br>
The Footloose PR committtee
@endcomponent
