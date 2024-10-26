<?php

namespace Antoinecorbin\Nova2fa\Repositories;

use Antoinecorbin\Nova2fa\Contracts\TwoFactorCodeRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class CacheTwoFactorCodeRepository implements TwoFactorCodeRepositoryInterface
{
    public function storeCode($userId, $code)
    {
        Cache::put("2fa_code_{$userId}", $code, now()->addMinutes(config('nova2fa.code_expiration')));
    }

    public function retrieveCode($userId): ?string
    {
        return Cache::get("2fa_code_{$userId}");
    }

    public function clearCode($userId): void
    {
        Cache::forget("2fa_code_{$userId}");
    }
}
