<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DummyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //echo 'boot';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // echo 'register';
    }
}
