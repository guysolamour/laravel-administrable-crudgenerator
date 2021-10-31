<?php

namespace guysolamour\crudgenerator\Tests;

use Guysolamour\Crudgenerator\Facades\crudgenerator;
use Guysolamour\Crudgenerator\ServiceProvider;
use Orchestra\Testbench\TestCase;

class CrudgeneratorTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'crudgenerator' => crudgenerator::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}
