<?php

use App\Http\Controllers\API\apiDashboardController;
use App\Http\Controllers\API\apiDetalleController;
use App\Http\Controllers\API\apiDistritoController;
use App\Http\Controllers\API\apiEquipamientoController;
use App\Http\Controllers\API\apiinspeccionController;
use App\Http\Controllers\API\apilistaAccesoriosController;
use App\Http\Controllers\API\apiProyectoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\apiUserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//rutas para mostrar los datos 
Route::get('/users', [apiUserController::class, 'index']);

Route::get('/apidistritos', [apiDistritoController::class, 'index']);

Route::get('/equipos/equipamientos', [apiEquipamientoController::class, 'index']);

Route::get('/inspeccion/realizado', [apiinspeccionController::class, 'realizado']);

Route::get('/lista/accesorios', [apilistaAccesoriosController::class, 'index']);

//ruta para apis de proyecto
Route::get('/datosreutilizados/proyecto/{proyecto}', [apiProyectoController::class, 'reu']);
Route::get('/datosluminaria/proyecto', [apiProyectoController::class, 'lum']);
Route::get('/datosaccesorios/proyecto', [apiProyectoController::class, 'acces']);
Route::get('/retiradas/proyecto', [apiProyectoController::class, 'proyectosEspera']);
Route::get('/retiradasFin/proyecto', [apiProyectoController::class, 'proyectosFinalizados']);

Route::get('/espera/detalles', [apiDetalleController::class, 'detallesEspera']);
Route::get('/finalizado/detalles', [apiDetalleController::class, 'detallesFinalizados']);

Route::get('/atencion/apidetall', [apiDetalleController::class, 'infoatencion']);
Route::get('/lista/urbanizacion', [apiDetalleController::class, 'listUbanizacion']);

Route::get('/dashboardGenerales', [apiDashboardController::class, 'dashdis1']);
