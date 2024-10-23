<?php

namespace App\Http\Controllers;

use App\Models\Reelevamiento;
use Illuminate\Http\Request;
use App\Models\Distrito;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

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
    public function getReelevamientosData(Request $request)
    {
        // Determinamos el query base dependiendo del cargo del usuario
        // Determinamos el query base dependiendo del cargo del usuario
        /*  if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {
            $datosReelev = reelevamiento::with('urbanizacion:id,nombre_urbanizacion')->select(
                'reelevamientos.id',
                'reelevamientos.Av_calles',
                'reelevamientos.Urbanizacion_id',
                'reelevamientos.Distritos_id',
                'reelevamientos.Fecha',
                'reelevamientos.Descripcion',
                'reelevamientos.Archivos'
            );
        } else {
            $datosReelev = reelevamiento::select(
                'id',
                'Av_calles',
                'Urbanizacion_id',
                'Distritos_id',
                'Fecha',
                'Descripcion',
                'Archivos'
            )
                ->where('Distritos_id', session('Lugar_Designado'));
        }
        // Procesamos los datos con DataTables, manejando la paginación, búsqueda y longitud
        return DataTables::of($datosReelev)
            ->filter(function ($query) use ($request) {
                // Agrega un filtro adicional aquí si es necesario
                if ($request->has('search.value')) {
                    $search = $request->input('search.value');
                    $query->where(function ($query) use ($search) {
                        $query->where('Av_calles', 'like', "%{$search}%")
                            ->orWhere('Urbanizacion_id', 'like', "%{$search}%")
                            ->orWhere('Distritos_id', 'like', "%{$search}%")
                            ->orWhere('Fecha', 'like', "%{$search}%")
                            ->orWhere('Descripcion', 'like', "%{$search}%")
                            ->orWhere('Archivos', 'like', "%{$search}%");
                    });
                }
            })

            ->addColumn('action', function ($row) {
                $actions = '<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                   Accion
                    <span class="svg-icon svg-icon-5 m-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                        </svg>
                    </span>
                </a>
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                data-kt-menu="true">';

                if (auth()->user()->can('Reelevamiento.edit')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/editardatos/reelevamiento' . $row->id) . '"  data-id="' . $row->id . '"
                            class="menu-link px-3 edit-buttonUserEdit" >Editar</a>
                    </div>';
                }


                if (auth()->user()->can('Reelevamiento.delete')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/eliminar/reelevamiento' . $row->id) . '" class="menu-link px-3 delete-link" 
                            data-kt-customer-table-filter="delete_row">Eliminar</a>
                    </div>';
                }

                $actions .= '</div>';

                return $actions;
            })
            ->rawColumns(['action'])
            ->make(true);
    } */
        if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {
            $datosReelev = reelevamiento::with('urbanizacion:id,nombre_urbanizacion')
                ->select(
                    'id',
                    'Av_calles',
                    'Urbanizacion_id',
                    'Distritos_id',
                    'Fecha',
                    'Descripcion',
                    'Archivos'
                );
        } else {
            $datosReelev = reelevamiento::with('urbanizacion:id,nombre_urbanizacion')
                ->select(
                    'id',
                    'Av_calles',
                    'Urbanizacion_id',
                    'Distritos_id',
                    'Fecha',
                    'Descripcion',
                    'Archivos'
                )
                ->where('Distritos_id', session('Lugar_Designado'));
        }

        return DataTables::of($datosReelev)
            ->filter(function ($query) use ($request) {
                if ($request->has('search.value')) {
                    $search = $request->input('search.value');
                    $query->where(function ($query) use ($search) {
                        $query->where('Av_calles', 'like', "%{$search}%")
                            ->orWhereHas('urbanizacion', function ($q) use ($search) {
                                $q->where('nombre_urbanizacion', 'like', "%{$search}%");
                            })
                            ->orWhere('Distritos_id', 'like', "%{$search}%")
                            ->orWhere('Fecha', 'like', "%{$search}%")
                            ->orWhere('Descripcion', 'like', "%{$search}%")
                            ->orWhere('Archivos', 'like', "%{$search}%");
                    });
                }
            })
            ->addColumn('nombre_urbanizacion', function ($row) {
                return $row->urbanizacion ? $row->urbanizacion->nombre_urbanizacion : '';
            })
            ->addColumn('action', function ($row) {

                $actions = '<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                       Accion
                        <span class="svg-icon svg-icon-5 m-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                            </svg>
                        </span>
                    </a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                    data-kt-menu="true">';

                if (auth()->user()->can('Reelevamiento.edit')) {
                    $actions .= '<div class="menu-item px-3">
                            <a href="' . url('/editardatos/reelevamiento' . $row->id) . '"  data-id="' . $row->id . '"
                                class="menu-link px-3 edit-buttonUserEdit" >Editar</a>
                        </div>';
                }


                if (auth()->user()->can('Reelevamiento.delete')) {
                    $actions .= '<div class="menu-item px-3">
                            <a href="' . url('/eliminar/reelevamiento' . $row->id) . '" class="menu-link px-3 delete-link" 
                                data-kt-customer-table-filter="delete_row">Eliminar</a>
                        </div>';
                }

                $actions .= '</div>';

                return $actions;
            })

            ->rawColumns(['action'])
            ->make(true);
    }


    public function create(Request $request)
    {
        try {
            // Validaciones
            $request->validate([
                'flrar' => 'required|file|mimes:rar,zip|max:40960', // Archivo opcional de máximo 40 MB
                'reeAvCalle' => [
                    'required',
                    'regex:/^[a-z0-9áéíóúñ\/\*\-\.\,\(\)\s]+$/', // Solo acepta letras minúsculas, números, espacios y símbolos
                ],

                'reeDescripRegis' => [
                    'nullable',
                    'regex:/^[A-Za-z0-9ÁÉÍÓÚÑñáéíóú\/\*\-\.\,\(\)\s]+$/', // Permite letras mayúsculas y minúsculas
                ],
                'reeDistritoRegis' => 'required|digits_between:1,2', // Requerido, máximo 2 dígitos
                'reeFechaRegis' => 'required', // Requerido, debe ser una fecha válida
                'reeUrbanizacionRegis' => 'required|digits_between:1,4',
            ]);
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error Datos invalidos, ingrese datos validos ");
        }
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
    function editardatosRelev(Request $request, $id)
    {
        $reele = reelevamiento::find($id);
        $lista = distrito::where('id', '<>', '15')->get();
        return view('plantilla.Reelevamiento.editReeLuminaria', compact('reele', 'lista'));
    }

    public function modificar(Request $request, $id)
    {
        try {
            $request->validate([
                'flrarMod' => 'file|mimes:rar,zip|max:40960', // Archivo opcional de máximo 40 MB
                'reeAvCalleMod' => [
                    'required',
                    'regex:/^[A-Za-z0-9ÁÉÍÓÚÑñáéíóú\s\.\,\(\)]+$/', // Acepta letras mayúsculas, minúsculas, números, espacio y los símbolos . , ( )
                ],
                'reeDescripRegisMod' => [
                    'required',
                    'regex:/^[A-Za-z0-9ÁÉÍÓÚÑñáéíóú\s\.\,\(\)]+$/', // Letras minúsculas, números, espacio y los símbolos . , ( ) / - + (opcional)
                ],
                'reeDistritoRegisMod' => 'required|digits_between:1,2', // Requerido, máximo 2 dígitos
                'reeFechaRegisMod' => 'required|date', // Requerido, debe ser una fecha válida
                'reeUrbanizacionRegisMod' => 'required|digits_between:1,4', // Requerido, máximo 4 dígitos
            ]);
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error Datos invalidos, ingrese datos validos ");
        }
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
            return redirect("/reelevamientos/dis/{$reeleMod->Distritos_id}")->with("correcto", "Datos Modificados Correctamente");
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
