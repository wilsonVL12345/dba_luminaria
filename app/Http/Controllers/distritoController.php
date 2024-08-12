<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\distrito;
use App\Models\urbanizacion;
use GuzzleHttp\Promise\Create;

use function PHPUnit\Framework\returnSelf;
use Yajra\DataTables\Facades\DataTables;

class distritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /*  public function index()
    {
        $todoUrban = urbanizacion::orderBy('id', 'desc')
            ->where('nombre_urbanizacion', '<>', '')
            ->get();
        $distritos = Distrito::where('id', '<>', 15)->get();
        $listadistrito = urbanizacion::distinct()->get(['nombre_urbanizacion']);


        return view('plantilla.DetallesDistritos.Distritos', [
            'todoUrban' => $todoUrban,
            'listadistrito' => $listadistrito,
            'distrito' => $distritos
        ]);
    } */

    public function index(Request $request)
    {
        // Verifica si la solicitud es Ajax
        if ($request->ajax()) {
            try {
                // Consulta directa a la tabla personas
                $todoUrban = urbanizacion::select('id as idurb', 'Nrodistrito', 'nombre_urbanizacion');

                // Devolver los datos en formato JSON para DataTables
                return DataTables::of($todoUrban)->make(true);
            } catch (\Exception $e) {
                // Manejar errores de consulta a la base de datos
                return response()->json(['error' => 'Error al recuperar los datos de personas'], 500);
            }
        }

        // Consultas para las vistas
        $todoUrban = urbanizacion::orderBy('id', 'desc')
            ->where('nombre_urbanizacion', '<>', '')
            ->get();
        $distritos = Distrito::where('id', '<>', 15)->get();
        $listadistrito = urbanizacion::distinct()->get(['nombre_urbanizacion']);

        // Renderizar la vista con los datos
        return view('plantilla.DetallesDistritos.Distritos', [
            'todoUrban' => $todoUrban,
            'listadistrito' => $listadistrito,
            'distrito' => $distritos
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        try {
            $newUrb = new urbanizacion();
            $newUrb->Nrodistrito = $request->txtdistrit;
            $newUrb->nombre_urbanizacion = $request->txtzonaUrba;
            /*  dd($newUrb); */

            $newUrb->save();

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

    public function datosEdit($id)
    {
        $urbEdit = urbanizacion::find($id);
        $distEdit = Distrito::where('id', '<>', 15)->get();
        return view('plantilla.DetallesDistritos.editDistrito', compact('urbEdit', 'distEdit'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        try {
            $urba = urbanizacion::find($id);

            $urba->Nrodistrito = $request->txtdistritom;
            $urba->nombre_urbanizacion = $request->txtzonaUrbanizacionm;
            $urba->save();
            $sql = true;
        } catch (\Throwable $th) {
            $sql = false;
        }
        if ($sql == true) {
            return redirect('/detallesDistritos')->with("correcto", "Urbanizacion Modificado Correctamente");
        } else {
            return back('/detallesDistritos')->with("incorrecto", "Error al Modificar");
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
