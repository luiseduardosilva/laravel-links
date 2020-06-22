<?php

namespace App\Providers;

use App\Repositores\CategoriaRepository;
use App\Repositores\Contracts\CategoriaRepositoryInterface;
use App\Repositores\Contracts\LinkRepositoryInterface;
use App\Repositores\LinkRepository;
use App\Services\CategoriaService;
use App\Services\Contracts\CategoriaServiceInterface;
use App\Services\Contracts\LinkServiceInterface;
use App\Services\LinkService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Link
        $this->app->bind(LinkRepositoryInterface::class,LinkRepository::class);
        $this->app->bind(LinkServiceInterface::class, LinkService::class);

        // Categoria
        $this->app->bind(CategoriaRepositoryInterface::class,CategoriaRepository::class);
        $this->app->bind(CategoriaServiceInterface::class, CategoriaService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
