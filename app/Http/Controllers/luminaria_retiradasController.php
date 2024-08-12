<?php

namespace App\Http\Controllers;

use App\Models\datos_luminaria_retirada;
use Illuminate\Http\Request;
use App\Models\distrito;
use App\Models\lista_accesorio;
use App\Models\lista_luminarias_retirada;
use App\Models\urbanizacion;

class luminaria_retiradasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datosluminaria = datos_luminaria_retirada::all();

        $listadistrito = Distrito::where('id', '<>', 15)->get();
        /*  $listazona = distrito::select('Zona_Urbanizacion')->distinct()->get(); */
        $listazona = urbanizacion::all();
        $listaaccesorios = lista_accesorio::all();
        $listaluminaria = lista_luminarias_retirada::all();
        return view('plantilla.Proyectos.proyectosLumRetiradas', [
            'listazona' => $listazona,
            'listadistritos' => $listadistrito, 'accesorios' => $listaaccesorios, 'datosluminaria' => $datosluminaria
        ]);
    }
    public function retiradaDetalle(String $id)
    {
        $datosLum = datos_luminaria_retirada::find($id);
        $listalum = lista_luminarias_retirada::where('datos_luminaria_id', $id)->get();

        return view('plantilla.Proyectos.proyectosRetiradasDetalles', compact('datosLum', 'listalum'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        // dd($request->all());
        try {
            $datosretirados = new datos_luminaria_retirada();

            $datosretirados->zona = $request->txtzona;
            $datosretirados->Nro_sisco = $request->txtnrosisco;
            $datosretirados->Fecha = $request->txtfechamante;
            $datosretirados->Proyecto = $request->txtproyecto;
            $datosretirados->Direccion = $request->txtdireccion;
            $datosretirados->User_id = session('id');
            $datosretirados->Distritos_id = $request->txtdistrito;
            $datosretirados->save();

            $nombre_item = $request->campoitem;
            $reutilizables = $request->camporeutilizables;
            $noreutilizables = $request->camponoreutilizables;
            // $observaciones = $request->campoobservaciones;

            $datosrecuperado = datos_luminaria_retirada::where('Nro_sisco', $request->txtnrosisco)->first();

            $datosrecuperad = $datosrecuperado->id;

            // dd(count($nombre_item));
            for ($i = 1; $i <= count($nombre_item); $i++) {
                $nombre = $nombre_item[$i]['txtitem'] ?? null;
                $reutilizable = $reutilizables[$i]['txtreutilizables'] ?? null;
                $noreutilizable = $noreutilizables[$i]['txtnoreutilizables'] ?? null;

                // Validación de campos vacíos
                if (empty($nombre) || $reutilizable === null || $noreutilizable === null) {
                    continue;
                }

                $cantidad = $reutilizable + $noreutilizable;

                $listaretirados = new lista_luminarias_retirada();
                $listaretirados->Nombre = $nombre;
                $listaretirados->Cantidad = $cantidad;
                $listaretirados->Reutilizables = $reutilizable;
                $listaretirados->NoReutilizables = $noreutilizable;
                $listaretirados->datos_luminaria_id = $datosrecuperad;
                $listaretirados->save();
            }
            $sql = true;
        } catch (\Throwable $th) {
            $sql = false;
        }
        if ($sql == true) {
            return back()->with("correcto", "Luminarias Retiradas  Registrado Correctamente");
        } else {
            return back()->with("incorrecto", "Error al Registrar Luminarias Retiradas");
        }
    }

    function editretirada(Request $request, $id)
    {
        try {
            $modRetirada = datos_luminaria_retirada::find($id);

            $modRetirada->Nro_sisco = $request->txtnrosiscoMod;
            $modRetirada->Distritos_id = $request->txtdistritoMod;
            $modRetirada->zona = $request->txtzonaMod;
            $modRetirada->Proyecto = $request->txtproyectoMod;
            $modRetirada->Fecha = $request->txtfechamanteMod;
            $modRetirada->Direccion = $request->txtdireccionMod;
            $modRetirada->User_id = session('id');
            $modRetirada->save();

            $sql = true;
        } catch (\Throwable $th) {
            $sql = false;
        }
        if ($sql == true) {
            return back()->with("correcto", "Luminarias Retiradas  Modificado Correctamente");
        } else {
            return back()->with("incorrecto", "Error al Modificar Luminarias Retiradas");
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
