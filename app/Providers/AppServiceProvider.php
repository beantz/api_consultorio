<?php

namespace App\Providers;

use App\Repositories\PacientesRepositories;
use App\Repositories\ProcedimentoRepositories;
use App\Services\AuthServices;
use App\Services\PacientesServices;
use App\Services\ProcedimentoServices;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
