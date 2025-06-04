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
        // $this->app->bind(AuthServices::class);

        $this->app->bind('auth.services', AuthServices::class);
        $this->app->bind('paciente.services', PacientesServices::class);
        $this->app->bind('paciente.repository', PacientesRepositories::class);
        $this->app->bind('procedimento.services', ProcedimentoServices::class);
        $this->app->bind('procedimento.repository', ProcedimentoRepositories::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
