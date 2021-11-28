@component('mail::message')
# Dear {{$data['user_firstName']}} {{$data['user_lastName']}} <br>

Kindly be informed that support ticket no ({{$data['call_no']}}) has been solved <br>

status : {{$data['status']}}<br>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
