<?php

namespace Mackensiealvarezz\Talus\Provider;

use illuminate\support\ServiceProvider;
use Mackensiealvarezz\Talus\Console\ConvertCommand;
use Mackensiealvarezz\Talus\Console\MakeCommand;
use Mackensiealvarezz\Talus\Console\MakeTaskCommand;
use Mackensiealvarezz\Talus\Talus;

class TalusServiceProvider extends ServiceProvider
{
    //when the application is loaded
    public function boot()
    {
    }

    public function register()
    {
        $this->app->singleton(Talus::class, function () {
            return new Talus();
        });
        $this->commands([
            MakeCommand::class,
            ConvertCommand::class,
            MakeTaskCommand::class
        ]);
    }
}
