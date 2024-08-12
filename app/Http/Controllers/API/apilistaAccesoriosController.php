<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\lista_accesorio;

class apilistaAccesoriosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listaAccesorios = Lista_accesorio::orderBy('id', 'desc')->get();
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
