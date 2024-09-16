<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\distrito;
use App\Models\urbanizacion;
use Yajra\DataTables\Facades\DataTables;

class apiDistritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $urb = urbanizacion::select('id', 'Nrodistrito', 'nombre_urbanizacion')->get();
        return response()->json($urb);
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
