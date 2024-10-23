<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Distrito;
use App\Models\Proyecto;
use App\Models\Detalle;
use App\Models\Inspeccion;
use Carbon\Carbon;

class ApiDashboardController extends Controller
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
                'inspecciones_espera' => inspeccion::where('Distritos_id', $distrito)
                    ->where('Inspeccion', 'En espera')
                    ->whereMonth('Fecha_Inspeccion', $currentMonth)
                    ->count(),
                'inspecciones_realizadas' => inspeccion::where('Distritos_id', $distrito)
                    ->where('Inspeccion', 'Finalizado')
                    ->whereMonth('Fecha_Inspeccion', $currentMonth)
                    ->count(),
            ];
        }

        return response()->json($dashdetall);
    }

    public function dashdis2()
    {
        $currentYear = Carbon::now()->year;

        $dashdetall2 = [];

        for ($distrito = 1; $distrito <= 14; $distrito++) {
            $dashdetall2[$distrito] = [
                'proyectos_espera' => proyecto::where('Distritos_id', $distrito)
                    ->where('Estado', 'En espera')
                    ->whereyear('Fecha_Programada', $currentYear)
                    ->count(),
                'proyectos_finalizados' => proyecto::where('Distritos_id', $distrito)
                    ->where('Estado', 'Finalizado')
                    ->whereyear('Fecha_Ejecutada', $currentYear)
                    ->count(),


            ];
        }

        return response()->json($dashdetall2);
    }
    public function dashdis3()
    {
        $currentYear = Carbon::now()->year;

        $dashdetall3 = [];

        for ($distrito = 1; $distrito <= 14; $distrito++) {
            $dashdetall3[$distrito] = [


                'mantenimientos_espera' => detalle::where('Distritos_id', $distrito)
                    ->where('Estado', 'En espera')
                    ->whereyear('Fecha_Programado', $currentYear)
                    ->count(),


                'mantenimientos_finalizados' => detalle::where('Distritos_id', $distrito)
                    ->where('Estado', 'Finalizado')
                    ->whereyear('Fecha_Inicio', $currentYear)
                    ->count(),

            ];
        }

        return response()->json($dashdetall3);
    }
    public function dashdis4()
    {
        $currentYear = Carbon::now()->year;

        $dashdetall4 = [];

        for ($distrito = 1; $distrito <= 14; $distrito++) {
            $dashdetall4[$distrito] = [

                'inspecciones_espera' => inspeccion::where('Distritos_id', $distrito)
                    ->where('Inspeccion', 'En espera')
                    ->whereyear('Fecha_Inspeccion', $currentYear)
                    ->count(),
                'inspecciones_realizadas' => inspeccion::where('Distritos_id', $distrito)
                    ->where('Inspeccion', 'Finalizado')
                    ->whereyear('Fecha_Inspeccion', $currentYear)
                    ->count(),
            ];
        }

        return response()->json($dashdetall4);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
