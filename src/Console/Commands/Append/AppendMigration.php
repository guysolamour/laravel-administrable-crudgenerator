<?php

namespace Guysolamour\Administrable\Crudgenerator\Console\Commands\Append;

use Illuminate\Support\Str;
use Guysolamour\Administrable\Crudgenerator\Console\Field;
use Guysolamour\Administrable\Crudgenerator\Console\Commands\Generate\GenerateMigration;


class AppendMigration extends GenerateMigration
{
    public function run()
    {
        $stub = $this->crud->getCrudTemplatePath('migrations/add.stub');

        $data_map = array_merge($this->data_map, [
            '{{migrationTableName}}' => $this->crud->getModelTableName(),
            '{{migrationFileName}}'  => Str::camel($this->getMigrationFileName()),
        ]);

        $complied = $this->crud->filesystem->compliedFile($stub, true, $data_map);


        $path = $this->generateFields($complied,  $data_map['{{migrationFileName}}'], true);

        return "Migration appended to" .  $path;
    }

    private function getMigrationFileName(): string
    {
        $names = $this->crud->getFields()->map(fn (Field $field) => $field->getName());

        $file_name = 'Add';

        foreach ($names as $name) {
            if (Str::endsWith($name, '_id')) {
                $name = Str::before($name, '_id');
            }

            $file_name .= $name . 'And';
        }

        $file_name = rtrim($file_name, 'And') .  "FieldsTo{$this->data_map['{{pluralClass}}']}";

        return  Str::snake($file_name . 'Table');
    }
}
