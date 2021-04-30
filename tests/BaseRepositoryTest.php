<?php

namespace Akunbeben\Laravository\Tests;

use Akunbeben\Laravository\Repositories\Eloquent\BaseRepository;
use Akunbeben\Laravository\Repositories\Interfaces\BaseRepositoryInterface;

class BaseRepositoryTest extends OrchestraTestCase
{
    public function test_base_repository_instance()
    {
        $repository = $this->mock('Akunbeben\Laravository\Repositories\Eloquent\BaseRepository');
        $interface = $this->mock('Akunbeben\Laravository\Repositories\Interfaces\BaseRepositoryInterface');

        $this->assertInstanceOf(BaseRepository::class, $repository);
        $this->assertInstanceOf(BaseRepositoryInterface::class, $interface);
    }
}
