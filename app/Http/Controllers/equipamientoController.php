<?php

namespace App\Http\Controllers;

use App\Models\distrito;
use Illuminate\Http\Request;
use App\Models\equipamiento;

class equipamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipamiento = equipamiento::orderBy('Distritos_id', 'asc')->get();
        $lista = Distrito::where('id', '<>', 15)->get();

        return view('plantilla.Equipos.Equipamiento', ['equipos' => $equipamiento], ['lista' => $lista]);
    }

    public function create(Request $request)
    {
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
    public function store(Request $request)
    {
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
    public function destroy(string $id)
    {
        //
    }
}
