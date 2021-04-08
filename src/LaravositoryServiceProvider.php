<?php

namespace Akunbeben\Laravository;

use Akunbeben\Laravository\Console\InterfaceMakeCommand;
use Akunbeben\Laravository\Console\RepositoryProviderMakeCommand;
use Akunbeben\Laravository\Console\RepositoryMakeCommand;
use Illuminate\Support\ServiceProvider;

class LaravositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands(RepositoryProviderMakeCommand::class);
        $this->commands(RepositoryMakeCommand::class);
        $this->commands(InterfaceMakeCommand::class);
    }

}
