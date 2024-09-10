<?php

namespace App\Http\Controllers;

use App\Models\reelevamiento;
use Illuminate\Http\Request;
use App\Models\distrito;
use Illuminate\Support\Facades\DB;

class ReelevamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showDist(Request $request)
    {
        if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {

            $lista = Distrito::where('id', '<>', 15)
                ->get();
        } else {
            $lista = Distrito::where('id', '<>', 15)
                ->where('id', session('Lugar_Designado'))->get();
        }
        // Agrupar por distritos_id y contar los registros
        $grupEquip = reelevamiento::select('distritos_id', DB::raw('COUNT(*) as total'))
            ->groupBy('distritos_id')
            ->get();

        // Crear un array para almacenar los conteos de los distritos 1 al 14
        $reelevamientosPorDistrito = [];

        for ($i = 1; $i <= 14; $i++) {
            // Obtener el conteo específico para cada distrito
            $reelevamientosPorDistrito[$i] = $grupEquip->firstWhere('distritos_id', $i)->total ?? 0;
        }

        return view('plantilla.Reelevamiento.reeLuminaria', compact('lista', 'reelevamientosPorDistrito'));
    }

    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(reelevamiento $reelevamiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(reelevamiento $reelevamiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, reelevamiento $reelevamiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(reelevamiento $reelevamiento)
    {
        //
    }
}
