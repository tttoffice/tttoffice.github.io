@component('mail::message')
# Ticket Details Reply
Call No : {{$data['call_no']}}<br>
Reply : {{$data['reply']}}<br>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
