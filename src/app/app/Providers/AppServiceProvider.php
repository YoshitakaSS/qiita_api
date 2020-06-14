<?php

namespace App\Providers;

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
        // V1 Repository
        $this->app->bind(
            \App\Repositories\V1\Interfaces\AuthorInterface::class,
            \App\Repositories\V1\Eloquent\AuthorRepository::class
        );
        $this->app->bind(
            \App\Repositories\V1\Interfaces\TagsInterface::class,
            \App\Repositories\V1\Eloquent\TagsRepository::class
        );
        $this->app->bind(
            \App\Repositories\V1\Interfaces\JobInterface::class,
            \App\Repositories\V1\Eloquent\JobRepository::class
        );
        $this->app->bind(
            \App\Repositories\V1\Interfaces\ListsInterface::class,
            \App\Repositories\V1\Eloquent\ListsRepository::class
        );


        // V1 Services
        $this->app->bind(\App\Services\Api\V1\AuthorService::class);
        $this->app->bind(\App\Services\Api\V1\ListService::class);
        $this->app->bind(\App\Services\Api\V1\TagsService::class);
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
