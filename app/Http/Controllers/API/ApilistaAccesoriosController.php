<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lista_accesorio;

class ApilistaAccesoriosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listaAccesorios = Lista_accesorio::select('id', 'Nombre_Item')
            ->orderBy('id', 'desc')->get();
        return response()->json($listaAccesorios);
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
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
