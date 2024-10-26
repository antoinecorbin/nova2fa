<?php

namespace Antoinecorbin\Nova2fa\Drivers;

use Antoinecorbin\Nova2fa\Contracts\TwoFactorCodeRepositoryInterface;
use Antoinecorbin\Nova2fa\Contracts\TwoFactorProviderInterface;
use Antoinecorbin\Nova2fa\Notifications\TwoFactorCodeNotification;
use Illuminate\Support\Facades\Notification;

class EmailFactorProvider implements TwoFactorProviderInterface
{
    protected TwoFactorCodeRepositoryInterface $codeRepository;

    public function __construct(TwoFactorCodeRepositoryInterface $codeRepository)
    {
        $this->codeRepository = $codeRepository;
    }

    public function sendCode($user): void
    {
        $code = rand(100000, 999999);
        $this->codeRepository->storeCode($user->id, $code);

        Notification::send($user, new TwoFactorCodeNotification($code));
    }

    public function verifyCode($user, string $code): bool
    {
        return $this->codeRepository->retrieveCode($user->id) === $code;
    }
}
