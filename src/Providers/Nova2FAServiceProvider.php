<?php

namespace Antoinecorbin\Nova2fa\Providers;

use Antoinecorbin\Nova2fa\Contracts\TwoFactorCodeRepositoryInterface;
use Antoinecorbin\Nova2fa\Http\Middleware\RedirectIfTwoFactorVerified;
use Antoinecorbin\Nova2fa\Repositories\CacheTwoFactorCodeRepository;
use Antoinecorbin\Nova2fa\Services\TwoFactorManager;
use Illuminate\Support\ServiceProvider;

class Nova2FAServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TwoFactorCodeRepositoryInterface::class, CacheTwoFactorCodeRepository::class);
        $this->mergeConfigFrom(__DIR__.'/../../config/nova2fa.php', 'nova2fa');

        $this->app->singleton('nova2fa', function ($app) {
            return new TwoFactorManager($app);
        });
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'nova2fa');
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');

        $this->publishes([
            __DIR__.'/../../config/nova2fa.php' => config_path('nova2fa.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/nova2fa'),
        ], 'views');

        $this->app['router']->aliasMiddleware('2fa.redirect_if_verified', RedirectIfTwoFactorVerified::class);
    }
}
