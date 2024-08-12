<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
/* use Illuminate\Support\Facades\Hash; */
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Author;
use Illuminate\Support\Facades\Hash;

class logincontroller extends Controller
{





    public function login(Request $request)
    {
        /* $credentials = $request->only('txtusuario', 'txtcontrase');

        if (Auth::attempt(['Usuario' => $credentials['txtusuario'], 'password' => $credentials['txtcontrase']])) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        } else {
            return back()->withErrors(['message' => 'Usuario o contraseña incorrectos']);
        } */


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
}
