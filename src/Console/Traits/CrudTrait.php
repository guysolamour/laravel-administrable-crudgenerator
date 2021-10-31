<?php

namespace Guysolamour\Administrable\Crudgenerator\Console\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Symfony\Component\Yaml\Yaml;
use Guysolamour\Administrable\Crudgenerator\Console\Traits\YamlTrait;
use Guysolamour\Administrable\Crudgenerator\Exceptions\CrudGeneratorException;

/**
 * @property Crud $crud
 */
trait CrudTrait
{
    use YamlTrait;

    public function getCrudTemplatePath(string $path = ''): string
    {
        $path = Str::start($path, '/');

        return $this->getTemplatePath($path);
    }


    /**
     * @return array|null
     */
    public function parseConfigurationYamlFile()
    {
        return Yaml::parseFile($this->getConfigurationYamlPath());
    }

    public function getCrudType(): string
    {
        $type = $this->type;

        if ($type === 'string' || $type === 'text' || $type === 'mediumText' || $type === 'json' || $type === 'longText') {
            return 'text';
        } else if ($type === 'integer' || $type === 'mediumInteger' || $type === 'bigInteger') {
            return 'int';
        } else if ($type === 'boolean' || $type === 'enum') {
            return 'bool';
        } else if ($type === 'datetime') {
            return 'date';
        } else if (is_array($type)) {
            return 'relation';
        }

        return $type;
    }

    /**
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    public function getCrudConfiguration(string $key, $default = null)
    {
        return  Arr::get($this->parseConfigurationYamlFile(), $key, $default);
    }


    public function getCrudModelsFolder(): string
    {
        return $this->getCrudConfiguration('folder', 'Models');
    }

    public function getCrudModel(string $model): array
    {
        $data = Arr::get($this->parseConfigurationYamlFile(), 'models');

        $crud_model = Arr::get($data, Str::ucfirst($model));

        if (!$crud_model) {
            throw new CrudGeneratorException(
                sprintf("The model [%s] is not defined in the [%s] file.", $model, $this->getConfigurationYamlPath())
            );
        }

        return $crud_model;
    }

    public function getModelsFolder(): string
    {
        return Str::ucfirst(config('administrable.models_folder'));
    }

    /**
     *
     * @param string|null $key
     * @param mixed $default
     * @return mixed
     */
    public function getCrudGlobalConfiguration(?string $key = null, $default = null)
    {
        $globals = $this->getCrudConfiguration('globals');

        if (is_null($key)) {
            return $globals;
        }

        return Arr::get($globals, $key, $default);
    }

}
