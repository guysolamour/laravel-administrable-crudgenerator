<?php

namespace Guysolamour\Administrable\Crudgenerator\Console\Traits;

use Illuminate\Support\Str;
use Guysolamour\Administrable\Crudgenerator\ServiceProvider;
use Guysolamour\Administrable\Console\CommandTrait as AdministrableCommandTrait;


trait CommandTrait
{
    use AdministrableCommandTrait;

    public function getStubsPath(string $path = ''): string
    {
        $path = Str::start($path, '/');

        return $this->getPackagePath('/stubs' . $path);
    }

    public function getTemplatePath(string $path = ''): string
    {
        return $this->getStubsPath($path);
    }

    public function getPackagePath(string $path = ''): string
    {
        $path = Str::start($path, '/');

        return dirname(ServiceProvider::packagePath()) . $path;
    }
}
