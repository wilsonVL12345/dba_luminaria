<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lista_accesorio;

use function PHPSTORM_META\sql_injection_subst;

class lista_accesorioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accesorios = Lista_accesorio::orderBy('id', 'desc')->get();
        return view('plantilla.Equipos.Accesorios', ['accesorio' => $accesorios]);
    }
    public function create(Request $request)
    {
        try {
            $accesorio = new lista_accesorio();
            $accesorio->Nombre_Item = $request->txtnombre;
            $accesorio->save();
            $sql = true;
        } catch (\Throwable $th) {
            $sql = false;
        }
        if ($sql == true) {
            return back()->with("correcto", "Datos Registrado Correctamente");
        } else {
            return back()->with("incorrecto", "Error al Registrar");
        }
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
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {

        try {
            $lista = lista_accesorio::find($request->txtid);
            $lista->Nombre_Item = $request->txtnombre;
            $lista->save();
            $sql = true;
        } catch (\Throwable $th) {
            $sql = false;
        }
        if ($sql == true) {
            return back()->with("correcto", "Datos Modificado Correctamente");
        } else {
            return back()->with("incorrecto", "Error al Modificar");
        }
    }



    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        try {
            $accedestroy = lista_accesorio::find($id);
            if ($accedestroy) {

                lista_accesorio::destroy("$id");
                $sql = true;
                return back()->with("correcto", "Datos Eliminados Correctamente");
            } else {
                return back()->with("incorrecto", "Registro no encontrado");
            }
        } catch (\Throwable $th) {
            $sql = false;
        }
        if ($sql == true) {
            return back()->with("correcto", "Datos Eliminados Correctamente");
        } else {
            return back()->with("incorrecto", "Error al Eliminar");
        }
    }
}
