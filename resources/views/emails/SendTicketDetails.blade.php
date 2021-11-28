@component('mail::message')
# Ticket Details
Call No : {{$data['call_no']}}<br>
Title : {{$data['title']}}<br>
Description : {{$data['description']}}<br>
# Status : {{$data['status']}}<br>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
