<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\inspeccion;
use App\Models\distrito;
use App\Models\urbanizacion;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


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
    public function listaInspeccionEspeData(Request $request)
    {
        // Determinamos el query base dependiendo del cargo del usuario
        if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {
            $listraRealizado = inspeccion::select('id', 'Nro_Sisco', 'ZonaUrbanizacion', 'Fecha_Inspeccion', 'Foto_Carta',  'Distritos_id')
                ->where('Inspeccion', 'En Espera')
                ->orderBy('created_at', 'desc');
        } else {
            $listraRealizado = inspeccion::select('id', 'Nro_Sisco', 'ZonaUrbanizacion',  'Fecha_Inspeccion', 'Foto_Carta',  'Distritos_id')
                ->where('Distritos_id', session('Lugar_Designado'))->where('Inspeccion', 'En Espera');
        }
        // Procesamos los datos con DataTables, manejando la paginación, búsqueda y longitud
        return DataTables::of($listraRealizado)
            ->filter(function ($query) use ($request) {
                // Agrega un filtro adicional aquí si es necesario
                if ($request->has('search.value')) {
                    $search = $request->input('search.value');
                    $query->where(function ($query) use ($search) {
                        $query->where('Nro_Sisco', 'like', "%{$search}%")
                            ->orWhere('ZonaUrbanizacion', 'like', "%{$search}%")
                            ->orWhere('Distritos_id', 'like', "%{$search}%")
                            ->orWhere('Fecha_Inspeccion', 'like', "%{$search}%");
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

                // Botón de Editar con el ID del instalar
                if (auth()->user()->can('inspecciones.install')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="#" data-id="' . $row->id . '" class="menu-link px-3 edit-buttoninsperealmod" data-bs-toggle="modal" >Empezar</a>
                    </div>';
                }
                // Botón de Editar con el ID del editar
                if (auth()->user()->can('inspecciones.edit')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="#" data-id="' . $row->id . '" class="menu-link px-3 edit-buttoninspeespemod" data-bs-toggle="modal" >Editar</a>
                    </div>';
                }

                // Botón de Eliminar
                if (auth()->user()->can('inspecciones.delete')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/eliminar/inspeccion' . $row->id) . '" class="menu-link px-3 delete-link"
                            data-kt-customer-table-filter="delete_row">Eliminar</a>
                    </div>';
                }

                $actions .= '</div>';

                return $actions;
            })
            ->rawColumns(['action'])
            ->make(true);
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
                    'regex:/^[a-zA-Z0-9\s\.\,\(\)\/\-\+]+$/', // Solo letras, hasta 20 caracteres
                ],
                'txtdescripcion' => [
                    'nullable',
                    'regex:/^[a-zA-Z0-9\s\.\,\(\)\/\-\+]+$/', // Letras minúsculas, números, espacio y los símbolos . , ( ) / - + (opcional)
                ],

                'txtfecha' => 'required',
                'txtestado' => [
                    'required',
                    'regex:/^[a-zA-Z0-9\s\.\,\(\)\/\-\+]+$/', // Letras minúsculas, números, espacio y los símbolos . , ( ) / - + (opcional)

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
    public function editInspeccionespeData($id)
    {
        $editinspeEspera = inspeccion::find($id);
        return response()->json($editinspeEspera);
    }
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
    public function listaInspeccionRealData(Request $request)
    {


        // Determinamos el query base dependiendo del cargo del usuario
        if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {
            $listraRealizado = inspeccion::select('id', 'Nro_Sisco', 'ZonaUrbanizacion', 'Tipo_Inspeccion', 'Detalles', 'Fecha_Inspeccion', 'Estado', 'Foto_Carta', 'Inspeccion', 'Distritos_id')
                ->where('Inspeccion', 'Finalizado')
                ->orderBy('created_at', 'desc');
        } else {
            $listraRealizado = inspeccion::select('id', 'Nro_Sisco', 'ZonaUrbanizacion', 'Tipo_Inspeccion', 'Detalles', 'Fecha_Inspeccion', 'Estado', 'Foto_Carta', 'Inspeccion', 'Distritos_id')
                ->where('Distritos_id', session('Lugar_Designado'))->where('Inspeccion', 'Finalizado');
        }
        // Procesamos los datos con DataTables, manejando la paginación, búsqueda y longitud
        return DataTables::of($listraRealizado)
            ->filter(function ($query) use ($request) {
                // Agrega un filtro adicional aquí si es necesario
                if ($request->has('search.value')) {
                    $search = $request->input('search.value');
                    $query->where(function ($query) use ($search) {
                        $query->where('Nro_Sisco', 'like', "%{$search}%")
                            ->orWhere('ZonaUrbanizacion', 'like', "%{$search}%")
                            ->orWhere('Tipo_Inspeccion', 'like', "%{$search}%")
                            ->orWhere('Detalles', 'like', "%{$search}%")
                            ->orWhere('Fecha_Inspeccion', 'like', "%{$search}%")
                            ->orWhere('Estado', 'like', "%{$search}%");
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

                // Botón de Editar con el ID del registro
                if (auth()->user()->can('inspecciones.edit')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="#" data-id="' . $row->id . '" class="menu-link px-3 edit-buttoninsperealmod" data-bs-toggle="modal" >Editar</a>
                    </div>';
                }

                // Botón de Eliminar
                if (auth()->user()->can('inspecciones.delete')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/eliminar/inspeccion' . $row->id) . '" class="menu-link px-3 delete-link"
                            data-kt-customer-table-filter="delete_row">Eliminar</a>
                    </div>';
                }

                $actions .= '</div>';

                return $actions;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function editInspeccionRealData($id)
    {
        $editinspeRealizado = inspeccion::find($id);
        return response()->json($editinspeRealizado);
    }
    public function editRealizada(Request $request)
    {
        try {
            // Validaciones
            $request->validate([
                'txttipo' => [
                    'required',
                    'regex:/^[a-zA-ZÑñ\s]{1,50}$/', // Solo letras, incluyendo Ñ/ñ y espacios, hasta 50 caracteres
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
            $editInspec = inspeccion::find($request->textid);

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
