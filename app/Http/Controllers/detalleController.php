<?php

namespace App\Http\Controllers;

use App\Models\accesorio;
use Illuminate\Http\Request;
use App\Models\detalle;
use App\Models\distrito;
use App\Models\lista_accesorio;
use App\Models\urbanizacion;
use App\Models\User;
use Illuminate\Foundation\Console\ViewMakeCommand;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class detalleController extends Controller
{
    // se encarga de mostrar todo de proyecto almacen en espera
    public function index()
    {
        /*  if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {
            $detalles = detalle::where('Estado', 'En Espera')
                ->get();
            $listadistrito = Distrito::where('id', '<>', 15)->get();
            // $listazonaurb = urbanizacion::all();
            $disApoyo = distrito::where('id', '<>', 15)->get();


            return view('plantilla.DetallesGenerales.Espera', compact('detalles', 'listadistrito', 'disApoyo'));
        } else {

            $detalles = detalle::where('Estado', 'En Espera')
                ->where('Distritos_id', session('Lugar_Designado'))->get();
            $listadistrito = Distrito::where('id', '<>', 15)
                ->where('id', session('Lugar_Designado'))->get();

            $disApoyo = distrito::where('id', '<>', 15)->get();
            // $listazonaurb = urbanizacion::all(); */
        return view('plantilla.DetallesGenerales.Espera');
    }
    public function editDatosEspera($id)
    {
        if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {
            $detallesEdit = detalle::find($id);
            $listadistritoEdit = Distrito::where('id', '<>', 15)
                ->get();
            $disApoyo = distrito::where('id', '<>', 15)->get();
            $listazonaurb = urbanizacion::all();

            return view('plantilla.DetallesGenerales.editEspera', compact('detallesEdit', 'listadistritoEdit', 'listazonaurb', 'disApoyo'));
        } else {

            $detallesEdit = detalle::find($id);
            $listadistritoEdit = Distrito::where('id', '<>', 15)
                ->where('id', session('Lugar_Designado'))->get();
            $listazonaurb = urbanizacion::all();
            $disApoyo = distrito::where('id', '<>', 15)->get();

            return view('plantilla.DetallesGenerales.editEspera', compact('detallesEdit', 'listadistritoEdit', 'listazonaurb', 'disApoyo'));
        }
    }
    public function getTrabEsperaData(Request $request)
    {
        // Determinamos el query base dependiendo del cargo del usuario
        if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {
            # code...
            $trabPendiente = detalle::select(
                'id',
                'Distritos_id',
                'Zona',
                'Nro_Sisco',
                'Foto_Carta',
                'Tipo_Trabajo',
                'Fecha_Programado',
                'Observaciones'
            )
                ->where('Estado', 'En Espera');
        } else {
            # code...
            $trabPendiente = detalle::select(
                'id',
                'Distritos_id',
                'Zona',
                'Nro_Sisco',
                'Foto_Carta',
                'Tipo_Trabajo',
                'Fecha_Programado',
                'Observaciones'
            )
                ->where('Estado', 'En Espera')->where('Distritos_id', session('Lugar_Designado'));
        }


        // Procesamos los datos con DataTables, manejando la paginación, búsqueda y longitud
        return DataTables::of($trabPendiente)
            ->filter(function ($query) use ($request) {
                // Agrega un filtro adicional aquí si es necesario
                if ($request->has('search.value')) {
                    $search = $request->input('search.value');
                    $query->where(function ($query) use ($search) {
                        $query->where('Distritos_id', 'like', "%{$search}%")
                            ->orWhere('Zona', 'like', "%{$search}%")
                            ->orWhere('Nro_Sisco', 'like', "%{$search}%")
                            ->orWhere('Tipo_Trabajo', 'like', "%{$search}%")
                            ->orWhere('Fecha_Inicio', 'like', "%{$search}%")
                            ->orWhere('Observaciones', 'like', "%{$search}%");
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
                if (auth()->user()->can('detallesGen.edit')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/editdatos/esperaa' . $row->id) . '" 
                            class="menu-link px-3">Editar</a>
                    </div>';
                }


                if (auth()->user()->can('detallesGen.delete')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/eliminar/detallegen' . $row->id) . '" class="menu-link px-3 delete-link" 
                            data-kt-customer-table-filter="delete_row">Eliminar</a>
                    </div>';
                }

                $actions .= '</div>';

                return $actions;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    // muestra la tabla de detalles de trabajos realizados
    public function realizados()
    {
        if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {

            $detallesrealizados = detalle::where('Estado', 'Finalizado')->orderBy('id', 'desc')->get();
            $listdistritos = Distrito::where('id', '<>', 15)->get();
            $listurb = urbanizacion::all();
            $disApoyo = distrito::where('id', '<>', 15)->get();

            return view('plantilla.DetallesGenerales.Realizados', compact('detallesrealizados', 'listurb', 'listdistritos', 'disApoyo'));
        } else {
            $detallesrealizados = detalle::where('Estado', 'Finalizado')->orderBy('id', 'desc')
                ->where('Distritos_id', session('Lugar_Designado'))->get();
            $listdistritos = Distrito::where('id', '<>', 15)
                ->where('id', session('Lugar_Designado'))->get();
            $disApoyo = distrito::where('id', '<>', 15)->get();
            $listurb = urbanizacion::all();
            return view('plantilla.DetallesGenerales.Realizados', compact('detallesrealizados', 'listurb', 'disApoyo', 'listdistritos'));
        }
    }
    public function getTrabajoRealizadoData(Request $request)
    {
        // Determinamos el query base dependiendo del cargo del usuario
        if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {
            # code...
            $trabPendiente = detalle::select(
                'id',
                'Distritos_id',
                'Zona',
                'Nro_Sisco',
                'Tipo_Trabajo',
                'Puntos',
                'Fecha_Inicio',
                'Foto_Carta',
                'Observaciones'
            )
                ->where('Estado', 'Finalizado');
        } else {
            # code...
            $trabPendiente = detalle::select(
                'id',
                'Distritos_id',
                'Zona',
                'Nro_Sisco',
                'Tipo_Trabajo',
                'Puntos',
                'Fecha_Inicio',
                'Foto_Carta',
                'Observaciones'
            )
                ->where('Estado', 'Finalizado')->where('Distritos_id', session('Lugar_Designado'));
        }


        // Procesamos los datos con DataTables, manejando la paginación, búsqueda y longitud
        return DataTables::of($trabPendiente)
            ->filter(function ($query) use ($request) {
                // Agrega un filtro adicional aquí si es necesario
                if ($request->has('search.value')) {
                    $search = $request->input('search.value');
                    $query->where(function ($query) use ($search) {
                        $query->where('Distritos_id', 'like', "%{$search}%")
                            ->orWhere('Zona', 'like', "%{$search}%")
                            ->orWhere('Nro_Sisco', 'like', "%{$search}%")
                            ->orWhere('Tipo_Trabajo', 'like', "%{$search}%")
                            ->orWhere('Puntos', 'like', "%{$search}%")
                            ->orWhere('Fecha_Inicio', 'like', "%{$search}%")
                            ->orWhere('Observaciones', 'like', "%{$search}%");
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
                if (auth()->user()->can('detallesGen.edit')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/detalles/realizados/edit' . $row->id) . '" 
                            class="menu-link px-3">Editar</a>
                    </div>';
                }
                if (auth()->user()->can('detallesGen.report')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/detalles/mantenimiento/pdf' . $row->id) . '" 
                            class="menu-link px-3 " target="_blank">Reporte</a>
                    </div>';
                }


                if (auth()->user()->can('detallesGen.delete')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/eliminar/detallegen' . $row->id) . '" class="menu-link px-3 delete-link" 
                            data-kt-customer-table-filter="delete_row">Eliminar</a>
                    </div>';
                }

                $actions .= '</div>';

                return $actions;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    // en esta parte en donde se llena los datos para ejecutar un trabajo
    public function ejecutar($id)
    {
        if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {
            $listadistrito = Distrito::where('id', '<>', 15)->get();
            $trabajo = detalle::find($id);
            $listacom = lista_accesorio::all();
            return view('plantilla.DetallesGenerales.EjecutarTrabajo', compact('listadistrito', 'trabajo', 'listacom'));
        } else {
            $listadistrito = Distrito::where('id', '<>', 15)
                ->where('id', session('Lugar_Designado'))->get();
            $trabajo = detalle::find($id);
            $listacom = lista_accesorio::all();
            return view('plantilla.DetallesGenerales.EjecutarTrabajo', compact('listadistrito', 'trabajo', 'listacom'));
        }
    }

    public function agendar()
    {
        if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {

            $listadistrito = Distrito::where('id', '<>', 15)->get();
            // $listazonaurb = urbanizacion::all();
            $disApoyo = distrito::where('id', '<>', 15)->get();

            return view('plantilla.Agendar.agendar', compact('listadistrito', 'disApoyo'));
        } else {
            $listadistrito = Distrito::where('id', '<>', 15)
                ->where('id', session('Lugar_Designado'))->get();
            $disApoyo = distrito::where('id', '<>', 15)->get();
            /*  $listazonaurb = urbanizacion::all(); */
            return view('plantilla.Agendar.agendar', compact('listadistrito', 'disApoyo'/* , 'listazonaurb' */));
        }
    }
    // en esta parte muestra la vista para Realizar trabajos donde esta detallados todos los trabajos a realizar pendiente
    public function pendiente()
    {
        $detall = detalle::where('Estado', 'En Espera')->orderBy('id', 'desc')
            ->where('Distritos_id', session('Lugar_Designado'))->get();

        return view('plantilla.RealizarTrabajo.trabajos', compact('detall'));
    }
    public function getTrabPendientesData(Request $request)
    {
        // Determinamos el query base dependiendo del cargo del usuario
        $trabPendiente = detalle::select(
            'id',
            'Distritos_id',
            'Zona',
            'Nro_Sisco',
            'Foto_Carta',
            'Tipo_Trabajo',
            'Fecha_Programado',
            'Observaciones'
        )
            ->where('Estado', 'En espera')->where('Distritos_id', session('Lugar_Designado'));

        // Procesamos los datos con DataTables, manejando la paginación, búsqueda y longitud
        return DataTables::of($trabPendiente)
            ->filter(function ($query) use ($request) {
                // Agrega un filtro adicional aquí si es necesario
                if ($request->has('search.value')) {
                    $search = $request->input('search.value');
                    $query->where(function ($query) use ($search) {
                        $query->where('Distritos_id', 'like', "%{$search}%")
                            ->orWhere('Zona', 'like', "%{$search}%")
                            ->orWhere('Nro_Sisco', 'like', "%{$search}%")
                            ->orWhere('Tipo_Trabajo', 'like', "%{$search}%")
                            ->orWhere('Fecha_Inicio', 'like', "%{$search}%")
                            ->orWhere('Observaciones', 'like', "%{$search}%");
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
                if (auth()->user()->can('realizar.show')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/ejecutar/trabajo/' . $row->id) . '" 
                            class="menu-link px-3">Empezar</a>
                    </div>';
                }


                if (auth()->user()->can('realizar.delete')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/eliminar/proyecto' . $row->id) . '" class="menu-link px-3 delete-link" 
                            data-kt-customer-table-filter="delete_row">Eliminar</a>
                    </div>';
                }

                $actions .= '</div>';

                return $actions;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    // para agregar  mantenimiento en espera
    public function create(Request $request)
    {
        /* dd($request->all()); */
        //se a creado un acceso directo para que pueda acceder a esa carpeta
        try {
            $request->validate([
                'txtdistirto' => 'required|digits_between:1,2',
                'txtzonaurb' => ['required',],
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
                'txtfechaprogramada' => ['required',],

            ]);
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error Datos invalidos, ingrese datos validos ");
        }

        $espera = 'En Espera';
        $tipTrabajo = '';
        $apoyo = '';
        $url = '';
        $notificar = '';
        if ($request->imgcarta) {
            $dir = $request->file('imgcarta')->store('public/fileagendar');
            $url = Storage::url($dir);
        }

        if ($request->rnotificar == 1) {
            $notificar = 'NOTIFICADO!!!';
        }
        foreach ($request->selectedStates as $tip) {
            $tipTrabajo = $tipTrabajo . ' ' . $tip;
        }
        if ($request->txtapoyo) {
            $apoyo = ' ' . 'Asistencia' . ' ' . $request->txtapoyo;
        }
        $request->validate([
            'imgcarta' => 'image|mimes:png,jpg,jpeg|max:6144' // estas son las reglas que tiene que cumplir para poder subir la imagen required| lo quitamos
        ]);
        try {

            $detalles = new detalle();
            $detalles->Distritos_id = $request->txtdistirto;
            $detalles->Zona = $request->txtzonaurb;
            $detalles->Nro_Sisco = strval($request->txtnrosisco);
            $detalles->Fecha_Programado = $request->txtfechaprogramada;
            $detalles->Tipo_Trabajo = $tipTrabajo . ' ' . $apoyo;
            if ($url) {
                $detalles->Foto_Carta = $url;
            }
            $detalles->Observaciones = $notificar;
            $detalles->Estado = $espera;
            $detalles->Users_id = session('id');
            $detalles->save();
            $sql = true;
        } catch (\Throwable $th) {
            $sql = false;
        }
        if ($sql == true) {
            return back()->with("correcto", "Datos Registrado Correctamente");
        } else {
            return back()->with("incorrecto", "Error al Agendar");
        }
    }

    public function storeTrabajo(Request $request, $id)
    {
        try {
            $request->validate([
                'txtcantidadlum' => 'required|digits_between:1,3',
                'txtfechaejecut' => [
                    'required',
                ],

            ]);
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error: Datos inválidos, ingrese datos válidos");
        }

        $tipoLuminaria = 'Tipo: ';
        $fin = 'Finalizado';
        $tipLum = '';
        if ($request->tipolum) {
            foreach ($request->tipolum as $valor) {
                $tipLum = $tipLum . ' ' . $valor;
            }
        }

        $proy = 1;

        DB::beginTransaction();  // Iniciar transacción

        try {
            // Guardar en la tabla 'detalle'
            $storetrabajo = detalle::find($id);
            $storetrabajo->Puntos = $request->txtcantidadlum;
            $storetrabajo->Fecha_Inicio = $request->txtfechaejecut;
            $storetrabajo->Detalles = $tipoLuminaria . $tipLum . '. ' . $request->txtdetalles;
            $storetrabajo->Estado = $fin;
            $storetrabajo->EjecutadoPor = session('id');
            $storetrabajo->save();

            // Verificar si los accesorios se proporcionaron correctamente
            $acccampoitem = $request->campoitem;
            $Cantidad = $request->campocantidad;

            if (!empty($acccampoitem) && count($acccampoitem) === count($Cantidad)) {
                foreach ($acccampoitem as $index => $item) {
                    // Guardar en la tabla 'accesorio'
                    $accesoriosmal = new accesorio();
                    $accesoriosmal->Id_Lista_accesorios = $item;
                    $accesoriosmal->Cantidad = $Cantidad[$index];
                    $accesoriosmal->Proyectos_id = $proy;
                    $accesoriosmal->Detalles_id = $id;
                    $accesoriosmal->save();
                }

                DB::commit();  // Confirmar transacción si todo está bien
                return redirect()->route('pendiente.trabajo')->with("correcto", "Trabajo ejecutado correctamente");
            } else {
                DB::rollBack();  // Revertir la transacción si no se proporcionaron accesorios
                return back()->with("incorrecto", "No se agregaron componentes. Datos no guardados.");
            }
        } catch (\Throwable $th) {
            DB::rollBack();  // Revertir la transacción si ocurre algún error
            return redirect()->route('pendiente.trabajo')->with("incorrecto", "Error: no se guardaron los datos.");
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

    // editar trabajoa en espera
    public function edit(Request $request, $id)
    {
        try {
            $request->validate([
                'imgcarta' => 'image|max:8048',
                'sldistrimodi' => 'required|digits_between:1,2',
                'txtzonaurb' => [
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


                'txtfechaprogramada' => [
                    'required',
                ],

            ]);
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error Datos invalidos, ingrese datos validos ");
        }
        try {
            $editdetall = detalle::find($id);

            // Manejo de la imagen
            if ($request->hasFile('imgcarta')) {
                $filePath = $editdetall->Foto_Carta;
                $filePath = 'fileagendar/' . basename($editdetall->Foto_Carta); // Construye la ruta relativa

                // Verificar si el archivo existe
                if (Storage::disk('public')->exists($filePath)) {
                    // Eliminar el archivo
                    Storage::disk('public')->delete($filePath);
                }
                $dire = $request->file('imgcarta')->store('public/fileagendar');
                $editdetall->Foto_Carta = Storage::url($dire);
            }

            // Tipo de trabajo
            $tiposTrabajo = $request->tetipTrabres;
            $editdetall->Tipo_Trabajo = implode(', ', $tiposTrabajo);

            // Apoyo a Distrito
            if (in_array('Apoyo Carro Canasta', $tiposTrabajo) && $request->filled('apoyoDistRe')) {
                $editdetall->Tipo_Trabajo .= ', Asistencia ' . $request->apoyoDistRe;
            }

            // Otros campos
            $editdetall->Distritos_id = $request->sldistrimodi;
            $editdetall->Zona = $request->txtzonaurb;
            $editdetall->Nro_Sisco = $request->txtnrosisco;
            $editdetall->Observaciones = $request->rnotificar == 1 ? 'NOTIFICADO!!!' : '';
            $editdetall->Fecha_Programado = $request->txtfechaprogramada;

            $editdetall->save();

            return redirect('/detalles/espera')->with("correcto", "Dato Modificado Correctamente");
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error al Modificar los datos");
        }
    }

    function editRealizadosShow($id)
    {
        $itemtrab = detalle::find($id);
        $detallesrealizados = detalle::where('Estado', 'Finalizado')->orderBy('id', 'desc')->get();
        $listdistritos = Distrito::where('id', '<>', 15)->get();
        $listurb = urbanizacion::all();
        $disApoyo = distrito::where('id', '<>', 15)->get();
        $listacc = accesorio::withTrashed()->where('Detalles_id', $id)->get();
        $listAccesorios = lista_accesorio::withTrashed()->select('id', 'Nombre_Item')->get();

        return view('plantilla.DetallesGenerales.EditRealizados', compact('detallesrealizados', 'listurb', 'listdistritos', 'disApoyo', 'itemtrab', 'listacc', 'listAccesorios'));
    }
    public function editRealizado(Request $request, $id)
    {
        try {
            $request->validate([
                'file1' => 'image|max:8048',
                'slDisR' => 'required|digits_between:1,2',
                'slurbr' => [
                    'required',
                ],
                'tenror' => [
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


                'text5' => 'required|digits_between:1,3',
                'dtFechaAtenr' => [
                    'required',
                ],
            ]);



            $editdetallRealizado = detalle::findOrFail($id);

            // Manejo de la imagen
            if ($request->hasFile('file1')) {
                $filePath = $editdetallRealizado->Foto_Carta;
                $filePath = 'fileagendar/' . basename($editdetallRealizado->Foto_Carta); // Construye la ruta relativa

                // Verificar si el archivo existe
                if (Storage::disk('public')->exists($filePath)) {
                    // Eliminar el archivo
                    Storage::disk('public')->delete($filePath);
                }
                $dire = $request->file('file1')->store('public/fileagendar');
                $editdetallRealizado->Foto_Carta = Storage::url($dire);
            }

            // Tipo de trabajo
            $tiposTrabajo = $request->tetipTrabrrea;
            $editdetallRealizado->Tipo_Trabajo = implode(', ', $tiposTrabajo);

            // Apoyo a Distrito
            if (in_array('Apoyo Carro Canasta', $tiposTrabajo) && $request->filled('apoyoDistRealizado')) {
                $editdetallRealizado->Tipo_Trabajo .= ', Asistencia ' . $request->apoyoDistRealizado;
            }

            // Otros campos
            $editdetallRealizado->Distritos_id = $request->slDisR;
            $editdetallRealizado->Zona = $request->slurbr;
            $editdetallRealizado->Nro_Sisco = $request->tenror;
            $editdetallRealizado->Observaciones = $request->rnotificar == 1 ? 'NOTIFICADO!!!' : '';
            $editdetallRealizado->Puntos = $request->text5;
            $editdetallRealizado->Fecha_Inicio = $request->dtFechaAtenr;

            $editdetallRealizado->save();

            $editAccItem = $request->itemReal;
            $editAccCan = $request->txtcantRea;
            if (!empty($editAccItem)) {
                foreach ($editAccItem as $key => $value) {
                    $editAcc = accesorio::find($key);
                    $editAcc->Id_Lista_accesorios = $editAccItem[$key];
                    $editAcc->Cantidad = $editAccCan[$key];
                    $editAcc->Proyectos_id = 1;
                    $editAcc->Detalles_id = $id;

                    $editAcc->save();
                }
            }

            return redirect('/detalles/realizados')->with("correcto", "Dato Modificado Correctamente");
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error al Modificar los datos: " . $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function DetallesRealizado(Request $request,  $id)
    {
        $trabajo = detalle::find($id);
        $trab = $trabajo->EjecutadoPor;
        $ejecutador = User::withTrashed()->find($trab);
        $listacc = accesorio::withTrashed()->where('Detalles_id', $id)->get();
        return view('plantilla.DetallesGenerales.DetalleRealizado', compact('trabajo', 'listacc', 'ejecutador'));
    }
    public function generarpdf($id)
    {
        $trabajo = detalle::find($id);
        $trab = $trabajo->EjecutadoPor;
        $ejecutador = User::withTrashed()->find($trab);

        $listacc = accesorio::withTrashed()->where('Detalles_id', $id)->get();
        $pdf = pdf::loadView('plantilla.DetallesGenerales.pdfDetalleRealizado', compact('trabajo', 'listacc', 'ejecutador'));
        return $pdf->stream('detalles_mantenimiento.pdf');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(detalle $id)
    {
        // Eliminar todas las filas de 'lista_luminarias_retirada' donde el 'datos_luminaria_id' sea igual al id proporcionado
        accesorio::where('Detalles_id', $id->id)->delete();

        // Luego eliminar la fila de 'datos_luminaria_retirada'
        $id->delete();

        // Retornar la respuesta
        return back()->with("correcto", "Datos Eliminados Correctamente");
    }
    //funciona para la parte de consultas luminarias -------------------------------------------------------------------------------------v
    public function datosatencion()
    {
        $datosatencion = detalle::all();
        return view('plantilla.Consultas.Atencion', [$datosatencion]);
    }
}
