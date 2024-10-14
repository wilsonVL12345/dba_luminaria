<?php

namespace App\Http\Controllers;

use App\Models\datos_luminaria_retirada;
use Illuminate\Http\Request;
use App\Models\distrito;
use App\Models\lista_accesorio;
use App\Models\lista_luminarias_retirada;
use App\Models\luminarias_reutilizada;
use App\Models\urbanizacion;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

// use Barryvdh\Snappy\Facades\SnappyPdf;

class luminaria_retiradasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Admin') {
                $datosluminaria = datos_luminaria_retirada::all();

                $listadistrito = Distrito::where('id', '<>', 15)->get();
                /*  $listazona = distrito::select('Zona_Urbanizacion')->distinct()->get(); */
                $listazona = urbanizacion::all();
                $listaaccesorios = lista_accesorio::all();
                // $listaluminaria = lista_luminarias_retirada::all();
                return view('plantilla.Proyectos.proyectosLumRetiradas', [
                    'listazona' => $listazona,
                    'listadistritos' => $listadistrito,
                    'accesorios' => $listaaccesorios,
                    'datosluminaria' => $datosluminaria
                ]);
            } else {
                $datosluminaria = datos_luminaria_retirada::where('Distritos_id', session('Lugar_Designado'))->get();

                $listadistrito = Distrito::where('id', session('Lugar_Designado'))->get();

                /*  $listazona = distrito::select('Zona_Urbanizacion')->distinct()->get(); */
                $listazona = urbanizacion::all();
                $listaaccesorios = lista_accesorio::all();
                return view('plantilla.Proyectos.proyectosLumRetiradas', [
                    'listadistritos' => $listadistrito,
                    'accesorios' => $listaaccesorios,
                    'datosluminaria' => $datosluminaria
                ]);
            }
        } catch (\Throwable $th) {
        }
    }
    public function getProyLumRetiradaData(Request $request)
    {
        // Determinamos el query base dependiendo del cargo del usuario
        if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {
            $proyAlmacen = datos_luminaria_retirada::select(
                'Nro_sisco',
                'zona',
                'Distritos_id',
                'Fecha',
                'id'
            );
        } else {
            $proyAlmacen = datos_luminaria_retirada::select(
                'Nro_sisco',
                'zona',
                'Distritos_id',
                'Fecha',
                'id'
            )
                ->where('Distritos_id', session('Lugar_Designado'));
        }

        // Procesamos los datos con DataTables, manejando la paginación, búsqueda y longitud
        return DataTables::of($proyAlmacen)
            ->filter(function ($query) use ($request) {
                // Agrega un filtro adicional aquí si es necesario
                if ($request->has('search.value')) {
                    $search = $request->input('search.value');
                    $query->where(function ($query) use ($search) {
                        $query->where('Nro_sisco', 'like', "%{$search}%")
                            ->orWhere('Zona', 'like', "%{$search}%")
                            ->orWhere('Distritos_id', 'like', "%{$search}%")
                            ->orWhere('Fecha', 'like', "%{$search}%");
                    });
                }
            })

            ->addColumn('action', function ($row) {
                $actions = '<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    Actions
                    <span class="svg-icon svg-icon-5 m-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                        </svg>
                    </span>
                </a>
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                data-kt-menu="true">';

                if (auth()->user()->can('proyecto.Retirado.edit')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/proyectos/luminariasRetiradas' . $row->id) . '" 
                            class="menu-link px-3">Editar</a>
                    </div>';
                }
                if (auth()->user()->can('proyecto.Retirado.export')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/retirado/pdf' . $row->id) . '" 
                            class="menu-link px-3 " target="_blank">Reporte</a>
                    </div>';
                }

                if (auth()->user()->can('proyecto.Retirado.delete')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/eliminar/retirada' . $row->id) . '" class="menu-link px-3 delete-link" 
                            data-kt-customer-table-filter="delete_row">Eliminar</a>
                    </div>';
                }

                $actions .= '</div>';

                return $actions;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function retiradaDetalle(String $id)
    {
        $datosLum = datos_luminaria_retirada::find($id);
        $listalum = lista_luminarias_retirada::where('datos_luminaria_id', $id)->get();

        return view('plantilla.Proyectos.proyectosRetiradasDetalles', compact('datosLum', 'listalum'));
    }


    public function create(Request $request)
    {
        // Validaciones
        $request->validate([
            'txtzona' => [
                'required',
            ],
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
            'txtfechamante' => [
                'required',
            ],
            'txtproyecto' => [
                'required',
                'regex:/^[a-zA-Z0-9\s\.\,\(\)\/\-\+]+$/', // Letras minúsculas y mayúsculas, números, espacio y los símbolos . , ( ) / - +
            ],
            'txtdireccion' => [
                'required',
                'regex:/^[a-zA-Z0-9\s\.\,\(\)\/\-\+]+$/', // Letras minúsculas y mayúsculas, números, espacio y los símbolos . , ( ) / - +
            ],
            'txtdistrito' => 'required|digits_between:1,2', // Requerido, máximo 2 dígitos
        ]);
        try {
            DB::beginTransaction();

            $datosretirados = new datos_luminaria_retirada();
            $datosretirados->Nro_sisco = $request->txtnrosisco;
            $datosretirados->zona = $request->txtzona;
            $datosretirados->Fecha = $request->txtfechamante;
            $datosretirados->Proyecto = $request->txtproyecto;
            $datosretirados->Direccion = $request->txtdireccion;
            $datosretirados->User_id = session('id');
            $datosretirados->Distritos_id = $request->txtdistrito;
            $datosretirados->save();

            $nombre_item = $request->campoitem;
            $reutilizables = $request->camporeutilizables;
            $noreutilizables = $request->camponoreutilizables;

            $listaGuardada = false;

            if ($nombre_item) {
                # code...
                // Validaciones
                $request->validate([]);
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
                    $listaretirados->datos_luminaria_id = $datosretirados->id;
                    $listaretirados->save();

                    $listaGuardada = true;
                }
            }


            if (!$listaGuardada) {
                throw new \Exception("No se guardó ninguna lista de luminarias retiradas.");
            }

            DB::commit();
            return back()->with("correcto", "Luminarias Retiradas Registradas Correctamente");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with("incorrecto", "Error al Registrar Luminarias Retiradas: " . $e->getMessage());
        }
    }
    function editLuminariasRetiradasShow($id)
    {
        $item = datos_luminaria_retirada::find($id);
        $listadistritos = Distrito::where('id', '<>', 15)->get();
        $listazona = urbanizacion::all();
        $listAccesorios = lista_accesorio::all();

        $datosLum = datos_luminaria_retirada::find($id);
        $listalum = lista_luminarias_retirada::where('datos_luminaria_id', $id)->get();
        return view('plantilla.Proyectos.editarProyectoRetiradasDetalles', compact('item', 'listadistritos', 'listazona', 'listAccesorios', 'datosLum', 'listalum'));
    }
    function editretirada(Request $request, $id)
    {
        // Validaciones
        $request->validate([
            'txtzonaMod' => [
                'required',
            ],
            'txtnrosiscoMod' => [
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
            'txtfechamanteMod' => [
                'required',
            ],
            'txtproyectoMod' => [
                'required',
                'regex:/^[a-zA-Z0-9\s\.\,\(\)\/\-\+]+$/', // Letras minúsculas y mayúsculas, números, espacio y los símbolos . , ( ) / - +
            ],
            'txtdireccionMod' => [
                'required',
                'regex:/^[a-zA-Z0-9\s\.\,\(\)\/\-\+]+$/', // Letras minúsculas y mayúsculas, números, espacio y los símbolos . , ( ) / - +
            ],
            'txtdistritoMod' => 'required|digits_between:1,2', // Requerido, máximo 2 dígitos
        ]);
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

            $editNombre = $request->lumRetiradaProyEdit;
            $editReu = $request->lumReuEdit;
            $editNoReu = $request->lumNoReu;
            if ($editReu) {
                foreach ($editReu as $key => $value) {
                    $reutilizadosEdit = lista_luminarias_retirada::find($key);
                    $reutilizadosEdit->Nombre = $editNombre[$key];
                    $reutilizadosEdit->Reutilizables = $editReu[$key];
                    $reutilizadosEdit->NoReutilizables = $editNoReu[$key];
                    $reutilizadosEdit->Cantidad = $editNoReu[$key] + $editReu[$key];
                    $reutilizadosEdit->datos_luminaria_id = $id;
                    $reutilizadosEdit->save();
                }
            }


            $sql = true;
        } catch (\Throwable $th) {
            $sql = false;
        }
        if ($sql == true) {
            return redirect('/proyectos/luminariasRetiradas')->with("correcto", "Luminarias Retiradas Modificado Correctamente");
        } else {
            return back()->with("incorrecto", "Error al Modificar Luminarias Retiradas");
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function generarPDF(String $id)
    {
        $datosLum = datos_luminaria_retirada::find($id);
        $listalum = lista_luminarias_retirada::where('datos_luminaria_id', $id)->get();
        $pdf = Pdf::loadView('plantilla.Proyectos.pdfProyectosRetiradasDetalles', compact('datosLum', 'listalum'));
        return $pdf->stream('reporte_Luminarias_retiradas.pdf');
        // return  view('plantilla.Proyectos.pdfProyectosRetiradasDetalles', compact('datosLum', 'listalum'));
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
    public function destroy(datos_luminaria_retirada $id)
    {
        // Eliminar todas las filas de 'lista_luminarias_retirada' donde el 'datos_luminaria_id' sea igual al id proporcionado
        lista_luminarias_retirada::where('datos_luminaria_id', $id->id)->delete();

        // Luego eliminar la fila de 'datos_luminaria_retirada'
        $id->delete();

        // Retornar la respuesta
        return back()->with("correcto", "Datos Eliminados Correctamente");
    }
}
