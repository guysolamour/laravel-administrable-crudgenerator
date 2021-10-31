<?php

namespace Guysolamour\Administrable\Crudgenerator\Console\Commands\Rollback;


use Guysolamour\Administrable\Crudgenerator\Console\Commands\Generate\GenerateRoute;


class RollbackRoute extends GenerateRoute
{
    public function run()
    {
        $path = $this->getPath();

        $this->crud->filesystem->delete($path);

        return  'Route file removed at ' . $path;
    }
}
