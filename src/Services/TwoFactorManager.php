<?php

namespace Antoinecorbin\Nova2fa\Services;

use Antoinecorbin\Nova2fa\Contracts\TwoFactorProviderInterface;
use Closure;
use Illuminate\Support\Manager;
use InvalidArgumentException;

class TwoFactorManager extends Manager
{
    public function getDefaultDriver()
    {
        return $this->config->get('nova2fa.default');
    }

    protected function createDriver($driver): TwoFactorProviderInterface
    {
        $driverClass = $this->config->get("nova2fa.drivers.{$driver}");

        if (is_string($driverClass) && class_exists($driverClass)) {
            return app()->make($driverClass);
        }

        throw new InvalidArgumentException("Driver [{$driver}] not supported.");
    }

    public function extend($driver, Closure $callback): void
    {
        $this->customCreators[$driver] = $callback;
    }
}
