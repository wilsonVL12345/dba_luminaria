<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Detalle;
use App\Models\Urbanizacion;
use PhpParser\Node\Expr\FuncCall;
use Carbon\Carbon;

class ApiDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function infoatencion(Request $request)
    {
        $infoDetalle = detalle::all();

        /*  $infoDetalle = detalle::where('Nro_Sisco', $request->txtbuscar)->get(); */
        return response()->json($infoDetalle);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function listUbanizacion()
    {
        $listaUrb = urbanizacion::select('id', 'Nrodistrito', 'nombre_urbanizacion')->get();
        return response()->json($listaUrb);
    }
    function detallesEspera()
    {

        $currentMonth = Carbon::now()->month;
        for ($i = 1; $i <= 14; $i++) {
            $responseData["d" . $i] = detalle::where('Distritos_id', $i)
                ->where('Estado', 'En espera')
                ->whereMonth('Fecha_Programado', $currentMonth)
                ->count();
        }

        return response()->json($responseData);
    }

    function detallesFinalizados()
    {
        $currentMonth = Carbon::now()->month;
        for ($i = 1; $i <= 14; $i++) {
            $responseDatas["d" . $i] = detalle::where('Distritos_id', $i)
                ->where('Estado', 'Finalizado')
                ->whereMonth('Fecha_Inicio', $currentMonth)
                ->count();
        }

        return response()->json($responseDatas);
    }


    /*  */


    /**
     * Display the specified resource.
     */
    public function fechasDetalles()
    {
        /*  $fechasTrabajo = detalle::select('Fecha_Programado')->get();
        return response()->json($fechasTrabajo); */
        // Obtener la fecha del primer día del mes actual
        $inicioMesActual = Carbon::now()->startOfMonth();
        // Obtener la fecha del último día del tercer mes desde ahora
        $finTresMeses = Carbon::now()->addMonths(3)->endOfMonth();

        // Filtrar las fechas que están entre el inicio del mes actual y el final de los próximos 3 meses
        $fechasMante = detalle::select('Fecha_Programado', 'Distritos_id')
            ->whereBetween('Fecha_Programado', [$inicioMesActual, $finTresMeses])
            ->get();

        return response()->json($fechasMante);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
