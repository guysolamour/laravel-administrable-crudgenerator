<?php

namespace Guysolamour\Administrable\Crudgenerator;

use Guysolamour\Administrable\Crudgenerator\Console\Commands\GenerateCrudCommand;
use Guysolamour\Administrable\Crudgenerator\Console\Commands\InstallCrudCommand;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__ . '/../config/crudgenerator.php';

    const PACKAGE_PATH = __DIR__;

    public function boot()
    {
        // $this->publishes([
        //     self::CONFIG_PATH => config_path('crudgenerator.php'),
        // ], 'config');
    }

    public function register()
    {
        // $this->mergeConfigFrom(
        //     self::CONFIG_PATH,
        //     'crudgenerator'
        // );

        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateCrudCommand::class,
                InstallCrudCommand::class,
            ]);
        }
    }
}
