<?php

namespace Guysolamour\Administrable\Crudgenerator;

use Illuminate\Support\Str;
use Guysolamour\Administrable\Crudgenerator\Console\Commands\AppendCrudCommand;
use Guysolamour\Administrable\Crudgenerator\Console\Commands\InstallCrudCommand;
use Guysolamour\Administrable\Crudgenerator\Console\Commands\GenerateCrudCommand;
use Guysolamour\Administrable\Crudgenerator\Console\Commands\RollbackCrudCommand;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
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

    public static function packagePath(string $path = ''): string
    {
        $path = Str::start($path, DIRECTORY_SEPARATOR);

        return __DIR__ . $path;
    }
}
