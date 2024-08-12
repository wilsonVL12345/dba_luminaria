<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\detalle;
use App\Models\urbanizacion;
use PhpParser\Node\Expr\FuncCall;
use Carbon\Carbon;

class apiDetalleController extends Controller
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
        $listaUrb = urbanizacion::select('Nrodistrito', 'nombre_urbanizacion')->get();
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


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
