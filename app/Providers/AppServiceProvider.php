<?php

namespace App\Providers;

use App\Repositories\Interfaces\LinkRepositoryInterface;
use App\Services\Interfaces\LinkServiceInterface;
use App\Repositories\LinkRepository;
use App\Services\LinkService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(LinkRepositoryInterface::class, function() {
            return resolve(LinkRepository::class);
        });

        $this->app->bind(LinkServiceInterface::class, function() {
            return resolve(LinkService::class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
