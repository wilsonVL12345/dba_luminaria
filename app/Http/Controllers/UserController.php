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
        $users = User::all();
        $role = role::all();
        return view('plantilla.Usuarios.usuarios', ['user' => $users, 'role' => $role]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // dd($request->all());
        $rol = Role::where('name', $request->txtcargo)->first();


        if ($request->txtgenero == 'M') {
            $perf = '/storage/perfiles/perfilmas.jpg';
        } else {
            $perf = '/storage/perfiles/perfilfem.jpg';
        }
        $lash = '@gob.bo';
        if ($request->txtestado) {
            $estado = 'Activo';
        } else {
            $estado = 'Bloqueado';
        }
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


    public function bloquear($id)
    {
        $bloq = 'Bloqueado';
        $userbloquear = User::find($id);
        $userbloquear->Estado = $bloq;
        $userbloquear->save();
        return back()->with("incorrecto", "Usuario Bloqueado Correctamente");
    }

    /**
     * Display the specified resource.
     */
    public function desbloquear($id)
    {
        $desbloq = 'Activo';
        $userdesbloquear = User::find($id);
        $userdesbloquear->Estado = $desbloq;
        $userdesbloquear->save();
        return back()->with("correcto", "Usuario Desbloqueado Correctamente");
    }


    public function edit(Request $request)
    {
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

    /**
     * Update the specified resource in storage.
     */
    public function perfil(Request $request,  $id)
    {

        /* $manteDetalleCount = 0;
        $manteProyectoCount = 0;
        $manteInspeccionCount = 0;
        $manteDetalleCountEs = 0;
        $manteProyectoCountEs = 0;
        $manteInspeccionCountEs = 0;
        $total = 0; */
        $porTotal = 0;

        $perfiluser = User::find($id);
        $manteDetalleCount = detalle::where('EjecutadoPor', $id)->where('Estado', 'Finalizado')->count();
        /* dd($manteDetalleCount); */
        $manteProyectoCount = proyecto::where('Realizado_Por', $id)->where('Estado', 'Finalizado')->count();
        $manteInspeccionCount = inspeccion::where('Inspector', $id)->where('Inspeccion', 'Finalizado')->count();
        /* $manteDetalleCountEs = detalle::where('EjecutadoPor', $id)->where('Estado', 'En Espera')->count();
        $manteProyectoCountEs = proyecto::where('Realizado_Por', $id)->where('Estado', 'En Espera')->count();
        $manteInspeccionCountEs = inspeccion::where('Inspector', $id)->where('Estado', 'En Espera')->count();

        $total = $manteDetalleCount + $manteInspeccionCount + $manteProyectoCount + $manteDetalleCountEs + $manteInspeccionCountEs + $manteProyectoCountEs;

        $totalrealizados = $manteDetalleCount + $manteInspeccionCount + $manteProyectoCount;
        if ($total >= 1) {
            # code...

            $porTotal = ($totalrealizados * 100) / $total;
        } else {
            $porTotal = 100;
        }
 */
        return view('plantilla.Usuarios.perfil', compact('perfiluser', 'manteDetalleCount', 'manteProyectoCount', 'manteInspeccionCount', 'porTotal'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
