<?php

namespace Guysolamour\Administrable\Crudgenerator\Console\Commands;

use Guysolamour\Administrable\Console\Filesystem;
use Guysolamour\Administrable\Crudgenerator\Exceptions\CrudGeneratorException;

class InstallCrudCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "administrable:crud:install";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Install crud generator files";



    protected Filesystem $filesystem;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();
        $this->filesystem = $filesystem;
    }

    public function handle()
    {
        $this->info("Installing.............");

        if ($this->checkIfInstallationHasBeenDone()){
            throw new CrudGeneratorException("The installation has been done..");
        }

        $this->filesystem->writeFile(
            $this->getConfigurationYamlPath(),
            $this->filesystem->get($this->getStubsPath('config/administrable.stub'))
        );

        $this->info("Installation done successfuly");
    }

    private function checkIfInstallationHasBeenDone() : bool
    {
        return $this->filesystem->exists($this->getConfigurationYamlPath());
    }
}
