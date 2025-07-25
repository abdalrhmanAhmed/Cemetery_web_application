<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Cookie;


class AppServiceProvider extends ServiceProvider
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

        // if (env('APP_ENV') !== 'local') {
        //     URL::forceScheme('https');
        // }
        // تعديل `XSRF-TOKEN` ليكون HttpOnly
        Cookie::macro('createHttpOnlyXsrfToken', function () {
            return new SymfonyCookie('XSRF-TOKEN', csrf_token(), 0, '/', null, true, true, false, 'Strict');
        });
    }
}
