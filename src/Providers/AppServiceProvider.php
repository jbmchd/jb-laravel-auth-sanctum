<?php

namespace JbSanctum\Providers;

use JbGlobal\Observers\UsuarioObserver;
use JbGlobal\Providers\AppServiceProvider as ProvidersAppServiceProvider;
use JbSanctum\Models\Usuario;

class AppServiceProvider extends ProvidersAppServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Usuario::observe(UsuarioObserver::class);
    }
}
