<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\inspeccion;
use App\Models\detalle;
use App\Models\proyecto;

class menuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /*  public function datos()
    {


        $mantenimientoCount = detalle::where('Distritos_id', session('Lugar_Designado'))->where('Estado', 'En Espera')->count();
        $inspeccionCount = inspeccion::where('Distritos_id', session('Lugar_Designado'))->where('Inspeccion', 'En Espera')->count();
        $proyectoCount = proyecto::where('Distritos_id', session('Lugar_Designado'))->where('Estado', 'En Espera')->count();

        return view('layout.index', compact('mantenimientoCount', 'inspeccionCount', 'proyectoCount'));
    } */
}
