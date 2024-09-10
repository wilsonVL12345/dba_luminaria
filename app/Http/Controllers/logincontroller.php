<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
/* use Illuminate\Support\Facades\Hash; */
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Author;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class logincontroller extends Controller
{





    public function login(Request $request)
    {


        if (!empty($request->txtusuario) && !empty($request->txtcontrase)) {
            $usuario = $request->txtusuario;
            $contraseña = $request->txtcontrase;
            $user = User::where('email', $usuario)
                ->where('Password', $contraseña)
                ->first();

            if ($user) {
                session(['id' => $user->id]);
                session(['name' => $user->name]);
                session(['paterno' => $user->Paterno]);
                session(['lugarDesignado' => $user->Lugar_Designado]);
                session(['cargo' => $user->Cargo]);
                session(['perfil' => $user->perfil]);
                $request->session()->regenerate();
                return redirect(route('dashproyectos'));
            } else {
                return back()->with("incorrecto", "Acceso denegado");
            }
        } else {

            return back()->with("incorrecto", "Campos vacios Ingrese sus Credenciales");
        }
    }
    public function logout(Request $request)
    {
        /* session_start();
        session_destroy();

        return redirect(route('login')); */
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect(route('login'));
    }
    public function showcambiarPassword(Request $request, $id)
    {
        $userold = user::find($id);
        return view('plantilla.Usuarios.nuevaContrasena', compact('userold'));
    }

    public function cambiarPassword(Request $request, $id)
    {
        /* Log::info('Intento de cambio de contraseña', ['user_id' => $id]);
 */
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|min:8|same:newpasswordConfirm',
        ]);

        $user = User::findOrFail($id);

        if (!Hash::check($request->oldpassword, $user->password)) {
            // Log::warning('Intento de cambio de contraseña fallido: contraseña actual incorrecta', ['user_id' => $id]);
            return back()->with("incorrecto", "La contraseña actual es incorrecta");
        }

        $user->password = Hash::make($request->newpassword);
        $user->save();

        /* Log::info('Contraseña cambiada exitosamente', ['user_id' => $id]); */

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('correcto', 'Contraseña cambiada correctamente. Por favor, inicie sesión nuevamente.');
    }
}
