<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\inspeccion;
use App\Models\distrito;
use App\Models\urbanizacion;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class inspeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {
            /* $inspeccion = inspeccion::all(); */
            $inspeccion = inspeccion::where('Inspeccion', 'En espera')
                ->orderBy('created_at', 'desc')
                ->get();
            $listadistrito = Distrito::where('id', '<>', 15)->get();
            /* $listazonaurb = urbanizacion::all(); */

            return view('plantilla.Inspecciones.Espera', ['inspeccion' => $inspeccion, 'listadistrito' => $listadistrito/* , 'listazonaurb' => $listazonaurb */]);
        } else {
            $inspeccion = inspeccion::where('Inspeccion', 'En espera')
                ->where('Distritos_id', session('Lugar_Designado'))

                ->orderBy('created_at', 'desc')
                ->get();
            $listadistrito = Distrito::where('id', '<>', 15)
                ->where('id', session('Lugar_Designado'))->get();

            /* $listazonaurb = urbanizacion::all(); */

            return view('plantilla.Inspecciones.Espera', ['inspeccion' => $inspeccion, 'listadistrito' => $listadistrito/* , 'listazonaurb' => $listazonaurb */]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $url = '';
        /* dd($request->all()); */
        if ($request->imgcarta) {

            $dir = $request->file('imgcarta')->store('public/fileinspecciones');
            $url = Storage::url($dir);
            $request->validate([
                'imgcarta' => 'image|max:8048' //required|
            ]);
        }
        try {

            // Validaciones
            $request->validate([
                'txtnrosisco' => [
                    'required',
                    'regex:/^\d{5,6}-\d{4}$/', // Formato: 5 o 6 dígitos, seguido de - y 4 dígitos
                    function ($attribute, $value, $fail) {
                        // Verificar que el último número sea mayor a 2022
                        $year = (int) substr($value, -4);
                        if ($year <= 2022) {
                            $fail("El último número debe ser mayor que 2022.");
                        }
                    },
                ],
                'txturbs' => [
                    'required',
                ],
                'txtfecha' => [
                    'required',
                ],
                'txtdistirtoo' => 'required|digits_between:1,2', // Requerido, máximo 2 dígitos
            ]);


            //aqui poner el id del que va a agregar el trabajo
            $fk = session('id');
            $espera = 'En Espera';
            //se a creado un acceso directo para que pueda acceder a esa carpeta

            $inspeccion = new inspeccion();

            $inspeccion->Nro_Sisco = $request->txtnrosisco;
            $inspeccion->Distritos_id = $request->txtdistirtoo;
            $inspeccion->ZonaUrbanizacion = $request->txturbs;
            $inspeccion->Fecha_Inspeccion = $request->txtfecha;
            $inspeccion->Foto_Carta = $url;
            $inspeccion->Inspeccion = $espera;
            $inspeccion->users_id = $fk;
            $inspeccion->save();
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
    public function ready(Request $request)
    {
        try {
            // Validaciones
            $request->validate([
                'txttipo' => [
                    'required',
                    'regex:/^[a-zA-Z]{1,50}$/', // Solo letras, hasta 20 caracteres
                ],
                'txtdescripcion' => [
                    'nullable',
                    'regex:/^[a-z0-9\s\.\,\(\)\/\-\+]*$/', // Letras minúsculas, números, espacio y los símbolos . , ( ) / - + (opcional)
                ],

                'txtfecha' => 'required',
                'txtestado' => [
                    'required',
                    'regex:/^[a-zA-Z]{1,20}$/', // Solo letras, hasta 20 caracteres
                ],

            ]);

            $inspe = 'Finalizado';
            $emp = inspeccion::find($request->txtid);

            $emp->Tipo_Inspeccion = $request->txttipo;
            $emp->Detalles = $request->txtdescripcion;
            $emp->Estado = $request->txtestado;
            $emp->Fecha_Inspeccion = $request->txtfecha;
            $emp->Inspeccion = $inspe;
            $emp->Inspector = session('id');
            $emp->save();
            $sql = true;
        } catch (\Throwable $th) {
            $sql = false;
        }
        if ($sql == true) {
            return back()->with("correcto", "Inspeccion realizada con exito");
        } else {
            return back()->with("incorrecto", "Error al Inspeccionar");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)


    {
        try {
            // Validaciones
            $request->validate([
                'txtsisco' => [
                    'required',
                    'regex:/^\d{5,6}-\d{4}$/', // Formato: 5 o 6 dígitos, seguido de - y 4 dígitos
                    function ($attribute, $value, $fail) {
                        // Verificar que el último número sea mayor a 2022
                        $year = (int) substr($value, -4);
                        if ($year <= 2022) {
                            $fail("El último número debe ser mayor que 2022.");
                        }
                    },
                ],
                'slurbInspEsp' => [
                    'required',
                ],
                'txtfecha' => [
                    'required',
                ],
                'sldistInspEsp' => 'required|digits_between:1,2', // Requerido, máximo 2 dígitos


            ]);
            if (!$request->imgcartaa) {
                $inspe = inspeccion::find($request->txtid);

                $inspe->Distritos_id = $request->sldistInspEsp;
                $inspe->ZonaUrbanizacion = $request->slurbInspEsp;
                $inspe->Nro_Sisco = $request->txtsisco;
                $inspe->Fecha_Inspeccion = $request->txtfecha;
                $inspe->users_id = session('id');
                $inspe->save();
                $sql = true;
            } else {
                $request->validate([
                    'imgcartaa' => 'image|max:8048' //required|
                ]);
                $dir = $request->file('imgcartaa')->store('public/fileinspecciones');
                $urll = Storage::url($dir);
                $inspe = inspeccion::find($request->txtid);

                $filePath = $inspe->Foto_Carta;
                $filePath = 'fileinspecciones/' . basename($inspe->Foto_Carta); // Construye la ruta relativa
                // Verificar si el archivo existe
                if (Storage::disk('public')->exists($filePath)) {
                    // Eliminar el archivo
                    Storage::disk('public')->delete($filePath);
                }
                $inspe->Distritos_id = $request->sldistInspEsp;
                $inspe->ZonaUrbanizacion = $request->slurbInspEsp;
                $inspe->Nro_Sisco = $request->txtsisco;

                $inspe->Fecha_Inspeccion = $request->txtfecha;
                $inspe->users_id = session('id');
                $inspe->Foto_Carta = $urll;
                $inspe->save();
                $sql = true;
            }
        } catch (\Throwable $th) {
            $sql = false;
        }
        if ($sql == true) {
            return back()->with("correcto", "Datos Modificado Correctamente");
        } else {
            return back()->with("incorrecto", "Error al Modificar");
        }
    }
    public function editRealizada(Request $request, $id)
    {
        try {
            // Validaciones
            $request->validate([
                'txttipo' => [
                    'required',
                    'regex:/^[a-zA-Z]{1,50}$/', // Solo letras, hasta 20 caracteres
                ],
                'txtsisco' => [
                    'required',
                    'regex:/^\d{5,6}-\d{4}$/', // Formato: 5 o 6 dígitos, seguido de - y 4 dígitos
                    function ($attribute, $value, $fail) {
                        // Verificar que el último número sea mayor a 2022
                        $year = (int) substr($value, -4);
                        if ($year <= 2022) {
                            $fail("El último número debe ser mayor que 2022.");
                        }
                    },
                ],
                'slurbInspRea' => [
                    'required',
                ],
                'sldistInspRea' => 'required|digits_between:1,2', // Requerido, máximo 2 dígitos
                'txtestado' => [
                    'required',
                    'regex:/^[a-zA-Z]{1,20}$/', // Solo letras, hasta 20 caracteres
                ],


            ]);
            $editInspec = inspeccion::find($id);

            $editInspec->Tipo_Inspeccion = $request->txttipo;
            $editInspec->Nro_Sisco = $request->txtsisco;
            $editInspec->ZonaUrbanizacion = $request->slurbInspRea;
            $editInspec->Distritos_id = $request->sldistInspRea;

            $editInspec->Estado = $request->txtestado;
            $editInspec->save();
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

    public function realizadas(Request $request)
    {
        if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {
            $inspeccion = inspeccion::where('Inspeccion', 'Finalizado')->get();
            $inspector = user::all();
            $listadistrito = Distrito::where('id', '<>', 15)->get();
            /*  $listazonaurb = urbanizacion::all(); */
            return view('plantilla.Inspecciones.Realizadas', ['inspeccion' => $inspeccion, 'listadistrito' => $listadistrito/* , 'listazonaurb' => $listazonaurb */, 'inspector' => $inspector]);
        } else {
            $inspeccion = inspeccion::where('Inspeccion', 'Finalizado')
                ->where('Distritos_id', session('Lugar_Designado'))->get();
            $inspector = user::all();
            $listadistrito = Distrito::where('id', '<>', 15)
                ->where('id', session('Lugar_Designado'))->get();

            /*  $listazonaurb = urbanizacion::all(); */
            return view('plantilla.Inspecciones.Realizadas', ['inspeccion' => $inspeccion, 'listadistrito' => $listadistrito/* , 'listazonaurb' => $listazonaurb */, 'inspector' => $inspector]);
        }
    }


    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(inspeccion $id)
    {
        $id->delete();
        return back()->with("correcto", "Datos Eliminados Correctamente");
    }
}
