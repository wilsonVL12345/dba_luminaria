<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\proyecto;
use App\Models\distrito;
use App\Models\accesorio;
use App\Models\lista_accesorio;
use App\Models\luminarias_reutilizada;
use App\Models\luminaria;
use App\Models\urbanizacion;
use Illuminate\Foundation\Console\ViewMakeCommand;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\Facades\DataTables;


class proyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {
            $today = now()->toDateString();
            $proyecto = proyecto::where('Estado', 'En espera')
                ->orderBy('id', 'desc')->get();
            $reutilizadas = luminarias_reutilizada::all();
            $accesorio = accesorio::all();
            $luminaria = luminaria::all();
            $listadistrito = Distrito::where('id', '<>', 15)->get();
            /* $listazonaurb = urbanizacion::all(); */
            return view('plantilla.Proyectos.proyectosAlmacen', [
                'proyecto' => $proyecto,
                'listadistrito' => $listadistrito,
                /*  'listazonaurb' => $listazonaurb, */
                'reutilizada' => $reutilizadas,
                'accesorio' => $accesorio,
                'luminaria' => $luminaria,
                'today' => $today

            ]);
        } else {
            $today = now()->toDateString();
            $proyecto = proyecto::where('Estado', 'En espera')
                ->orderBy('id', 'desc')
                ->where('Distritos_id', session('Lugar_Designado'))->get();

            $reutilizadas = luminarias_reutilizada::all();
            $accesorio = accesorio::all();
            $luminaria = luminaria::all();
            $listadistrito = Distrito::where('id', '<>', 15)
                ->where('id', session('Lugar_Designado'))->get();

            /* $listazonaurb = urbanizacion::all(); */
            return view('plantilla.Proyectos.proyectosAlmacen', [
                'proyecto' => $proyecto,
                'listadistrito' => $listadistrito,
                /*  'listazonaurb' => $listazonaurb, */
                'reutilizada' => $reutilizadas,
                'accesorio' => $accesorio,
                'luminaria' => $luminaria,
                'today' => $today

            ]);
        }
    }
    public function getProyectoData(Request $request)
    {
        // Determinamos el query base dependiendo del cargo del usuario
        if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {
            $proyAlmacen = proyecto::select(
                'id',
                'Cuce_Cod',
                'Distritos_id',
                'Zona',
                'Fecha_Programada',
                'Tipo_Contratacion',
                'Subasta',
                'Proveedor'
            )
                ->where('Estado', 'En espera');
        } else {
            $proyAlmacen = proyecto::select(
                'id',
                'Cuce_Cod',
                'Distritos_id',
                'Zona',
                'Fecha_Programada',
                'Tipo_Contratacion',
                'Subasta',
                'Proveedor'
            )
                ->where('Distritos_id', session('Lugar_Designado'))
                ->where('Estado', 'En espera');
        }

        // Procesamos los datos con DataTables, manejando la paginación, búsqueda y longitud
        return DataTables::of($proyAlmacen)
            ->filter(function ($query) use ($request) {
                // Agrega un filtro adicional aquí si es necesario
                if ($request->has('search.value')) {
                    $search = $request->input('search.value');
                    $query->where(function ($query) use ($search) {
                        $query->where('Cuce_Cod', 'like', "%{$search}%")
                            ->orWhere('Distritos_id', 'like', "%{$search}%")
                            ->orWhere('Zona', 'like', "%{$search}%")
                            ->orWhere('Fecha_Programada', 'like', "%{$search}%")
                            ->orWhere('Tipo_Contratacion', 'like', "%{$search}%")
                            ->orWhere('Subasta', 'like', "%{$search}%")
                            ->orWhere('Proveedor', 'like', "%{$search}%");
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
                if (auth()->user()->can('proyecto.install')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/datos/ejecutar/' . $row->id) . '" 
                            class="menu-link px-3">Instalar</a>
                    </div>';
                }
                if (auth()->user()->can('proyecto.edit')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/showModificar/almacen/' . $row->id) . '" 
                            class="menu-link px-3">Editar</a>
                    </div>';
                }
                if (auth()->user()->can('proyecto.report')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/Almacen/detalles/pdf' . $row->id) . '" 
                            class="menu-link px-3 " target="_blank">Reporte</a>
                    </div>';
                }

                if (auth()->user()->can('proyecto.delete')) {
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

    // para guardar datos en proyectos almacen 
    public function create(Request $request)
    {
        // Validaciones
        // dd($request->all());
        try {
            //code...
            $request->validate([
                'txtcod' => 'required|string|max:16', // Requerido, máximo 16 dígitos
                'txtdistrito' => 'required|digits_between:1,2', // Requerido, máximo 2 dígitos
                'txtzona' => [
                    'required',
                ],
                'txttipo' => 'required|string|max:10',

                'dtfecha' => [
                    'required',
                ],
                'txtmodalidad' => 'required|string|max:5',

                'txtobjeto' => [
                    'required',
                    'regex:/^[a-zA-Z0-9\s\.\,\(\)\/\-\+]+$/', // Letras minúsculas y mayúsculas, números, espacio y los símbolos . , ( ) / - +
                ],
                'txtsubasta' => 'required|string|max:2',

                'txtproveedor' => [
                    'required',
                    'regex:/^[a-zA-Z0-9\s\.\,\(\)\/\-\+]+$/', // Letras minúsculas y mayúsculas, números, espacio y los símbolos . , ( ) / - +
                ],

            ]);
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error Datos invalidos, ingrese datos validos ");
        }
        // dd($request);
        $listaTipo = '';
        foreach ($request->selectedStates as $key => $value) {
            $listaTipo .= $value . ' ';
        }
        $sinDetalle = 1;
        $cero = 0;
        $espera = 'En espera';
        /*  dd($request->all()); */
        /* if se encarga de  verificar si los campos estan llenos y si no  notifica y se sale  */
        if (!empty($request->campocod) || !empty($request->camponom) || !empty($request->campocomponentes)) {
            try {


                $proy = new proyecto();
                $proy->Cuce_Cod = $request->txtcod;
                $proy->Distritos_id = $request->txtdistrito;
                $proy->Zona = $request->txtzona;
                $proy->Tipo_Contratacion = $request->txttipo;
                $proy->Estado = $espera;
                $proy->Fecha_Programada = $request->dtfecha;
                $proy->Modalidad = $request->txtmodalidad;
                $proy->Objeto_Contratacion = $request->txtobjeto;
                $proy->Subasta = $request->txtsubasta;
                $proy->Tipo_Componentes = $listaTipo;
                $proy->Proveedor = $request->txtproveedor;
                $proy->Users_id = session('id');
                // $proy->Trabajo = $request->sltrabajo;
                $proy->save();
                $cuceProyecto = proyecto::where('Cuce_Cod', $request->txtcod)->first();
                $idProyecto = $cuceProyecto->id;
                /* variables de accesorios */
                $acceComponentes = $request->campocomponentes;
                $acceCantidad = $request->campocantidad;
                /* $acceObservaciones = $request->campoobservaciones; */
                /* $acceproveedor = $request->campoproveedo; */

                if (!empty($acceComponentes)) {
                    foreach ($acceComponentes as $key => $value) {
                        $nuevoAccesorio = new accesorio();
                        $nuevoAccesorio->Id_Lista_accesorios = $acceComponentes[$key]['txtcomponentes'];
                        $nuevoAccesorio->Cantidad = $acceCantidad[$key]['txtcantidad'];
                        $nuevoAccesorio->Disponibles = $acceCantidad[$key]['txtcantidad'];
                        $nuevoAccesorio->Proyectos_id = $idProyecto;
                        $nuevoAccesorio->Utilizados = $cero;
                        $nuevoAccesorio->Detalles_id = $sinDetalle;

                        $nuevoAccesorio->save();
                    }
                }

                /* variables de Luminarias Reutilizada */
                $reuNombre = $request->camponom;
                $reuCant = $request->campocant;
                /*  $reuObser = $request->campoobs; */
                if ($reuNombre) {
                    foreach ($reuNombre as $key => $value) {

                        $nuevoReutilizado = new luminarias_reutilizada();
                        $nuevoReutilizado->Nombre_Item = $reuNombre[$key]['txtnom'];
                        $nuevoReutilizado->Cantidad = $reuCant[$key]['txtcant'];
                        $nuevoReutilizado->Disponibles = $reuCant[$key]['txtcant'];
                        $nuevoReutilizado->Utilizados = $cero;
                        $nuevoReutilizado->Proyectos_id = $idProyecto;
                        $nuevoReutilizado->save();
                    }
                }

                /* variables para luminaria tipo LED */
                $ledcod = $request->campocod;
                $ledpotencia = $request->campopotencia;
                $ledmarca = $request->campomarca;
                $ledmodelo = $request->campomodelo;
                if (!empty($ledcod)) {
                    foreach ($ledcod as $key => $value) {
                        # code...
                        $nuevoLed = new luminaria();
                        $nuevoLed->Cod_Luminaria = $ledcod[$key]['txtcod'];
                        $nuevoLed->Potencia = $ledpotencia[$key]['txtpotencia'];
                        $nuevoLed->Marca = $ledmarca[$key]['txtmarca'];
                        $nuevoLed->Modelo = $ledmodelo[$key]['txtmodelo'];
                        $nuevoLed->Proyectos_id = $idProyecto;
                        $nuevoLed->Detalles_id = $sinDetalle;

                        $nuevoLed->save();
                    }
                }
                $sql = true;
            } catch (\Throwable $th) {
                $sql = false;
            }
            if ($sql == true) {
                return back()->with("correcto", "Datos registrados Correctamente");
            } else {
                return back()->with("incorrecto", "Error al registrar Datos invalidos");
            }
        } else {
            return back()->with("incorrecto", "Error al registrar no agregaste componentes");
        }
    }
    function editShowObras(Request $request, $id)
    {

        $proyec = proyecto::find($id);
        $reutilizada = luminarias_reutilizada::where('Proyectos_id', $id)->get();
        $accesorios = accesorio::where('Proyectos_id', $id)->get();
        $luminaria = luminaria::where('Proyectos_id', $id)->get();
        $listadistrito = Distrito::where('id', '<>', 15)->get();
        $listAccesorios = lista_accesorio::all();
        return view('plantilla.Proyectos.editarProyectoObras', compact('id', 'proyec', 'reutilizada', 'accesorios', 'luminaria', 'listadistrito', 'listAccesorios'));
    }
    function editShowEsperaAlmacen(Request $request, $id)
    {

        $proyec = proyecto::find($id);
        $reutilizada = luminarias_reutilizada::where('Proyectos_id', $id)->get();
        $accesorios = accesorio::where('Proyectos_id', $id)->get();
        $luminaria = luminaria::where('Proyectos_id', $id)->get();
        $listadistrito = Distrito::where('id', '<>', 15)->get();
        $listAccesorios = lista_accesorio::all();
        return view('plantilla.Proyectos.editarProyectoAlmacen', compact('id', 'proyec', 'reutilizada', 'accesorios', 'luminaria', 'listadistrito', 'listAccesorios'));
    }

    function editEsperaAlmacen(Request $request, $id)
    {
        try {
            // Validaciones
            $request->validate([
                'txtcodProyEsp' => 'required|string|max:16', // Requerido, máximo 2 dígitos
                'sldisProyEsp' => 'required|digits_between:1,2', // Requerido, máximo 2 dígitos

                'slUrbproyEsp' => [
                    'required',
                ],
                'sltipContraProyEsp' => 'required|string|max:10',

                'slsubproEsp' => 'required|string|max:2',
                'txtmodProyEsp' => 'required|string|max:5', // Requerido, máximo 5 dígitos
                'txtfechaEsp' => [
                    'required',
                ],
                'txtobjetoEsp' => [
                    'required',
                    'regex:/^[a-zA-Z0-9\s\.\,\(\)\/\-\+]+$/', // Letras minúsculas y mayúsculas, números, espacio y los símbolos . , ( ) / - +
                ],
                'txtprovProyEsp' => [
                    'required',
                    'regex:/^[a-zA-Z0-9\s\.\,\(\)\/\-\+]+$/', // Letras minúsculas y mayúsculas, números, espacio y los símbolos . , ( ) / - +
                ],


            ]);
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error Datos invalidos, ingrese datos validos ");
        }


        try {
            $editProy = proyecto::find($id);

            $editProy->Cuce_Cod = $request->txtcodProyEsp;
            $editProy->Distritos_id = $request->sldisProyEsp;
            $editProy->Zona = $request->slUrbproyEsp;
            $editProy->Tipo_Contratacion = $request->sltipContraProyEsp;
            $editProy->Subasta = $request->slsubproEsp;
            $editProy->Modalidad = $request->txtmodProyEsp;
            $editProy->Fecha_Programada = $request->txtfechaEsp;
            $editProy->Objeto_Contratacion = $request->txtobjetoEsp;
            $editProy->Proveedor = $request->txtprovProyEsp;
            // $editProy->Trabajo = $request->slTrabajom;

            $editProy->save();

            $reuNombre = $request->txtReuAlmacen;
            $reuCan = $request->txtReuAlmacenCan;

            $accItem = $request->editAlmacenItem;
            $accCan = $request->editAlmacenCan;

            $lumCod = $request->lumCodEdit;
            $lumMar = $request->lumMarEdit;
            $lumMod = $request->lumModEdit;
            $lumPot = $request->lumPotEdit;

            if ($reuNombre) {
                foreach ($reuNombre as $key => $value) {
                    $editReu = luminarias_reutilizada::find($key);
                    $editReu->Nombre_Item = $reuNombre[$key];
                    $editReu->Cantidad = $reuCan[$key];
                    $editReu->Disponibles = $reuCan[$key];
                    $editReu->Utilizados = 0;
                    $editReu->Proyectos_id = 1;
                    $editReu->save();
                }
            }
            if ($accItem) {
                foreach ($accItem as $key => $value) {
                    $editAcc = accesorio::find($key);
                    $editAcc->Id_Lista_accesorios = $accItem[$key];
                    $editAcc->Cantidad = $accCan[$key];
                    $editAcc->Proyectos_id = $id;
                    $editAcc->Utilizados = 0;
                    $editAcc->Disponibles = $accCan[$key];
                    $editAcc->Detalles_id = 1;
                    $editAcc->save();
                }
            }
            if ($lumCod) {
                foreach ($lumCod as $key => $value) {
                    $editLum = luminaria::find($key);
                    $editLum->Cod_Luminaria = $lumCod[$key];
                    $editLum->Marca = $lumMar[$key];
                    $editLum->Modelo = $lumMod[$key];
                    $editLum->Potencia = $lumPot[$key];
                    $editLum->Proyectos_id = $id;
                    $editLum->Detalles_id = 1;
                    $editLum->save();
                }
            }

            $sql = true;
        } catch (\Throwable $th) {
            $sql = false;
        }
        if ($sql == true) {
            return redirect('/proyectos/almacen')->with("correcto", "Datos Modificados Correctamente");
        } else {
            return back()->with("incorrecto", "Error al Modificar Datos invalidos");
        }
    }

    public function edit(string $id)
    {
        //
    }
    // muestra todos los datos detallados de proyecto almacen ejecutado toda la lista de los accesorios ,luminarias y reutilzadas
    //emvia todos los datos necesarios para luminarias reutilizadas con su fk
    public function reu($id)
    {
        $proyec = proyecto::find($id);
        $reutilizada = luminarias_reutilizada::where('Proyectos_id', $id)->get();
        $accesorios = accesorio::where('Proyectos_id', $id)->get();
        $luminaria = luminaria::where('Proyectos_id', $id)->get();
        $ejecutador = user::find($proyec->Realizado_Por);

        return view('plantilla.Proyectos.proyectoDetalles', compact('luminaria', 'accesorios', 'reutilizada', 'proyec', 'ejecutador'));
    }
    public function generarPdf($id)
    {
        $proyec = proyecto::find($id);
        $reutilizada = luminarias_reutilizada::where('Proyectos_id', $id)->get();
        $accesorios = accesorio::where('Proyectos_id', $id)->get();
        $luminaria = luminaria::where('Proyectos_id', $id)->get();
        $ejecutador = user::find($proyec->Realizado_Por);

        $pdf = Pdf::loadView('plantilla.Proyectos.pdfProyAlmacenDetalles', compact('luminaria', 'accesorios', 'reutilizada', 'proyec', 'ejecutador'));

        return $pdf->stream('reporte_Proyecto.pdf');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    //esta parte se encarga de emviar todos los datos necesarios para dar con la ejecucion de los proyectos de almacen
    public function ejecutarProyectodatos($id)
    {
        $ejecProyecto = proyecto::find($id);
        $ejecAccesorios = accesorio::where('Proyectos_id', $id)->get();
        $ejecReutilizados = luminarias_reutilizada::where('Proyectos_id', $id)->get();
        $ejecLuminarias = luminaria::where('Proyectos_id', $id)->get();
        $listadistrito = distrito::where('id', '<>', '15')->get();

        $zonaUrbSelecionada = $ejecProyecto->Zona;
        /*  $calleAv = urbanizacion::where('nombre_urbanizacion', $zonaUrbSelecionada)->get(); */

        return view('plantilla.Proyectos.almacenEjecutarProyecto', compact('ejecProyecto', 'ejecAccesorios', 'ejecReutilizados', 'ejecLuminarias', 'listadistrito'/* , 'calleAv' */));
    }
    //en esta parte registra todo el trabajo hecho   en proyecto almacen
    public function registrarTrabajo(Request $request, $idp)
    {
        try {
            // Validaciones
            $request->validate([
                'txtejec' => 'required|string|max:8',  // Requerido, máximo 16 dígitos

                'txtfechaInst' => [
                    'required',
                ],
                'sltrabajo' => 'required|string|max:8', // Requerido, máximo 10 dígitos

            ]);
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error Datos invalidos, ingrese datos validos ");
        }

        $fin = 'Finalizado';
        $regisProyectoEjec = proyecto::find($idp);
        $regisProyectoEjec->Ejecutado_Por = $request->txtejec;
        $regisProyectoEjec->Estado = $fin;
        $regisProyectoEjec->Realizado_Por = session('id');
        $regisProyectoEjec->Fecha_Ejecutada = $request->txtfechaInst;
        $regisProyectoEjec->Trabajo = $request->sltrabajo;
        $regisProyectoEjec->save();
        try {
            if ($request->utilizadosreu) {
                # code...
                foreach ($request->input('utilizadosreu') as $idreu => $utilizadosreu) {
                    $regisrea = luminarias_reutilizada::find($idreu);
                    if ($regisrea) {
                        if ($utilizadosreu <= $regisrea->Disponibles && $utilizadosreu > 0) {
                            $regisrea->Utilizados = $regisrea->Utilizados + $utilizadosreu;
                            $regisrea->Disponibles = $regisrea->Cantidad - $regisrea->Utilizados;
                            $regisrea->save();
                        } else {
                            if ($utilizadosreu) {
                                return back()->with("incorrecto", "Cantidad de luminarias Reacondicionadas no disponible");
                                # code...
                            } else {
                                # code...
                            }
                        }
                    }
                }
            }
            if ($request->utilizadoacc) {
                foreach ($request->input('utilizadoacc') as $idacc => $utilizadoacc) {
                    $regisaccesorio = accesorio::find($idacc);
                    if ($regisaccesorio) {
                        if ($utilizadoacc <= $regisaccesorio->Disponibles && $utilizadoacc > 0) {

                            $regisaccesorio->Utilizados = $regisaccesorio->Utilizados + $utilizadoacc;
                            $regisaccesorio->Disponibles = $regisaccesorio->Cantidad - $regisaccesorio->Utilizados;
                            $regisaccesorio->save();
                        } else {
                            if ($utilizadoacc) {
                                return back()->with("incorrecto", "Cantidad de Accesorios no disponible");
                                # code...
                            } else {
                                # code...
                            }
                        }
                    }
                }
            }
            if ($request->lugarlum) {
                foreach ($request->input('lugarlum') as $idled => $lugarlum) {
                    $regisled = luminaria::find($idled);
                    if ($regisled) {
                        if ($lugarlum) {

                            $regisled->Lugar_Instalado = $lugarlum;
                            $regisled->save();
                        }
                    }
                }
            }
            $sql = true;
        } catch (\Throwable $th) {
            $sql = false;
        }
        if ($sql == true) {
            return redirect(route('proyectos.ObrasEjecutadas'))->with("correcto", "Trabajo Finalizado con Exito");
        } else {
            return back()->with("incorrecto", "Trabajo Fallido datos Incoerentes");
        }
    }
    //proyecto obras ejecutadas ---------------------------------------------------------------------------------------------------------
    public function datosObras()
    {
        if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {
            $proyectoObras = proyecto::where('Estado', 'Finalizado')
                ->orderBy('id', 'desc')
                ->get();
            $reutilizadas = luminarias_reutilizada::all();
            $accesorio = accesorio::all();
            $luminaria = luminaria::all();
            $listadistrito = Distrito::where('id', '<>', 15)->get();
            /* $listazonaurb = urbanizacion::all(); */

            return view('plantilla.Proyectos.proyectosObrasEjecutadas', [
                'proyectoObras' => $proyectoObras,
                'listadistrito' => $listadistrito,
                /* 'listazonaurb' => $listazonaurb, */
                'reutilizada' => $reutilizadas,
                'accesorio' => $accesorio,
                'luminaria' => $luminaria

            ]);
        } else {
            $proyectoObras = proyecto::where('Estado', 'Finalizado')
                ->orderBy('id', 'desc')
                ->where('Distritos_id', session('Lugar_Designado'))->get();

            $reutilizadas = luminarias_reutilizada::all();
            $accesorio = accesorio::all();
            $luminaria = luminaria::all();
            $listadistrito = Distrito::where('id', '<>', 15)
                ->where('id', session('Lugar_Designado'))->get();

            /* $listazonaurb = urbanizacion::all(); */

            return view('plantilla.Proyectos.proyectosObrasEjecutadas', [
                'proyectoObras' => $proyectoObras,
                'listadistrito' => $listadistrito,
                /* 'listazonaurb' => $listazonaurb, */
                'reutilizada' => $reutilizadas,
                'accesorio' => $accesorio,
                'luminaria' => $luminaria

            ]);
        }
    }
    public function getProyectoObrasData(Request $request)
    {
        // Determinamos el query base dependiendo del cargo del usuario
        if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {
            $proyAlmacenObras = proyecto::select(
                'id',
                'Cuce_Cod',
                'Distritos_id',
                'Zona',
                'Fecha_Programada',
                'Tipo_Componentes',
                'Ejecutado_Por',
            )
                ->where('Estado', 'Finalizado');
        } else {
            $proyAlmacenObras = proyecto::select(
                'id',
                'Cuce_Cod',
                'Distritos_id',
                'Zona',
                'Fecha_Programada',
                'Tipo_Componentes',
                'Ejecutado_Por',
            )
                ->where('Distritos_id', session('Lugar_Designado'))
                ->where('Estado', 'Finalizado');
        }

        // Procesamos los datos con DataTables, manejando la paginación, búsqueda y longitud
        return DataTables::of($proyAlmacenObras)
            ->filter(function ($query) use ($request) {
                // Agrega un filtro adicional aquí si es necesario
                if ($request->has('search.value')) {
                    $search = $request->input('search.value');
                    $query->where(function ($query) use ($search) {
                        $query->where('Cuce_Cod', 'like', "%{$search}%")
                            ->orWhere('Distritos_id', 'like', "%{$search}%")
                            ->orWhere('Zona', 'like', "%{$search}%")
                            ->orWhere('Fecha_Programada', 'like', "%{$search}%")
                            ->orWhere('Tipo_Componentes', 'like', "%{$search}%")
                            ->orWhere('Ejecutado_Por', 'like', "%{$search}%");
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
                if (auth()->user()->can('proyecto.install')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/datos/ejecutar/' . $row->id) . '" 
                            class="menu-link px-3">Terminar Ins</a>
                    </div>';
                }
                if (auth()->user()->can('proyecto.edit')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/showModificar/obras/' . $row->id) . '" 
                            class="menu-link px-3">Editar</a>
                    </div>';
                }
                if (auth()->user()->can('proyecto.report')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/Almacen/detalles/pdf' . $row->id) . '" 
                            class="menu-link px-3 " target="_blank">Reporte</a>
                    </div>';
                }

                if (auth()->user()->can('proyecto.delete')) {
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
    function editObrasEjecutadas(Request $request, $id)
    {
        try {
            // Validaciones
            $request->validate([
                'txtcodProyObras' => 'required|string|max:16', // Requerido, máximo 16 dígitos
                'sldisProyObras' => 'required|digits_between:1,2', // Requerido, máximo 2 dígitos
                'slUrbproyObras' => [
                    'required',
                ],
                'sltipContraProyObras' => 'required|string|max:10', // Requerido, máximo 10 dígitos
                'txtmodProyObras' => 'required|string|max:5', // Requerido, máximo 5 dígitos
                'slEjeproObras' => 'required|string|max:8', // Requerido, máximo 16 dígitos
                'txtfechaObras' => [
                    'required',
                ],
                'slsubproObras' => 'required|string|max:2',

                'txtobjetoObras' => [
                    'required',
                    'regex:/^[a-zA-Z0-9\s\.\,\(\)\/\-\+]+$/', // Letras minúsculas y mayúsculas, números, espacio y los símbolos . , ( ) / - +
                ],

                'txtprovProyObras' => [
                    'required',
                    'regex:/^[a-zA-Z0-9\s\.\,\(\)\/\-\+]+$/', // Letras minúsculas y mayúsculas, números, espacio y los símbolos . , ( ) / - +
                ],
                'slTrabaObras' => 'required|string|max:8', // Requerido, máximo 10 dígitos


            ]);
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error Datos invalidos, ingrese datos validos ");
        }
        try {
            $editRea = proyecto::find($id);
            $editRea->Cuce_Cod = $request->txtcodProyObras;
            $editRea->Distritos_id = $request->sldisProyObras;
            $editRea->Zona = $request->slUrbproyObras;
            $editRea->Tipo_Contratacion = $request->sltipContraProyObras;
            $editRea->Modalidad = $request->txtmodProyObras;
            $editRea->Ejecutado_Por = $request->slEjeproObras;
            $editRea->Fecha_Ejecutada = $request->txtfechaObras;
            $editRea->Subasta = $request->slsubproObras;
            $editRea->Objeto_Contratacion = $request->txtobjetoObras;
            $editRea->Proveedor = $request->txtprovProyObras;
            $editRea->Trabajo = $request->slTrabaObras;
            $editRea->save();

            $reuNomb = $request->obrasLumReuNombreEdit;
            $reuCant = $request->obrasLumReuCanEdit;
            $reuUtil = $request->obrasLumReuUtilEdit;
            $reuDisp = $request->obrasLumReuDisEdit;




            if ($reuNomb) {
                foreach ($reuNomb as $key => $value) {
                    $editReu = luminarias_reutilizada::find($key);
                    $editReu->Nombre_Item = $reuNomb[$key];
                    if ($reuCant[$key] >= $editReu->Utilizados) {
                        # code...
                        $editReu->Cantidad = $reuCant[$key];
                        $editReu->Utilizados = $editReu->Utilizados;
                        $editReu->Disponibles = $reuCant[$key] - $editReu->Utilizados;
                        $editReu->Proyectos_id = $id;
                        $editReu->save();
                    } else {
                        return back()->with("incorrecto", "Error al Modificar");
                    }
                }
            }

            $obrasItem = $request->obraAccItem;
            $obrasCant = $request->obrasAccEditCan;
            $obrasUtil = $request->obrasAccEditUtil;
            $obrasDisp = $request->obrasAccEditDis;

            if ($obrasItem) {
                foreach ($obrasItem as $key => $value) {
                    $editAcc = accesorio::find($key);

                    if ($obrasCant[$key] >= $editAcc->Utilizados) {
                        $editAcc->Id_Lista_accesorios = $obrasItem[$key];
                        # code...
                        $editAcc->Cantidad = $obrasCant[$key];
                        $editAcc->Utilizados = $editAcc->Utilizados;
                        $editAcc->Disponibles = $obrasCant[$key] - $editAcc->Utilizados;
                        $editAcc->Proyectos_id = $id;
                        $editAcc->save();
                    } else {
                        return back()->with("incorrecto", "Cantidad insuficientes");
                    }
                }
            }

            $lumCodi = $request->obraslumEditCod;
            $lumMarc = $request->obraslumEditMar;
            $lumMode = $request->obraslumEditMod;
            $lumPote = $request->obraslumEditPot;
            $lumLuga = $request->obraLugarEdit;
            if ($lumCodi) {
                foreach ($lumCodi as $key => $value) {
                    $editlum = luminaria::find($key);
                    $editlum->Cod_Luminaria = $lumCodi[$key];
                    $editlum->Marca = $lumMarc[$key];
                    $editlum->Modelo = $lumMode[$key];
                    $editlum->Potencia = $lumPote[$key];
                    $editlum->Lugar_Instalado = $lumLuga[$key];
                    $editlum->Proyectos_id = $id;
                    $editlum->Detalles_id = 1;
                    $editlum->save();
                }
            }

            $sql = true;
        } catch (\Throwable $th) {
            $sql = false;
        }
        if ($sql == true) {
            return redirect('/proyectos/ObrasEjecutadas')->with("correcto", "Modificado Correctamente");
        } else {
            return back()->with("incorrecto", "Error al Modificar");
        }
    }

    public function destroy(proyecto $id)
    {
        // Eliminar todas las filas de 'lista_luminarias_retirada' donde el 'datos_luminaria_id' sea igual al id proporcionado
        accesorio::where('Proyectos_id', $id->id)->delete();
        luminaria::where('Proyectos_id', $id->id)->delete();
        luminarias_reutilizada::where('Proyectos_id', $id->id)->delete();

        // Luego eliminar la fila de 'datos_luminaria_retirada'
        $id->delete();

        // Retornar la respuesta
        return back()->with("correcto", "Datos Eliminados Correctamente");
    }

    public function dashproy()
    {
        $dash = proyecto::all();
        return view('plantilla.Dashboards.dashProyectos', compact('dash'));
    }
    public function dashdetall()
    {
        $dashdetalles = proyecto::all();
        return view('plantilla.Dashboards.dashdetalles', compact('dashdetalles'));
    }
}
