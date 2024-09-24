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
        $request->validate([
            'txtnombre' => [
                'required',
                'regex:/^[A-Z0-9\/\*\-\.\,\(\)\s]+$/', // Requerido, mayúsculas, números y símbolos permitidos
            ],
        ]);
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


    public function edit(Request $request)
    {
        $request->validate([
            'txtnombre' => [
                'required',
                'regex:/^[A-Z0-9\/\*\-\.\,\(\)\s]+$/', // Requerido, mayúsculas, números y símbolos permitidos
            ],
        ]);

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


    public function destroy(lista_accesorio $id)
    {
        $id->delete();
        return back()->with("correcto", "Datos Eliminados Correctamente");
    }
}
