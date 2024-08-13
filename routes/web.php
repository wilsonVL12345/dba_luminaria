<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\detalleController;
use App\Http\Controllers\distritoController;
use App\Http\Controllers\equipamientoController;
use App\Http\Controllers\inspeccionController;

use App\Http\Controllers\lista_accesorioController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Router;
// use App\Http\Controllers\logincontroller;
use App\Http\Controllers\luminaria_retiradasController;
use App\Http\Controllers\proyectoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
/* Route::get('/dashproyectos', function () {
    return view('plantilla.Dashboards.dashProyectos');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    /* Route::post('/inicia-sesion', [logincontroller::class, 'login'])->name('inicia-sesion');
    Route::get('/logout', [logincontroller::class, 'logout'])->name('logout'); */



    Route::view('/index', 'layout.index')->name('index');
    /* Route::get('/usuario/administrador', function () {
        return view('plantilla.Usuarios.Administrador');
    }); */


    //rutas para la parte de usuarios ----------------------------------------------------------------------------------------------------
    Route::get('/usuario/usuarios', [UserController::class, 'users'])->name('usuario.usuarios');
    Route::get('/usuario/bloquear/{id}', [UserController::class, 'bloquear'])->name('usuario.bloquear');
    Route::get('/usuario/desbloquear/{id}', [UserController::class, 'desbloquear'])->name('usuario.bloquear');
    Route::get('/usuario/perfil/{id}', [UserController::class, 'perfil'])->name('usuario.perfil');


    //ruta para agregar un nuevo usuario
    Route::post('/registro/usuario', [UserController::class, 'create'])->name('registro.usuario');
    //ruta para editar usuario
    Route::post('/editar/usuario', [UserController::class, 'edit'])->name('editar.usuario');



    //ruta para ver  distritos----------------------------------------------------------------------
    Route::get('/detallesDistritos', [distritoController::class, 'index'])->name('detalles.Distritos');
    Route::post('/registro/distrito', [distritoController::class, 'create'])->name('registro.distrito');
    Route::post('/editar/distrito/{id}', [distritoController::class, 'edit'])->name('editar.distrito');
    Route::get('/editar/urbanizacion/{id}', [distritoController::class, 'datosEdit'])->name('editar.urbanizacion');


    //ruta para inspecciones----------------------------------------------------------------------------------------------------
    Route::get('/inspecciones/espera', [inspeccionController::class, 'index'])->name('inspecciones.espera');
    Route::post('/registro/inspecciones', [inspeccionController::class, 'create'])->name('registro.inspecciones');
    Route::post('/editar/inspeccionespera', [inspeccionController::class, 'edit'])->name('editar.inspeccionespera');
    Route::post('/empezar/inspeccionespera', [inspeccionController::class, 'ready'])->name('empezar.inspeccionespera');
    Route::get('/inspecciones/realizadas', [inspeccionController::class, 'realizadas'])->name('inspecciones.espera');
    Route::post('/inspecciones/editrealizadas/{id}', [inspeccionController::class, 'editRealizada'])->name('inspecciones.editrealizadas');



    //rutas para equipamiento y accesorios--------------------------------------------------------------------------------
    //ruta para ver detalles equipamientos
    Route::get('/equipos/equipamiento/{dist}', [equipamientoController::class, 'index'])->name('equipos.equipamientos');
    //ruta para lista de accesorios
    Route::get('/equipos/accesorios', [lista_accesorioController::class, 'index'])->name('equipos.accesorios');
    //ruta para registrar ala lista de accesorios
    Route::post('/registro/accesorios', [lista_accesorioController::class, 'create'])->name('registro.accesorios');
    Route::post('/editar/accesorios', [lista_accesorioController::class, 'edit'])->name('editar.accesorios');
    Route::get('/eliminar/accesorios/{id}', [lista_accesorioController::class, 'destroy'])->name('eliminar.accesorios');

    Route::get('/equipamiento/distrito', [equipamientoController::class, 'showEquipDistrito'])->name('equipamiento.distrito');



    //rutar para la parte de equipos equipamientos
    Route::post('/registro/equipamiento', [equipamientoController::class, 'create'])->name('registro.equipamiento');
    Route::post('/editar/equipamiento', [equipamientoController::class, 'edit'])->name('editar.equipamiento');


    //rutas para luminarias retiradas
    Route::get('/proyectos/luminariasRetiradas', [luminaria_retiradasController::class, 'index'])->name('proyectos.luminariasretiradas');
    Route::post('/registro/retirados', [luminaria_retiradasController::class, 'create'])->name('registro.retirados');
    Route::get('/detalles/luminarias/retiradas/{id}', [luminaria_retiradasController::class, 'retiradaDetalle'])->name('detalles.luminarias.retiradas');
    Route::post('/modificar/retirados/{id}', [luminaria_retiradasController::class, 'editretirada'])->name('modificar.retirados');

    //rutas proyectos  ---------------------------------------------------------------------------------------------------------
    // para lo que es almacen
    Route::get('/proyectos/almacen', [proyectoController::class, 'index'])->name('proyectos.almacen');
    Route::post('/registro/almacen', [proyectoController::class, 'create'])->name('registro.almacen');
    Route::post('/modificar/almacen/{id}', [proyectoController::class, 'editEsperaAlmacen'])->name('modificar.almacen');
    Route::post('/modificar/ObrasEjecuatas/{id}', [proyectoController::class, 'editObrasEjecutadas'])->name('modificar.ObrasEjecuatas');


    Route::get('/detallesAccesorios/almacen/{id}', [proyectoController::class, 'reu'])->name('detallesAccesorios.almacen');
    Route::get('/detallesAccesorios/almacen', [proyectoController::class, 'reu'])->name('detallesAccesorios.almacendatos');
    Route::get('/datos/ejecutar/{id}', [proyectoController::class, 'ejecutarProyectodatos'])->name('datos.ejecutar');
    Route::post('/registrar/trabajoEjecutado/{id}', [proyectoController::class, 'registrarTrabajo'])->name('registrar.trabajoejecutado');

    Route::get('/proyectos/ObrasEjecutadas', [proyectoController::class, 'datosObras'])->name('proyectos.ObrasEjecutadas');

    Route::get('/dashproyectos', [proyectoController::class, 'dashproy'])->name('dashproyectos');
    Route::get('/dashdetalles', [proyectoController::class, 'dashdetall'])->name('dashdetalles');





    //rutar para agendar trabajos---------------------------------------------------------------------------------------------------------
    Route::get('/agendar', [detalleController::class, 'agendar'])->name('agendar');
    Route::post('/agendar/trabajo', [detalleController::class, 'create'])->name('agendar.trabajo');

    //ruta para ver los detalles generales de los trabajos------------------------------------------------------------------------------------------
    Route::get('/detalles/espera', [detalleController::class, 'index'])->name('detalles.espera');
    Route::get('/detalles/realizados', [detalleController::class, 'realizados'])->name('detalles.realizados');
    Route::get('detalle/realizados/informacion/{id}', [detalleController::class, 'DetallesRealizado'])->name('detalle.realizados.informacion');


    //rutas  para  detalles en espera,realizar trabajo------------------------------------------------------------------------------------------
    Route::get('/ejecutar/trabajo/{id}', [detalleController::class, 'ejecutar'])->name('ejecutar.trabajo');
    Route::get('/pendiente/trabajo', [detalleController::class, 'pendiente'])->name('pendiente.trabajo');
    Route::post('/store/trabajo/{id}', [detalleController::class, 'storeTrabajo'])->name('store.trabajo');

    Route::post('/edit/espera/{id}', [detalleController::class, 'edit'])->name('edit.espera');
    Route::post('/edit/realizado/{id}', [detalleController::class, 'editRealizado'])->name('edit.realizado');


    /* Auth::routes(); */
});

require __DIR__ . '/auth.php';



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
