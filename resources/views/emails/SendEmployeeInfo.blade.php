@component('mail::message')
# Dear {{$data['user_firstName']}} {{$data['user_lastName']}}
# We are happy to support you
# Kindly check your info
# Your Info

Full name : {{$data['user_firstName']}} {{$data['user_lastName']}}<br>
Project : {{$data['project']}}<br>
Branch : {{$data['branch']}}<br>
email : {{$data['email']}}<br>


# Access Portal
Open URL : http://172.16.0.46/supportPortal/public

# Fisrt Login
Just put your email : {{$data['email']}} And click forgot below

Thanks,<br>
{{ config('app.name') }}
@endcomponent
