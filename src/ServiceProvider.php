<?php

namespace Guysolamour\Administrable\Crudgenerator;

use Guysolamour\Administrable\Crudgenerator\Console\Commands\AppendCrudCommand;
use Guysolamour\Administrable\Crudgenerator\Console\Commands\InstallCrudCommand;
use Guysolamour\Administrable\Crudgenerator\Console\Commands\GenerateCrudCommand;
use Guysolamour\Administrable\Crudgenerator\Console\Commands\RollbackCrudCommand;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__ . '/../config/crudgenerator.php';

    const PACKAGE_PATH = __DIR__;

    public function boot()
    {
    }

    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCrudCommand::class,
                GenerateCrudCommand::class,
                AppendCrudCommand::class,
                RollbackCrudCommand::class,
            ]);
        }
    }
}
