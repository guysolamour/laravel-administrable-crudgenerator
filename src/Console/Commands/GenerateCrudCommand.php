<?php

namespace Guysolamour\Administrable\Crudgenerator\Console\Commands;


use Guysolamour\Administrable\Crudgenerator\Console\Crud;
use Guysolamour\Administrable\Crudgenerator\Console\Traits\CrudTrait;
use Guysolamour\Administrable\Crudgenerator\Exceptions\CrudGeneratorException;

class GenerateCrudCommand extends BaseCommand
{
    use CrudTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'administrable:crud:generate
                             {model? : Model name}
                             {--m|migrate=true : Run artisan migrate command }
                             ';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create, model, migration and all views (crud)';



    public function handle()
    {
        if (!$this->checkIfPackageHasBeenInstalled()) {
            throw new CrudGeneratorException("You have to install administrable package first.");
        }


        $progress = $this->output->createProgressBar(10);

        $model =  $this->getModel($this->argument('model'));

        if ($this->checkIfCrudHasAlreadyBeenDoneForModel($model)) {
            throw new CrudGeneratorException("The model [{$model}] crud has already been done.");
        }

        $migrate = $this->getMigrate();

        $crud = new Crud($model, $migrate);


        /*
        |--------------------------------------------------------------------------
        | Models
        |--------------------------------------------------------------------------
        */
        $this->displayTitle('Creating Model...');
        [$result, $path] = $crud->generate('model');
        $this->displayResult($result, $path);
        $progress->advance();


        /*
        |--------------------------------------------------------------------------
        | Migrations
        |--------------------------------------------------------------------------
        */
        $this->displayTitle('Creating Migration...');
        [$result, $migration] = $crud->generate('migration');
        $this->displayResult($result, $migration);
        $progress->advance();

        /*
        |--------------------------------------------------------------------------
        | Seeders
        |--------------------------------------------------------------------------
        */
        $this->displayTitle('Creating Seed...');
        [$result, $path] = $crud->generate('seed');
        $this->displayResult($result, $path);
        $progress->advance();

        /*
        |--------------------------------------------------------------------------
        | Run migrations
        |--------------------------------------------------------------------------
        */
        $this->displayTitle('Migrate...');
        $this->runMigration($migrate);
        $progress->advance();

        /*
        |--------------------------------------------------------------------------
        | Forms
        |--------------------------------------------------------------------------
        */
        $this->displayTitle('Creating form...');
        [$result, $path] = $crud->generate('form');
        $this->displayResult($result, $path);
        $progress->advance();

        /*
        |--------------------------------------------------------------------------
        | Controllers
        |--------------------------------------------------------------------------
        */
        $this->displayTitle('Creating controller...');
        [$result, $path] = $crud->generate('controller');
        $this->displayResult($result, $path);
        $progress->advance();


        /*
        |--------------------------------------------------------------------------
        | Route
        |--------------------------------------------------------------------------
        */
        $this->displayTitle('Creating route...');
        [$result, $path] = $crud->generate('route');
        $this->displayResult($result,
            $path
        );
        $progress->advance();


        /*
        |--------------------------------------------------------------------------
        | Views
        |--------------------------------------------------------------------------
        */
        $this->displayTitle('Creating views...');
        [$result, $path] = $crud->generate('views');
        $this->displayResult($result,
            $path
        );
        $progress->advance();


        /*
        |--------------------------------------------------------------------------
        | Run composer autoload
        |--------------------------------------------------------------------------
        */
        $this->runProcess("composer dump-autoload");

        $progress->finish();
    }
}
