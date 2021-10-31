<?php

namespace Guysolamour\Administrable\Crudgenerator\Console\Commands\Append;

use Guysolamour\Administrable\Crudgenerator\Console\Commands\Generate\GenerateSeed;



class AppendSeed extends GenerateSeed
{
    public function run()
    {
        $path   = $this->getPath();

        if (!$this->crud->filesystem->exists($path)) {
            return;
        }

        $seeder = $this->generateSeederFields($this->crud->filesystem->get($path));

        $this->crud->filesystem->writeFile(
            $path,
            $seeder
        );

        return 'Seeder append' . $path;
    }
}
