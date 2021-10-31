<?php

namespace Guysolamour\Administrable\Crudgenerator\Console\Commands\Rollback;

use Guysolamour\Administrable\Crudgenerator\Console\Commands\Generate\GenerateForm;

class RollbackForm extends GenerateForm
{
    public function run()
    {
        $path = $this->getPath();

        $this->crud->filesystem->delete($path);

        return  'Form file removed at ' . $path;
    }
}
