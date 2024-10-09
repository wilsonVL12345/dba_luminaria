<?php

namespace App\Http\Controllers;

use App\Models\detalle;
use App\Models\inspeccion;
use App\Models\proyecto;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function users()
    {
        $users = User::where('Estado', 'Activo')->get();
        $role = role::where('name', '<>', 'Admin')->get();

        return view('plantilla.Usuarios.usuarios', ['user' => $users, 'role' => $role]);
    }
    public function getUserData(Request $request)
    {
        // Determinamos el query base dependiendo del cargo del usuario
        $userDetall = User::select(
            'perfil',
            'id',
            'name',
            'Paterno',
            'Materno',
            'Ci',
            'Celular',
            'Cargo',
            'Lugar_Designado',
        )
            ->where('Estado', 'Activo');

        // Procesamos los datos con DataTables, manejando la paginación, búsqueda y longitud
        return DataTables::of($userDetall)
            ->filter(function ($query) use ($request) {
                // Agrega un filtro adicional aquí si es necesario
                if ($request->has('search.value')) {
                    $search = $request->input('search.value');
                    $query->where(function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%")
                            ->orWhere('Paterno', 'like', "%{$search}%")
                            ->orWhere('Materno', 'like', "%{$search}%")
                            ->orWhere('Ci', 'like', "%{$search}%")
                            ->orWhere('Celular', 'like', "%{$search}%")
                            ->orWhere('Cargo', 'like', "%{$search}%")
                            ->orWhere('Lugar_Designado', 'like', "%{$search}%");
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
                if (session('cargo') == 'Admin') {
                    # code...
                    if (auth()->user()->can('user.edit')) {
                        $actions .= '<div class="menu-item px-3">
                            <a href="#"  data-id="' . $row->id . '"
                                class="menu-link px-3 edit-buttonUserEdit" data-bs-toggle="modal" >Editar</a>
                        </div>';
                    }

                    if (auth()->user()->can('user.restablecer')) {
                        $actions .= '<div class="menu-item px-3">
                            <a href="' . url('/restablecer/usuario' . $row->id) . '" 
                                class="menu-link px-3 reset-password-link " target="_blank">Restablecer</a>
                        </div>';
                    }

                    if (auth()->user()->can('user.delete')) {
                        $actions .= '<div class="menu-item px-3">
                            <a href="' . url('/eliminar/usuario' . $row->id) . '" class="menu-link px-3 delete-link" 
                                data-kt-customer-table-filter="delete_row">Eliminar</a>
                        </div>';
                    }
                } elseif (session('cargo') != $row->Cargo) {
                    if (auth()->user()->can('user.edit')) {
                        $actions .= '<div class="menu-item px-3">
                            <a href="#"  data-id="' . $row->id . '"
                                class="menu-link px-3 edit-buttonUserEdit" data-bs-toggle="modal" >Editar</a>
                        </div>';
                    }

                    if (auth()->user()->can('user.restablecer')) {
                        $actions .= '<div class="menu-item px-3">
                            <a href="' . url('/restablecer/usuario' . $row->id) . '" 
                                class="menu-link px-3 reset-password-link " target="_blank">Restablecer</a>
                        </div>';
                    }

                    if (auth()->user()->can('user.delete')) {
                        $actions .= '<div class="menu-item px-3">
                            <a href="' . url('/eliminar/usuario' . $row->id) . '" class="menu-link px-3 delete-link" 
                                data-kt-customer-table-filter="delete_row">Eliminar</a>
                        </div>';
                    }
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
            $request->validate([
                'txtnombre' => ['required', 'regex:/^[A-Za-záéíóúÁÉÍÓÚÑñ]+(?:\s[A-Za-záéíóúÁÉÍÓÚÑñ]+)?$/'],

                'txtpaterno' => ['required', 'regex:/^[A-Za-záéíóúÁÉÍÓÚÑñ]+$/'], // Una palabra, solo letras sin espacio
                'txtmaterno' => ['nullable', 'regex:/^[A-Za-záéíóúÁÉÍÓÚÑñ]+$/'], // Una palabra, solo letras, no requerido
                'txtci' => ['required', 'alpha_num', 'min:6', 'max:12'], // Letras y números, entre 6 y 12 caracteres
                'txtexpedido' => ['required', 'alpha', 'min:2', 'max:3'], // Solo letras, entre 2 y 3 caracteres
                'txtcelular' => ['required', 'digits:8'], // Exactamente 8 dígitos
                'txtgenero' => ['required', 'alpha', 'size:1'], // Una letra
                'txtcargo' => ['required', 'regex:/^[A-Za-záéíóúÁÉÍÓÚÑñ\s]{1,15}$/'], // Palabras hasta 15 letras
                'txtlugarDesignado' => ['required', 'regex:/^[A-Za-záéíóúÁÉÍÓÚÑñ0-9]{1,10}$/'], // Letras o números hasta 10 caracteres
            ]);
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error Datos invalidos, ingrese datos validos ");
        }

        // dd($request->all());
        $rol = Role::where('name', $request->txtcargo)->first();


        if ($request->txtgenero == 'M') {
            $perf = '/storage/perfiles/perfilmas.jpg';
        } else {
            $perf = '/storage/perfiles/perfilfem.jpg';
        }
        $lash = '@gob.bo';
        $estado = 'Activo';
        try {
            $user = new User();
            $primera = strtolower(substr($request->txtnombre, 0, 1));
            $apellido = strtolower($request->txtpaterno);
            $usuario = $primera . $apellido;
            $contrase =  $request->txtci;
            // $apellido .

            $user->name = $request->txtnombre;
            $user->Paterno = $request->txtpaterno;
            $user->Materno = $request->txtmaterno;
            $user->Ci = $request->txtci;
            $user->Expedido = $request->txtexpedido;
            $user->Celular = $request->txtcelular;
            $user->Genero = $request->txtgenero;
            $user->Cargo = $request->txtcargo;
            $user->Lugar_Designado = $request->txtlugarDesignado;
            $user->Estado = $estado;
            $user->perfil = $perf;
            $user->email = $usuario . $lash;
            $user->Password =  Hash::make($contrase);
            $user->assignRole($rol->name);
            $user->save();

            $sql = true;
        } catch (\Throwable $th) {
            $sql = false;
        }
        if ($sql == true) {
            return back()->with("correcto", "Usuario Registrado Correctamente");
        } else {
            return back()->with("incorrecto", "Error al Registrar");
        }
    }


    /* public function cambiarContrasena(Request $request)
    {

        return view('auth.reset-password', compact('request'));
    } */


    public function editDatosUser(Request $request, $id)
    {
        $datosUser = User::find($id);
        return response()->json($datosUser);
    }
    public function edit(Request $request)
    {
        try {
            $request->validate([
                'txtnombre' => ['required', 'regex:/^[A-Za-záéíóúÁÉÍÓÚÑñ]+(?:\s[A-Za-záéíóúÁÉÍÓÚÑñ]+)?$/'],

                'txtpaterno' => ['required', 'regex:/^[A-Za-záéíóúÁÉÍÓÚÑñ]+$/'], // Una palabra, solo letras sin espacio
                'txtmaterno' => ['nullable', 'regex:/^[A-Za-záéíóúÁÉÍÓÚÑñ]+$/'], // Una palabra, solo letras, no requerido
                'txtci' => ['required', 'alpha_num', 'min:6', 'max:12'], // Letras y números, entre 6 y 12 caracteres
                'txtexpedido' => ['required', 'alpha', 'min:2', 'max:3'], // Solo letras, entre 2 y 3 caracteres
                'txtcelular' => ['required', 'digits:8'], // Exactamente 8 dígitos
                'txtgenero' => ['required', 'alpha', 'size:1'], // Una letra
                'txtcargo' => ['required', 'regex:/^[A-Za-záéíóúÁÉÍÓÚÑñ\s]{1,15}$/'], // Palabras hasta 15 letras
                'txtlugarDesignado' => ['required', 'regex:/^[A-Za-záéíóúÁÉÍÓÚÑñ0-9]{1,10}$/'], // Letras o números hasta 10 caracteres
            ]);
        } catch (\Throwable $th) {
            return back()->with("incorrecto", "Error Datos invalidos, ingrese datos validos ");
        }

        $rolee = Role::where('name', $request->txtcargo)->first();

        try {
            $userd = User::find($request->txtid);
            $userd->name = $request->txtnombre;
            $userd->Paterno = $request->txtpaterno;
            $userd->Materno = $request->txtmaterno;
            $userd->Ci = $request->txtci;
            $userd->Expedido = $request->txtexpedido;
            $userd->Celular = $request->txtcelular;
            $userd->Genero = $request->txtgenero;
            $userd->Cargo = $request->txtcargo;
            $userd->Lugar_Designado = $request->txtlugarDesignado;
            // Eliminar todos los roles actuales del usuario
            $userd->syncRoles([]);

            // Asignar el nuevo rol
            $userd->assignRole($rolee->name);
            $userd->save();
            $sql = true;
        } catch (\Throwable $th) {
            $sql = false;
        }
        if ($sql == true) {
            return back()->with("correcto", "Usuario Modificado Correctamente");
        } else {
            return back()->with("incorrecto", "Error al Modificar");
        }
    }



    public function perfil(Request $request,  $id)
    {


        $porTotal = 0;

        $perfiluser = User::find($id);
        $manteDetalleCount = detalle::where('EjecutadoPor', $id)->where('Estado', 'Finalizado')->count();
        /* dd($manteDetalleCount); */
        $manteProyectoCount = proyecto::where('Realizado_Por', $id)->where('Estado', 'Finalizado')->count();
        $manteInspeccionCount = inspeccion::where('Inspector', $id)->where('Inspeccion', 'Finalizado')->count();

        return view('plantilla.Usuarios.perfil', compact('perfiluser', 'manteDetalleCount', 'manteProyectoCount', 'manteInspeccionCount', 'porTotal'));
    }
    public function restablecer($id)
    {
        try {
            $restablecerUser = User::find($id);
            $restablecerUser->password = Hash::make($restablecerUser->Ci);
            $restablecerUser->save();
            $sql = true;
        } catch (\Throwable $th) {
            $sql = false;
        }
        if ($sql == true) {
            return back()->with("correcto", "Contraseña Reestablecido con exit");
        } else {
            return back()->with("incorrecto", "Error al Restablecer");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $id)
    {
        $id->delete();
        return back()->with("correcto", "Datos Eliminados Correctamente");
    }
}
