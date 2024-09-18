<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Detalle;  // Importa tus modelos aquí
use App\Models\Inspeccion;
use App\Models\Proyecto;

class DatosComposer
{
    public function compose(View $view)
    {
        $mantenimientoCount = Detalle::where('Distritos_id', session('Lugar_Designado'))->where('Estado', 'En Espera')->count();
        $inspeccionCount = Inspeccion::where('Distritos_id', session('Lugar_Designado'))->where('Inspeccion', 'En Espera')->count();
        $proyectoCount = Proyecto::where('Distritos_id', session('Lugar_Designado'))->where('Estado', 'En Espera')->count();

        // Pasar los datos a las vistas
        $view->with(compact('mantenimientoCount', 'inspeccionCount', 'proyectoCount'));
    }
}
