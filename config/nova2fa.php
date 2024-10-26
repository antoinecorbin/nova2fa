<?php


use Antoinecorbin\Nova2fa\Drivers\EmailFactorProvider;

return [
    'default' => 'email',
    'drivers' => [
        'email' => EmailFactorProvider::class,
    ],
    'code_expiration' => 10,
    'user_model' => env('NOVA_2FA_USER_MODEL', App\Models\User::class),
    'cache_driver' => env('NOVA_2FA_CACHE_DRIVER', 'file'),
    'notification_channel' => env('NOVA_2FA_NOTIFICATION_CHANNEL', 'mail'),
    'verification_route' => 'nova.2fa.verify',
];

