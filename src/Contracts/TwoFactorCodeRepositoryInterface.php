<?php

namespace Antoinecorbin\Nova2fa\Contracts;

interface TwoFactorCodeRepositoryInterface
{
    public function storeCode($userId, $code);
    public function retrieveCode($userId): ?string;
    public function clearCode($userId): void;
}
