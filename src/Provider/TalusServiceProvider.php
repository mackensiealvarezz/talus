<?php

namespace Mackensiealvarezz\Talus;

use illuminate\support\ServiceProvider;

class TalusServiceProvider extends ServiceProvider
{


    //when the application is loaded
    public function boot()
    {
        // publish a config file
        // $this->publishes([
        //     __DIR__ . '/../config/tdameritrade.php' => config_path('tdameritrade.php')
        // ]);
    }

    public function register()
    {
        // $this->app->singleton(Tdameritrade::class, function () {
        //     return new Tdameritrade();
        // });
    }
}
