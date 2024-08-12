<?php

namespace App\Http\Controllers;

use App\Models\accesorio;
use Illuminate\Http\Request;
use App\Models\detalle;
use App\Models\distrito;
use App\Models\lista_accesorio;
use App\Models\proyecto;
use App\Models\urbanizacion;
use App\Models\User;
use Illuminate\Foundation\Console\ViewMakeCommand;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class detalleController extends Controller
{

    public function index()
    {

        $detalles = detalle::where('Estado', 'En Espera')->get();
        $listadistrito = Distrito::where('id', '<>', 15)->get();
        $listazonaurb = urbanizacion::all();

        return view('plantilla.DetallesGenerales.Espera', compact('detalles', 'listadistrito', 'listazonaurb'));
    }
    public function realizados()
    {
        $detallesrealizados = detalle::where('Estado', 'Finalizado')->orderBy('id', 'desc')->get();
        $listdistritos = Distrito::where('id', '<>', 15)->get();
        $listurb = urbanizacion::all();
        return view('plantilla.DetallesGenerales.Realizados', compact('detallesrealizados', 'listurb', 'listdistritos'));
    }
    public function ejecutar($id)
    {
        $listadistrito = Distrito::where('id', '<>', 15)->get();
        $trabajo = detalle::find($id);
        $listacom = lista_accesorio::all();
        return view('plantilla.DetallesGenerales.EjecutarTrabajo', compact('listadistrito', 'trabajo', 'listacom'));
    }
    public function agendar()
    {
        $listadistrito = Distrito::where('id', '<>', 15)->get();
        $listazonaurb = urbanizacion::all();
        return view('plantilla.Agendar.agendar', compact('listadistrito', 'listazonaurb'));
    }
    // en esta parte muestra la vista Realizar trabajos donde esta detallados todos los trabajos a realizar pendiente
    public function pendiente()
    {
        $detall = detalle::where('Estado', 'En Espera')->orderBy('id', 'desc')->get();

        return view('plantilla.RealizarTrabajo.trabajos', compact('detall'));
    }

    public function detallesEspera()
    {
        $detall = detalle::where('Estado', 'En Espera')->orderBy('id', 'desc')->get();
        return view('plantilla.RealizarTrabajo.trabajos', compact('detall'));
    }

    // para agregar  mantenimiento en espera
    public function create(Request $request)
    {
        /* dd($request->all()); */
        //se a creado un acceso directo para que pueda acceder a esa carpeta
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
            'imgcarta' => 'image|max:8048'   // estas son las reglas que tiene que cumplir para poder subir la imagen required| lo quitamos
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
        $tipoLuminaria = 'Tipo: ';
        $fin = 'Finalizado';
        $tipLum = '';
        if ($request->tipolum) {
            foreach ($request->tipolum as $valor) {
                $tipLum = $tipLum . ' ' . $valor;
            }
        }


        $prov = 1;
        $proy = 1;
        try {

            $storetrabajo = detalle::find($id);
            $storetrabajo->Puntos = $request->txtcantidadlum;
            $storetrabajo->Fecha_Inicio = $request->txtfechaejecut;
            $storetrabajo->Detalles = $tipoLuminaria . $tipLum . '. ' . $request->txtdetalles;
            $storetrabajo->Estado = $fin;
            $storetrabajo->EjecutadoPor = session('id');
            $storetrabajo->save();

            $acccampoitem = $request->campoitem;
            $Cantidad = $request->campocantidad;

            if (!empty($acccampoitem) && count($acccampoitem) === count($Cantidad)) {
                foreach ($acccampoitem as $index => $item) {
                    $accesoriosmal = new accesorio();
                    $accesoriosmal->Id_Lista_accesorios = $item;
                    $accesoriosmal->Cantidad = $Cantidad[$index];
                    $accesoriosmal->Proyectos_id = $proy;
                    $accesoriosmal->Detalles_id = $id;
                    $accesoriosmal->save();
                }
            }
            $sql = true;
        } catch (\Throwable $th) {
            $sql = false;
        }
        if ($sql == true) {
            return redirect()->route('pendiente.trabajo')->with("correcto", "Trabajo Ejecutado Correctamente");
        } else {
            return redirect()->route('pendiente.trabajo')->with("incorrecto", "Error nose guardaron los datos");
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
    /* public function edit(Request $request, $id)
    {
        $tipTrabajoe = '';
        $apoyoe = '';
        $urle = '';
        if ($request->imgcarta) {
            $dire = $request->file('imgcarta')->store('public/fileagendar');
            $urle = Storage::url($dire);
        }


        foreach ($request->tetipTrabres as $tips) {
            $tipTrabajoe = $tipTrabajoe . ' ' . $tips;
        }

        if ($request->apoyoDistRe) {
            $apoyoe = ' ' . 'Asistencia' . ' ' . $request->apoyoDistRe;
        }


        $request->validate([
            'imgcarta' => 'image|max:8048'   // estas son las reglas que tiene que cumplir para poder subir la imagen required| lo quitamos
        ]);



        try {
            $editdetall = detalle::find($id);

            $editdetall->Distritos_id = $request->sldistrimodi;
            $editdetall->Zona = $request->txtzonaurb;
            $editdetall->Nro_Sisco = $request->txtnrosisco;
            $editdetall->Tipo_Trabajo = $tipTrabajoe . ' ' . $apoyoe;
            if ($urle) {
                $editdetall->Foto_Carta = $urle;
            }
            if ($request->rnotificar == 1) {
                $editdetall->Observaciones = 'NOTIFICADO!!!';
            } else {
                $editdetall->Observaciones = '';
            }

            $editdetall->Fecha_Programado = $request->txtfechaprogramada;
            $editdetall->save();
            $sql = true;
        } catch (\Throwable $th) {
            $sql = false;
        }
        if ($sql == true) {
            return back()->with("correcto", "Dato Modificado Correctamente");
        } else {
            return back()->with("incorrecto", "Error al Modificar los datos");
        }
    } */
    public function edit(Request $request, $id)
    {

        try {
            $request->validate([
                'imgcarta' => 'image|max:8048'
            ]);
            $editdetall = detalle::find($id);

            // Manejo de la imagen
            if ($request->hasFile('imgcarta')) {
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

            return back()->with("correcto", "Dato Modificado Correctamente");
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error al Modificar los datos");
        }
    }
    /* public function editRealizado(Request $request, $id)
    {
        $request->validate([
            'file1' => 'required|file|mimes:jpg,jpeg,png|max:8192'
        ]);


        try {
            $editdetallRealizado = detalle::find($id);

            // Manejo de la imagen
            if ($request->hasFile('file1')) {
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

            return back()->with("correcto", "Dato Modificado Correctamente");
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error al Modificar los datos");
        }
    }
 */
    public function editRealizado(Request $request, $id)
    {
        try {
            $request->validate([
                'file1' => 'image|max:8048'
            ]);



            $editdetallRealizado = detalle::findOrFail($id);

            // Manejo de la imagen
            if ($request->hasFile('file1')) {
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

            return back()->with("correcto", "Dato Modificado Correctamente");
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
        $ejecutador = User::find($trab);
        $listacc = accesorio::where('Detalles_id', $id)->get();
        return view('plantilla.DetallesGenerales.DetalleRealizado', compact('trabajo', 'listacc', 'ejecutador'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    //funciona para la parte de consultas luminarias -------------------------------------------------------------------------------------v
    public function datosatencion()
    {
        $datosatencion = detalle::all();
        return view('plantilla.Consultas.Atencion', [$datosatencion]);
    }
}
