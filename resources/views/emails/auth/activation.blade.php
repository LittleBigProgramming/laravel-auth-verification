@component('mail::message')
# Welcome, please activate to account.

To get started we need you to activate your email. Please click the button below.

@component('mail::button', ['url' => route('auth.activate', [
    'token' => $user->activation_token,
    'email' => $user->email
    ])])
    Activate Now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
