<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lista_accesorio;
use Yajra\DataTables\Facades\DataTables;

use function PHPSTORM_META\sql_injection_subst;

class lista_accesorioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accesorios = Lista_accesorio::orderBy('id', 'desc')->get();
        return view('plantilla.Equipos.Accesorios', ['accesorio' => $accesorios]);
    }
    public function listaAccesoriosdata(Request $request)
    {

        $listaAccesorios = lista_accesorio::select('id', 'Nombre_Item');


        // Procesamos los datos con DataTables, manejando la paginación, búsqueda y longitud
        return DataTables::of($listaAccesorios)
            ->filter(function ($query) use ($request) {
                // Agrega un filtro adicional aquí si es necesario
                if ($request->has('search.value')) {
                    $search = $request->input('search.value');
                    $query->where(function ($query) use ($search) {
                        $query->where('Nombre_Item', 'like', "%{$search}%");
                    });
                }
            })


            /* ->addColumn('action', function ($row) {
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

                // Botón de Editar
                if (auth()->user()->can('accesorios.edit')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalModificarAccesorios' . $row->id . '" class="menu-link px-3">Editar</a>
                    </div>';
                }

                // Botón de Eliminar
                if (auth()->user()->can('accesorios.delete')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/eliminar/accesorios/' . $row->id) . '" class="menu-link px-3 delete-link"
                            data-kt-customer-table-filter="delete_row">Eliminar</a>
                    </div>';
                }

                $actions .= '</div>';

                return $actions;
            })
            ->rawColumns(['action'])
            ->make(true); */
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
                if (auth()->user()->can('accesorios.edit')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="#" data-id="' . $row->id . '" class="menu-link px-3 edit-buttonaccmod" data-bs-toggle="modal" >Editar</a>
                    </div>';
                }

                // Botón de Eliminar
                if (auth()->user()->can('accesorios.delete')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/eliminar/accesorios/' . $row->id) . '" class="menu-link px-3 delete-link"
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
        $request->validate([
            'txtnombre' => [
                'required',
                'regex:/^[A-Z0-9\/\*\-\.\,\(\)\s]+$/', // Requerido, mayúsculas, números y símbolos permitidos
            ],
        ]);
        try {
            $accesorio = new lista_accesorio();
            $accesorio->Nombre_Item = $request->txtnombre;
            $accesorio->save();
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

    public function editdatos($id)
    {
        $atosAcc = lista_accesorio::find($id);
        return response()->json($atosAcc);
    }

    public function edit(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'txtnombre' => [
                    'required',
                    'regex:/^[a-zA-Z0-9\s\.\,\(\)\/\-\+]+$/', // Letras minúsculas y mayúsculas, números, espacio y los símbolos . , ( ) / - +
                ],
            ]);
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error al Modificar");
        }

        try {
            $lista = lista_accesorio::find($request->txtid);
            $lista->Nombre_Item = $request->txtnombre;
            $lista->save();
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


    public function destroy(lista_accesorio $id)
    {
        $id->delete();
        return back()->with("correcto", "Datos Eliminados Correctamente");
    }
}
