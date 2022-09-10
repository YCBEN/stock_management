@component('mail::message')
# Password Reset

Si votre email est correcte, vous trouverez un lien pour modifier.   

@component('mail::button', ['url' => '/home'])
Acceuil
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent
