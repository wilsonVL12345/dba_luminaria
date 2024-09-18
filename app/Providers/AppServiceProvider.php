<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\DatosComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // para que los 3 valores que estan contando los trabajos en espera de cada usuario tecnico se muestre en todas las vidas
        //  si en caso quieres mostrar en un grupo de vistas en especifico este comando view::composer('layout.*', DatosComposer::class);
        View::composer('*', DatosComposer::class);
    }
}
