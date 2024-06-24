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
        $this->app->singleton(CategoryRepository::class, function ($app) {
            return new CategoryRepository(new Category);
        });
        $this->app->singleton(CommentRepository::class, function ($app) {
            return new CommentRepository(new Comment);
        });
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
