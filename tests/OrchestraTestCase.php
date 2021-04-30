<?php

namespace Akunbeben\Laravository\Tests;

use Akunbeben\Laravository\LaravositoryServiceProvider;
use Mockery;
use Orchestra\Testbench\TestCase;

abstract class OrchestraTestCase extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    protected function getPackageProviders($app)
    {
        return [LaravositoryServiceProvider::class];
    }
}