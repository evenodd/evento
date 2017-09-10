@component('mail::message')

# Welcome to Evento!

Thanks for choosing us, click the link below to activate your account. 

@component('mail::button', ['url' => url('/verifyemail/'.$email_token), 'color' => 'blue'])

Activate Account

@endcomponent

If you did not register with us, no further action is required.

Regards,<br>{{ config('app.name') }}

@component('mail::subcopy')
If you’re having trouble clicking the "Activate Account" button, copy and paste the URL below
into your web browser: [{{ url('/verifyemail/' . $email_token) }}]({{ url('/verifyemail/' . $email_token) }})
@endcomponent

@endcomponent
