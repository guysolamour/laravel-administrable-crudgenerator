<?php

namespace Guysolamour\Administrable\Crudgenerator\Console\Commands\Generate;

use Guysolamour\Administrable\Crudgenerator\Console\Crud;



abstract class BaseGenerate
{
    /**  @var \Guysolamour\Administrable\Crudgenerator\Console\Crud */
    public $crud;

    /** @var array */
    protected $data_map;


    public function __construct(Crud $crud)
    {
        $this->crud = $crud;

        $this->data_map = method_exists($this, 'getParsedName') ?
                          call_user_func([$this, 'getParsedName']):
                          $this->crud->getParsedName();

    }
    /**  @return mixed  */
    abstract function run();


    public function getRoutesParsedName() :array
    {
        return [
            '{{indexRoute}}'       => $this->crud->getRoute('index'),
            '{{showRoute}}'        => $this->crud->getRoute('show'),
            '{{createRoute}}'      => $this->crud->getRoute('create'),
            '{{storeRoute}}'       => $this->crud->getRoute('store'),
            '{{editRoute}}'        => $this->crud->getRoute('edit'),
            '{{updateRoute}}'      => $this->crud->getRoute('update'),
            '{{deleteRoute}}'      => $this->crud->getRoute('delete'),
        ];
    }

}
