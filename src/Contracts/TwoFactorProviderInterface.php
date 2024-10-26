<?php

namespace Antoinecorbin\Nova2fa\Contracts;

use Illuminate\Database\Eloquent\Model;

interface TwoFactorProviderInterface
{
    public function sendCode(Model $model): void;
    public function verifyCode(Model $model, string $code): bool;
}
