<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\distrito;
use App\Models\proyecto;
use App\Models\detalle;
use App\Models\inspeccion;
use Carbon\Carbon;

class apiDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashdis1()
    {
        $currentMonth = Carbon::now()->month;

        $dashdetall = [];

        for ($distrito = 1; $distrito <= 14; $distrito++) {
            $dashdetall[$distrito] = [
                'proyectos_espera' => proyecto::where('Distritos_id', $distrito)
                    ->where('Estado', 'En espera')
                    ->whereMonth('Fecha_Programada', $currentMonth)
                    ->count(),

                'mantenimientos_espera' => detalle::where('Distritos_id', $distrito)
                    ->where('Estado', 'En espera')
                    ->whereMonth('Fecha_Programado', $currentMonth)
                    ->count(),

                'proyectos_finalizados' => proyecto::where('Distritos_id', $distrito)
                    ->where('Estado', 'Finalizado')
                    ->whereMonth('Fecha_Ejecutada', $currentMonth)
                    ->count(),

                'mantenimientos_finalizados' => detalle::where('Distritos_id', $distrito)
                    ->where('Estado', 'Finalizado')
                    ->whereMonth('Fecha_Inicio', $currentMonth)
                    ->count(),

                'inspecciones_realizadas' => inspeccion::where('Distritos_id', $distrito)
                    ->where('Inspeccion', 'Finalizado')
                    ->whereMonth('Fecha_Inspeccion', $currentMonth)
                    ->count(),
            ];
        }

        return response()->json($dashdetall);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
