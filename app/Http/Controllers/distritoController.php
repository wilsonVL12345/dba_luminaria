<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\distrito;
use App\Models\urbanizacion;
use GuzzleHttp\Promise\Create;
use PhpParser\Node\Expr\FuncCall;
use function PHPUnit\Framework\returnSelf;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\DataTables\UrbanizacionDataTable;

class distritoController extends Controller
{
    /* public function iindex(UrbanizacionDataTable $dataTable)
    {
        return $dataTable->render('urbanizacion.iindex');
    }
 */
    /* public function __construct()
    {
        $this->middleware('can:Distritos.edit')->only('edit');
    }  */


    public function index(Request $request)
    {
        if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {


            // Consultas para las vistas
            $todoUrban = urbanizacion::select('id', 'Nrodistrito', 'nombre_urbanizacion')
                ->orderBy('id', 'desc')
                ->where('nombre_urbanizacion', '<>', '')
                ->get();
            $distritos = Distrito::where('id', '<>', 15)->get();


            // Renderizar la vista con los datos
            return view('plantilla.DetallesDistritos.Distritos', [
                'todoUrban' => $todoUrban,
                'distrito' => $distritos
            ]);
        } else {
            // Verifica si la solicitud es Ajax

            // Consultas para las vistas
            $todoUrban = urbanizacion::orderBy('id', 'desc')
                ->where('Nrodistrito', session('Lugar_Designado'))
                ->get();
            $distritos = Distrito::where('id', '<>', 15)
                ->where('id', session('Lugar_Designado'))->get();



            // Renderizar la vista con los datos
            return view('plantilla.DetallesDistritos.Distritos', [
                'todoUrban' => $todoUrban,
                'distrito' => $distritos
            ]);
        }
    }
    public function getUrbanizacionesData(Request $request)
    {
        // Determinamos el query base dependiendo del cargo del usuario
        if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {
            $urbanizaciones = Urbanizacion::select('id', 'Nrodistrito', 'nombre_urbanizacion')
                ->where('nombre_urbanizacion', '<>', '');
        } else {
            $urbanizaciones = Urbanizacion::select('id', 'Nrodistrito', 'nombre_urbanizacion')
                ->where('Nrodistrito', session('Lugar_Designado'));
        }

        // Procesamos los datos con DataTables, manejando la paginación, búsqueda y longitud
        return DataTables::of($urbanizaciones)
            ->filter(function ($query) use ($request) {
                // Agrega un filtro adicional aquí si es necesario
                if ($request->has('search.value')) {
                    $search = $request->input('search.value');
                    $query->where(function ($query) use ($search) {
                        $query->where('nombre_urbanizacion', 'like', "%{$search}%")
                            ->orWhere('Nrodistrito', 'like', "%{$search}%");
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

                if (auth()->user()->can('Distritos.edit')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/editar/urbanizacion/' . $row->id) . '" 
                            class="menu-link px-3">Editar</a>
                    </div>';
                }

                if (auth()->user()->can('Distritos.delete')) {
                    $actions .= '<div class="menu-item px-3">
                        <a href="' . url('/eliminar/urbanizacion/' . $row->id) . '" class="menu-link px-3 delete-link"
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
        try {
            // Validaciones
            $request->validate([
                'txtdistrit' => 'required|digits_between:1,2', // Requerido y máximo 2 dígitos
                'txtzonaUrba' => [
                    'required',
                    'regex:/^[A-Z0-9ÁÉÍÓÚÑñáéíóú\*\-\.\,\(\)\s]+$/', // Requerido, mayúsculas, números, letras acentuadas, ñ/Ñ, y símbolos
                ],

            ]);
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error Datos invalidos, ingrese datos validos ");
        }

        try {
            $newUrb = new urbanizacion();
            $newUrb->Nrodistrito = $request->txtdistrit;
            $newUrb->nombre_urbanizacion = $request->txtzonaUrba;

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
        if (session('cargo') == 'Administrador' || session('cargo') == 'Admin' || session('cargo') == 'Veedor') {

            $urbEdit = urbanizacion::find($id);
            $distEdit = Distrito::where('id', '<>', 15)->get();
            return view('plantilla.DetallesDistritos.editDistrito', compact('urbEdit', 'distEdit'));
        } else {


            $urbEdit = urbanizacion::find($id);
            $distEdit = Distrito::where('id', '<>', 15)
                ->where('id', session('Lugar_Designado'))->get();

            return view('plantilla.DetallesDistritos.editDistrito', compact('urbEdit', 'distEdit'));
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    // modifica los datos de urbanizacion

    public function edit(Request $request, $id)
    {
        try {
            // Validaciones
            $request->validate([
                'txtdistritom' => 'required|digits_between:1,2', // Requerido y máximo 2 dígitos
                'txtzonaUrbanizacionm' => [
                    'required',
                    'regex:/^[A-Z0-9ÁÉÍÓÚÑñáéíóú\/\*\-\.\,\(\)\s]+$/', // Requerido, mayúsculas, números, letras acentuadas, ñ/Ñ, y símbolos
                ],

            ]);
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error Datos invalidos, ingrese datos validos ");
        }


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
    public function destroy(urbanizacion $id)
    {
        $id->delete();
        return back()->with("correcto", "Datos Eliminados Correctamente");
    }
}
