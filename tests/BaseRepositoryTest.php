<?php

namespace Akunbeben\Laravository\Tests;

use Akunbeben\Laravository\Repositories\Eloquent\BaseRepository;
use Akunbeben\Laravository\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class BaseRepositoryTest extends OrchestraTestCase
{
    public function test_base_repository_instance()
    {
        $repository = $this->mock('Akunbeben\Laravository\Repositories\Eloquent\BaseRepository');
        $interface = $this->mock('Akunbeben\Laravository\Repositories\Interfaces\BaseRepositoryInterface');

        $this->assertInstanceOf(BaseRepository::class, $repository);
        $this->assertInstanceOf(BaseRepositoryInterface::class, $interface);
    }

    public function test_provider_command_copies_the_provider()
    {
        $providerFile = app_path('Providers/RepositoryServiceProvider.php');

        if (File::exists($providerFile)) {
            unlink($providerFile);
        }

        $this->assertFalse(File::exists($providerFile));

        Artisan::call('repository:provider');

        $this->assertTrue(File::exists($providerFile));
    }

    public function test_make_repository_command_generate_the_repository_and_its_interface_file()
    {
        $repositoryFile = app_path('Repositories/Eloquent/TestRepository.php');
        $repositoryInterfaceFile = app_path('Repositories/Interfaces/TestRepositoryInterface.php');

        if (File::exists($repositoryFile) && File::exists($repositoryInterfaceFile)) {
            unlink($repositoryFile);
            unlink($repositoryInterfaceFile);
        }

        $this->assertFalse(File::exists($repositoryFile));
        $this->assertFalse(File::exists($repositoryInterfaceFile));

        Artisan::call('make:repository Test');

        $this->assertTrue(File::exists($repositoryFile));
        $this->assertTrue(File::exists($repositoryInterfaceFile));
    }
}
