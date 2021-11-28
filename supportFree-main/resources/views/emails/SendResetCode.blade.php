@component('mail::message')
# Reset Password

We are glad you are here, let's hope you enjoy our App
in order to Reset Your Password
this is your reset code : {{$code}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
