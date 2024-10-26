<?php

namespace Antoinecorbin\Nova2fa\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TwoFactorCodeNotification extends Notification
{
    public $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

    public function via($notifiable)
    {
        return [config('nova2fa.notification_channel', 'mail')];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Votre code de vérification en deux étapes')
            ->markdown('nova2fa::emails.code', ['code' => $this->code]);
    }
}
