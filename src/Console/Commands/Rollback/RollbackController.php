<?php

namespace Guysolamour\Administrable\Crudgenerator\Console\Commands\Rollback;

use Guysolamour\Administrable\Crudgenerator\Console\Commands\Generate\GenerateController;



class RollbackController extends GenerateController
{
    public function run()
    {
        $path = $this->getPath();

        $this->crud->filesystem->delete($path);

        return  'Controller file removed at ' . $path;
    }
}
