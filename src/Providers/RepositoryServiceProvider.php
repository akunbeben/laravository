<?php

namespace Akunbeben\Laravository\Providers;

use Akunbeben\Laravository\Repositories\Eloquent\BaseRepository;
use Akunbeben\Laravository\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
