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
