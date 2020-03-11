@component('mail::message')
# Footloose merchendise request placed

Hi {{ $name }}

Your Footloose merchandise request has been received properly. You have requested the following:
{{ $amount }}x {{ $item }}

We will let you know when we have this item for you!


Thanks,<br>
The Footloose PR committtee
@endcomponent
