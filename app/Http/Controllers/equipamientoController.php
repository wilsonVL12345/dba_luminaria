<?php

namespace App\Http\Controllers;

use App\Models\distrito;
use Illuminate\Http\Request;
use App\Models\equipamiento;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class equipamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Verifica si el parámetro se está recibiendo

        $lista = Distrito::where('id', '<>', 15)
            ->get();


        return view('plantilla.Equipos.Equipamiento', ['lista' => $lista]);
    }
    public function listaEquipamientoData(Request $request)
    {



        // Determinamos el query base dependiendo del cargo del usuario
        if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {
            $listraEquipamiento = equipamiento::query();
        } else {
            $listraEquipamiento = equipamiento::where('Distritos_id', session('Lugar_Designado'));
        }
        // Procesamos los datos con DataTables, manejando la paginación, búsqueda y longitud
        return DataTables::of($listraEquipamiento)
            ->filter(function ($query) use ($request) {
                // Agrega un filtro adicional aquí si es necesario
                if ($request->has('search.value')) {
                    $search = $request->input('search.value');
                    $query->where(function ($query) use ($search) {
                        $query->where('Nombre_Item', 'like', "%{$search}%")
                            ->orWhere('Descripcion', 'like', "%{$search}%")
                            ->orWhere('estado', 'like', "%{$search}%")
                            ->orWhere('Distritos_id', 'like', "%{$search}%");
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
                if (auth()->user()->can('equipamiento.edit')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="#" data-id="' . $row->id . '" class="menu-link px-3 edit-buttonequimod" data-bs-toggle="modal" >Editar</a>
                    </div>';
                }

                // Botón de Eliminar
                if (auth()->user()->can('equipamiento.delete')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/eliminar/equipamiento/' . $row->id) . '" class="menu-link px-3 delete-link"
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
        // Validaciones
        $request->validate([
            'txtnombre' => [
                'required',
                'regex:/^[a-zA-Z0-9\s\.\,\(\)\/\-\+]+$/', // Letras minúsculas y mayúsculas, números, espacio y los símbolos . , ( ) / - +
            ],
            'txtdescripcion' => [
                'nullable',
                'regex:/^[a-z0-9\s\.\,\(\)\/\-\+]*$/', // Letras minúsculas, números, espacio y los símbolos . , ( ) / - + (opcional)
            ],
            'txtdistrito' => 'required|digits_between:1,2', // Requerido, máximo 2 dígitos
            'txtestado' => [
                'required',
                'regex:/^[a-zA-Z\s]{1,40}$/', // Acepta letras y espacios, hasta 40 caracteres
            ],

        ]);

        try {
            $equipamiento = new equipamiento();

            $equipamiento->Nombre_Item = $request->txtnombre;
            $equipamiento->Descripcion = $request->txtdescripcion;
            $equipamiento->estado = $request->txtestado;
            $equipamiento->Distritos_id = $request->txtdistrito;
            $equipamiento->save();
            $sql = true;
        } catch (\Throwable $th) {
            $sql = false;
        }
        if ($sql == true) {
            return back()->with("correcto", "Equipamiento Registrado Correctamente");
        } else {
            return back()->with("incorrecto", "Error al Registrar");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    // vista de  equipamientos divididos por distritos
    public function showEquipDistrito(Request $request)
    {
        if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {

            $lista = Distrito::where('id', '<>', 15)
                ->get();
        } else {
            $lista = Distrito::where('id', '<>', 15)
                ->where('id', session('Lugar_Designado'))->get();
        }
        // Agrupar por distritos_id y contar los registros
        $grupEquip = Equipamiento::select('distritos_id', DB::raw('COUNT(*) as total'))
            ->groupBy('distritos_id')
            ->get();

        // Crear un array para almacenar los conteos de los distritos 1 al 14
        $equipamientosPorDistrito = [];

        for ($i = 1; $i <= 14; $i++) {
            // Obtener el conteo específico para cada distrito
            $equipamientosPorDistrito[$i] = $grupEquip->firstWhere('distritos_id', $i)->total ?? 0;
        }

        return view('plantilla.Equipos.EquipomiendoDistrito', compact('lista', 'equipamientosPorDistrito'));
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
    public function editdatos($id)
    {
        $equipamientoDatos = equipamiento::find($id);
        return response()->json($equipamientoDatos);
    }
    public function edit(Request $request)
    {
        try {
            // Validaciones
            $request->validate([
                'txtnombre' => [
                    'required',
                    'regex:/^[a-zA-Z0-9\s\.\,\(\)\/\-\+]+$/', // Letras minúsculas y mayúsculas, números, espacio y los símbolos . , ( ) / - +
                ],
                'txtdescripcion' => [
                    'nullable',
                    'regex:/^[a-zA-Z0-9\s\.\,\(\)\/\-\+]+$/', // Letras minúsculas, números, espacio y los símbolos . , ( ) / - + (opcional)
                ],
                'txtdistrito' => 'required|digits_between:1,2', // Requerido, máximo 2 dígitos
                'txtestado' => [
                    'required',
                    'regex:/^[a-zA-Z0-9\s\.\,\(\)\/\-\+]+$/', // Solo letras, hasta 20 caracteres
                ],

            ]);
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error al Modificar");
        }

        try {
            $modif = equipamiento::find($request->txtid);
            $modif->Nombre_Item = $request->txtnombre;
            $modif->Descripcion = $request->txtdescripcion;
            $modif->estado = $request->txtestado;
            $modif->Distritos_id = $request->txtdistrito;
            $modif->save();
            $sql = true;
        } catch (\Throwable $th) {
            $sql = false;
        }
        if ($sql == true) {
            return back()->with("correcto", "Equipamiento Modificado Correctamente");
        } else {
            return back()->with("incorrecto", "Error al Modificar");
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
    public function destroy(equipamiento $id)
    {
        $id->delete();
        return back()->with("correcto", "Datos Eliminados Correctamente");
    }
}
