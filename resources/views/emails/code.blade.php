@component('mail::message')
  # Authentification à Deux Facteurs

  Bonjour,

  Utilisez le code suivant pour terminer votre connexion :

  @component('mail::panel')
    **{{ $code }}**
  @endcomponent

  Ce code expirera dans {{ config('nova2fa.code_expiration') }} minutes.

  Si vous n’avez pas demandé cette vérification, veuillez ignorer cet e-mail.

  Merci,<br>
  {{ config('app.name') }}
@endcomponent
