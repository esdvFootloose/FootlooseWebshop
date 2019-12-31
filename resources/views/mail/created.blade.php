@component('mail::message')
# Footloose merchendise order placed

Hi {{ $name }}

Your Footloose merchandise order has been received properly. You have ordered the following:
{{ $items }}

You can review your order here, as well as find the payment [link]({!! $order_link !!}). After payment you'll receive a mail confirming this.
{!! url($order_link) !!}


Thanks,<br>
The Footloose PR committtee
@endcomponent
