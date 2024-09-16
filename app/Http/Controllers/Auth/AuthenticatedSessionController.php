<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $user = Auth::user();
        $request->session()->put([
            'id' => $user->id,
            'name' => $user->name,
            'paterno' => $user->Paterno,
            'Materno' => $user->Materno,
            'cargo' => $user->Cargo,
            'Lugar_Designado' => $user->Lugar_Designado,
            'Estado' => $user->Estado,
            'perfil' => $user->perfil,

        ]);
        if (session('cargo') == 'Admin' || session('cargo') == 'Administrador' || session('cargo') == 'Veedor') {
            return redirect()->intended(RouteServiceProvider::ADMIN);
        }
        if (session('cargo') == 'Coordinador') {
            return redirect()->intended(RouteServiceProvider::COOR);
        }
        if (session('cargo') == 'Tecnico') {
            return redirect()->intended(RouteServiceProvider::TEC);
        }

        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
