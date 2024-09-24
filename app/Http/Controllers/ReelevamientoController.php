<?php

namespace App\Http\Controllers;

use App\Models\reelevamiento;
use Illuminate\Http\Request;
use App\Models\distrito;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

    public function index($id)
    {
        $showReele = reelevamiento::where('Distritos_id', $id)->get();
        $lista = Distrito::where('id', '<>', 15)->get();

        return view('plantilla.Reelevamiento.reeLuminariaShow', compact('showReele', 'lista'));
    }


    public function create(Request $request)
    {
        // Validaciones
        $request->validate([
            'flrar' => 'file|mimes:rar,zip|max:40960', // Archivo opcional de máximo 40 MB
            'reeAvCalle' => [
                'required',
                'regex:/^[a-z0-9\s\.\,\(\)\/\-\+]+$/', // Letras minúsculas, números, espacio y los símbolos . , ( ) / - +
            ],
            'reeDescripRegis' => [
                'nullable',
                'regex:/^[a-z0-9\s\.\,\(\)\/\-\+]*$/', // Letras minúsculas, números, espacio y los símbolos . , ( ) / - + (opcional)
            ],
            'reeDistritoRegis' => 'required|digits_between:1,2', // Requerido, máximo 2 dígitos
            'reeFechaRegis' => 'required|date', // Requerido, debe ser una fecha válida
            'reeUrbanizacionRegis' => 'required|digits_between:1,4', // Requerido, máximo 4 dígitos
        ]);
        if ($request->flrar) {
            $dir = $request->file('flrar')->store('public/rarReelevamiento');
            $url = Storage::url($dir);
        }
        try {


            $reeleLumNew = new reelevamiento();
            $reeleLumNew->Av_calles = $request->reeAvCalle;
            $reeleLumNew->Descripcion = $request->reeDescripRegis;
            $reeleLumNew->Distritos_id = $request->reeDistritoRegis;
            $reeleLumNew->Fecha = $request->reeFechaRegis;
            $reeleLumNew->Urbanizacion_id = $request->reeUrbanizacionRegis;
            $reeleLumNew->Archivos = $url;
            $reeleLumNew->save();
            $sql = true;
        } catch (\Throwable $th) {
            $sql = false;
        }
        if ($sql == true) {
            return back()->with("correcto", "Datos Registrado Correctamente");
        } else {
            return back()->with("incorrecto", "Error al registrar");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function modificar(Request $request, $id)
    {
        $request->validate([
            'flrarMod' => 'file|mimes:rar,zip|max:40960', // Archivo opcional de máximo 40 MB
            'reeAvCalleMod' => [
                'required',
                'regex:/^[a-z0-9\s\.\,\(\)\/\-\+]+$/', // Letras minúsculas, números, espacio y los símbolos . , ( ) / - +
            ],
            'reeDescripRegisMod' => [
                'nullable',
                'regex:/^[a-z0-9\s\.\,\(\)\/\-\+]*$/', // Letras minúsculas, números, espacio y los símbolos . , ( ) / - + (opcional)
            ],
            'reeDistritoRegisMod' => 'required|digits_between:1,2', // Requerido, máximo 2 dígitos
            'reeFechaRegisMod' => 'required|date', // Requerido, debe ser una fecha válida
            'reeUrbanizacionRegisMod' => 'required|digits_between:1,4', // Requerido, máximo 4 dígitos
        ]);
        if ($request->flrarMod) {
            $dirr = $request->file('flrarMod')->store('public/rarReelevamiento');
            $urll = Storage::url($dirr);
        }
        try {
            $reeleMod = reelevamiento::find($id);
            if ($request->flrarMod) {
                // $filePath = $reeleMod->Archivos;
                $filePath = 'rarReelevamiento/' . basename($reeleMod->Archivos); // Construye la ruta relativa

                // Verificar si el archivo existe

                if (Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }
                $reeleMod->Av_calles = $request->reeAvCalleMod;
                $reeleMod->Descripcion = $request->reeDescripRegisMod;
                $reeleMod->Distritos_id = $request->reeDistritoRegisMod;
                $reeleMod->Fecha = $request->reeFechaRegisMod;
                $reeleMod->Urbanizacion_id = $request->reeUrbanizacionRegisMod;
                $reeleMod->Archivos = $urll;
                $reeleMod->save();
                $sql = true;
            } else {

                $reeleMod->Av_calles = $request->reeAvCalleMod;
                $reeleMod->Descripcion = $request->reeDescripRegisMod;
                $reeleMod->Distritos_id = $request->reeDistritoRegisMod;
                $reeleMod->Fecha = $request->reeFechaRegisMod;
                $reeleMod->Urbanizacion_id = $request->reeUrbanizacionRegisMod;

                $reeleMod->save();
                $sql = true;
            }
        } catch (\Throwable $th) {
            $sql = false;
        }
        if ($sql == true) {
            return back()->with("correcto", "Datos Modificados Correctamente");
        } else {
            return back()->with("incorrecto", "Error al Modificar");
        }
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
    public function destroy(reelevamiento $id)
    {
        $id->delete();
        return back()->with("correcto", "Datos Eliminados Correctamente");
    }
}
