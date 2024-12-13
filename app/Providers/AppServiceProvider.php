<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind('path.public', function() {
            return realpath(base_path().'/../public_html');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // if(env('APP_ENV') == 'production') {
        //     \URL::forceScheme('https');
        // }
        // \Illuminate\Support\Facades\URL::forceScheme('https');
    }
}
