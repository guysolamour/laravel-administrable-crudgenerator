<?php

namespace Guysolamour\Administrable\Crudgenerator\Console\Traits;


use Illuminate\Support\Str;
use Guysolamour\Administrable\Crudgenerator\ServiceProvider;


trait CommandTrait
{

    public function getAppNamespace(): string
    {
        $namespace = \Illuminate\Container\Container::getInstance()->getNamespace();
        return rtrim($namespace, '\\');
    }


    public function getStubsPath(string $path = ''): string
    {
        $path = Str::start($path, '/');

        return $this->getPackagePath('/stubs' . $path);
    }


    public function getTemplatePath(string $path = ''): string
    {
        return $this->getStubsPath($path);
    }

    // public function getBasePath(string $path = ''): string
    // {
    //     $path = Str::start($path, '/');

    //     return get_template_path() . $path;
    // }

    public function getPackagePath(string $path = ''): string
    {
        $path = Str::start($path, '/');

        return dirname(ServiceProvider::PACKAGE_PATH) . $path;
    }

    // public function triggerError(string $error)
    // {
    //     throw new \Exception($error);
    // }

    public function getConfigurationYamlPath(): string
    {
        return base_path('administrable.yaml');
    }

    public function displayTitle(string $title): void
    {
        $this->info(PHP_EOL . "<========================================   {$title}   =========================================>" .  PHP_EOL);
    }

    public function displayResult(?bool $result, ?string $path): void
    {
        if ($result) {
            $this->info(PHP_EOL . '<------ File created at ' . $path . '------>' . PHP_EOL);
        } else {
            $this->info(PHP_EOL . "<========================================   {$path}   =========================================>" . PHP_EOL);
        }
    }

    public function isTheadminTheme(): bool
    {
        return $this->isTheme('theadmin');
    }

    public function isThemeKitTheme(): bool
    {
        return $this->isTheme('themekit');
    }

    public function isTheme(string $theme): bool
    {
        return $this->getTheme() === $theme;
    }

    public function getTheme(): string
    {
        return config('administrable.theme', 'themekit');
    }

    public function isAdminLteTheme(): bool
    {
        return $this->isTheme('adminlte');
    }

    public function isTablerTheme(): bool
    {
        return $this->isTheme('tabler');
    }

    // public function getRoutesStubsFolderPrefix(): string
    // {
    //     $prefix = $this->route_controller_callable_syntax ?? config('administrable.route_controller_callable_syntax', true);

    //     return $prefix ? 'new' :  'old';
    // }
}
