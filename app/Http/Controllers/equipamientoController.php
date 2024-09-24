<?php

namespace App\Http\Controllers;

use App\Models\distrito;
use Illuminate\Http\Request;
use App\Models\equipamiento;
use Illuminate\Support\Facades\DB;

class equipamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($dist)
    {
        if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {
            $equipamiento = equipamiento::where('Distritos_id', $dist)->get();
            $lista = Distrito::where('id', '<>', 15)->get();

            return view('plantilla.Equipos.Equipamiento', ['equipos' => $equipamiento], ['lista' => $lista]);
        } else {
            $equipamiento = equipamiento::where('Distritos_id', $dist)
                ->get();

            $lista = Distrito::where('id', '<>', 15)
                ->get();


            return view('plantilla.Equipos.Equipamiento', ['equipos' => $equipamiento], ['lista' => $lista]);
        }
    }

    public function create(Request $request)
    {
        // Validaciones
        $request->validate([
            'txtnombre' => [
                'required',
                'regex:/^[a-zA-Z0-9\s\.\,\(\)\/\-\+]+$/', // Letras minúsculas y mayúsculas, números, espacio y los símbolos . , ( ) / - +
            ],
            'txtdescripcion' => [
                'nullable',
                'regex:/^[a-z0-9\s\.\,\(\)\/\-\+]*$/', // Letras minúsculas, números, espacio y los símbolos . , ( ) / - + (opcional)
            ],
            'txtdistrito' => 'required|digits_between:1,2', // Requerido, máximo 2 dígitos
            'txtestado' => [
                'required',
                'regex:/^[a-zA-Z]{1,20}$/', // Solo letras, hasta 20 caracteres
            ],

        ]);

        try {
            $equipamiento = new equipamiento();

            $equipamiento->Nombre_Item = $request->txtnombre;
            $equipamiento->Descripcion = $request->txtdescripcion;
            $equipamiento->estado = $request->txtestado;
            $equipamiento->Distritos_id = $request->txtdistrito;
            $equipamiento->save();
            $sql = true;
        } catch (\Throwable $th) {
            $sql = false;
        }
        if ($sql == true) {
            return back()->with("correcto", "Equipamiento Registrado Correctamente");
        } else {
            return back()->with("incorrecto", "Error al Registrar");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    // vista de  equipamientos divididos por distritos
    public function showEquipDistrito(Request $request)
    {
        if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {

            $lista = Distrito::where('id', '<>', 15)
                ->get();
        } else {
            $lista = Distrito::where('id', '<>', 15)
                ->where('id', session('Lugar_Designado'))->get();
        }
        // Agrupar por distritos_id y contar los registros
        $grupEquip = Equipamiento::select('distritos_id', DB::raw('COUNT(*) as total'))
            ->groupBy('distritos_id')
            ->get();

        // Crear un array para almacenar los conteos de los distritos 1 al 14
        $equipamientosPorDistrito = [];

        for ($i = 1; $i <= 14; $i++) {
            // Obtener el conteo específico para cada distrito
            $equipamientosPorDistrito[$i] = $grupEquip->firstWhere('distritos_id', $i)->total ?? 0;
        }

        return view('plantilla.Equipos.EquipomiendoDistrito', compact('lista', 'equipamientosPorDistrito'));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        // Validaciones
        $request->validate([
            'txtnombre' => [
                'required',
                'regex:/^[a-zA-Z0-9\s\.\,\(\)\/\-\+]+$/', // Letras minúsculas y mayúsculas, números, espacio y los símbolos . , ( ) / - +
            ],
            'txtdescripcion' => [
                'nullable',
                'regex:/^[a-z0-9\s\.\,\(\)\/\-\+]*$/', // Letras minúsculas, números, espacio y los símbolos . , ( ) / - + (opcional)
            ],
            'txtdistrito' => 'required|digits_between:1,2', // Requerido, máximo 2 dígitos
            'txtestado' => [
                'required',
                'regex:/^[a-zA-Z]{1,20}$/', // Solo letras, hasta 20 caracteres
            ],

        ]);
        try {
            $modif = equipamiento::find($request->txtid);
            $modif->Nombre_Item = $request->txtnombre;
            $modif->Descripcion = $request->txtdescripcion;
            $modif->estado = $request->txtestado;
            $modif->Distritos_id = $request->txtdistrito;
            $modif->save();
            $sql = true;
        } catch (\Throwable $th) {
            $sql = false;
        }
        if ($sql == true) {
            return back()->with("correcto", "Equipamiento Modificado Correctamente");
        } else {
            return back()->with("incorrecto", "Error al Modificar");
        }
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
    public function destroy(equipamiento $id)
    {
        $id->delete();
        return back()->with("correcto", "Datos Eliminados Correctamente");
    }
}
