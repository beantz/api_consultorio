<?php

namespace App\Providers;

use App\Http\Repositories\PacientesRepositories;
use App\Http\Repositories\ProcedimentoRepositories;
use App\Http\Services\AuthServices;
use App\Http\Services\PacientesServices;
use App\Http\Services\ProcedimentoServices;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServices::class);
        $this->app->bind(PacientesServices::class);
        $this->app->bind(PacientesRepositories::class);
        $this->app->bind(ProcedimentoServices::class);
        $this->app->bind(ProcedimentoRepositories::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
