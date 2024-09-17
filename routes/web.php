<?php

use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\detalleController;
use App\Http\Controllers\distritoController;
use App\Http\Controllers\equipamientoController;
use App\Http\Controllers\inspeccionController;

use App\Http\Controllers\lista_accesorioController;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Router;
// use App\Http\Controllers\logincontroller;
use App\Http\Controllers\luminaria_retiradasController;
use App\Http\Controllers\menuController;
use App\Http\Controllers\proyectoController;
use App\Http\Controllers\ReelevamientoController;
use App\Models\datos_luminaria_retirada;

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
Route::get('/index', [menuController::class, 'datos'])->name('index');

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


    // Route::view('/index', 'layout.index')->name('index');
    /* Route::get('/usuario/administrador', function () {
        return view('plantilla.Usuarios.Administrador');
    }); */


    //rutas para la parte de usuarios ----------------------------------------------------------------------------------------------------
    Route::get('/usuario/usuarios', [UserController::class, 'users'])->name('usuario.usuarios')->middleware('can:user.show');
    /*  Route::get('/usuario/bloquear/{id}', [UserController::class, 'bloquear'])->name('usuario.bloquear');
    Route::get('/usuario/desbloquear/{id}', [UserController::class, 'desbloquear'])->name('usuario.bloquear'); */
    Route::get('/usuario/perfil/{id}', [UserController::class, 'perfil'])->name('usuario.perfil');
    Route::get('/eliminar/usuario{id}', [UserController::class, 'destroy'])->name('eliminar.usuario')->middleware('can:user.delete');
    Route::get('/restablecer/usuario{id}', [UserController::class, 'restablecer'])->name('restablecer.usuario');

    // cambiar contraseña
    Route::get('/cambiar/password{id}', [logincontroller::class, 'showcambiarPassword'])->name('cambiar.password');
    route::post('/cambiar/contrasena/{id}', [LoginController::class, 'cambiarPassword'])->name('cambiar.contrasena');

    //ruta para agregar un nuevo usuario
    Route::post('/registro/usuario', [UserController::class, 'create'])->name('registro.usuario')->middleware('can:user.create');
    //ruta para editar usuario
    Route::post('/editar/usuario', [UserController::class, 'edit'])->name('editar.usuario')->middleware('can:user.edit');

    Route::get('/reset-password/{token}', [UserController::class, 'create'])
        ->middleware('guest')
        ->name('password.reset');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->middleware('guest')
        ->name('password.store');

    //rutar para agendar trabajos---------------------------------------------------------------------------------------------------------
    Route::get('/agendar', [detalleController::class, 'agendar'])->name('agendar')->middleware('can:agendar.show');
    // crea el trabajo para que posteriormente lo ejecute el tecnico
    Route::post('/agendar/trabajo', [detalleController::class, 'create'])->name('agendar.trabajo')->middleware('can:agendar.show');

    //ruta para ver los detalles generales de los trabajos------------------------------------------------------------------------------------------
    Route::get('/detalles/espera', [detalleController::class, 'index'])->name('detalles.espera')->middleware('can:detallesGen.show');
    Route::get('/detalles/realizados', [detalleController::class, 'realizados'])->name('detalles.realizados')->middleware('can:detallesGen.show');
    Route::get('/detalles/realizados/edit{id}', [detalleController::class, 'editRealizadosShow'])->name('detalles.realizadosEdit')->middleware('can:detallesGen.edit');
    Route::get('/detalles/mantenimiento/pdf{id}', [detalleController::class, 'generarpdf'])->name('detalles.pdf');

    Route::get('detalle/realizados/informacion/{id}', [detalleController::class, 'DetallesRealizado'])->name('detalle.realizados.informacion')->middleware('can:detallesGen.show');
    Route::get('/eliminar/detallegen{id}', [detalleController::class, 'destroy'])->name('eliminar.detallegen')->middleware('can:detallesGen.delete');
    //rutas  para  detalles en espera,realizar trabajo------------------------------------------------------------------------------------------
    Route::get('/ejecutar/trabajo/{id}', [detalleController::class, 'ejecutar'])->name('ejecutar.trabajo')->middleware('can:realizar.show');
    Route::get('/pendiente/trabajo', [detalleController::class, 'pendiente'])->name('pendiente.trabajo')->middleware('can:realizar.show');
    Route::post('/store/trabajo/{id}', [detalleController::class, 'storeTrabajo'])->name('store.trabajo')->middleware('can:realizar.show');
    Route::post('/edit/espera/{id}', [detalleController::class, 'edit'])->name('edit.espera')->middleware('can:detallesGen.edit');
    Route::post('/edit/realizado/{id}', [detalleController::class, 'editRealizado'])->name('edit.realizado')->middleware('can:detallesGen.edit');






    //ruta para inspecciones----------------------------------------------------------------------------------------------------
    Route::get('/inspecciones/espera', [inspeccionController::class, 'index'])->name('inspecciones.espera')->middleware('can:inspecciones.show');
    Route::post('/registro/inspecciones', [inspeccionController::class, 'create'])->name('registro.inspecciones')->middleware('can:inspecciones.create');
    Route::post('/editar/inspeccionespera', [inspeccionController::class, 'edit'])->name('editar.inspeccionespera')->middleware('can:inspecciones.edit');
    Route::post('/empezar/inspeccionespera', [inspeccionController::class, 'ready'])->name('empezar.inspeccionespera')->middleware('can:inspecciones.install');
    Route::get('/inspecciones/realizadas', [inspeccionController::class, 'realizadas'])->name('inspecciones.espera')->middleware('can:inspecciones.show');
    Route::post('/inspecciones/editrealizadas/{id}', [inspeccionController::class, 'editRealizada'])->name('inspecciones.editrealizadas')->middleware('can:inspecciones.edit');
    Route::get('/eliminar/inspeccion{id}', [inspeccionController::class, 'destroy'])->name('eliminar.inspeccion')->middleware('can:inspecciones.delete');
    route::get('/check-new-inspecciones', [inspeccionController::class, 'checkNewInspecciones'])->middleware('auth');
    Route::post('/mark-inspecciones-seen', [inspeccionController::class, 'markInspeccionesAsSeen'])->middleware('auth');


    //rutas para equipamiento y accesorios--------------------------------------------------------------------------------
    //ruta para ver detalles equipamientos
    Route::get('/equipos/equipamiento/{dist}', [equipamientoController::class, 'index'])->name('equipos.equipamientos')->middleware('can:equipamiento.show');
    Route::get('/eliminar/equipamiento{id}', [equipamientoController::class, 'destroy'])->name('eliminar.equipamiento')->middleware('can:equipamiento.delete');

    //ruta para lista de accesorios
    Route::get('/equipos/accesorios', [lista_accesorioController::class, 'index'])->name('equipos.accesorios')->middleware('can:accesorios.show');
    Route::get('/eliminar/accesorios{id}', [lista_accesorioController::class, 'destroy'])->name('eliminar.accesorios')->middleware('can:accesorios.delete');

    //ruta para registrar ala lista de accesorios
    Route::post('/registro/accesorios', [lista_accesorioController::class, 'create'])->name('registro.accesorios')->middleware('can:accesorios.create');
    Route::post('/editar/accesorios', [lista_accesorioController::class, 'edit'])->name('editar.accesorios')->middleware('can:accesorios.edit');
    // Route::get('/eliminar/accesorios/{id}', [lista_accesorioController::class, 'destroy'])->name('eliminar.accesorios');

    Route::get('/equipamiento/distrito', [equipamientoController::class, 'showEquipDistrito'])->name('equipamiento.distrito')->middleware('can:equipamiento.show');
    //rutar para la parte de equipos equipamientos
    Route::post('/registro/equipamiento', [equipamientoController::class, 'create'])->name('registro.equipamiento')->middleware('can:equipamiento.create');
    Route::post('/editar/equipamiento', [equipamientoController::class, 'edit'])->name('editar.equipamiento')->middleware('can:equipamiento.edit');


    //rutas para luminarias retiradas
    Route::get('/proyectos/luminariasRetiradas', [luminaria_retiradasController::class, 'index'])->name('proyectos.luminariasretiradas')->middleware('can:proyecto.Retirado.show');
    Route::post('/registro/retirados', [luminaria_retiradasController::class, 'create'])->name('registro.retirados')->middleware('can:proyecto.Retirado.create');
    Route::get('/detalles/luminarias/retiradas/{id}', [luminaria_retiradasController::class, 'retiradaDetalle'])->name('detalles.luminarias.retiradas')->middleware('can:proyecto.Retirado.show');
    Route::post('/modificar/retirados/{id}', [luminaria_retiradasController::class, 'editretirada'])->name('modificar.retirados')->middleware('can:proyecto.Retirado.edit');
    Route::get('/eliminar/retirada{id}', [luminaria_retiradasController::class, 'destroy'])->name('eliminar.retirada')->middleware('can:proyecto.Retirado.delete');
    Route::get('/proyectos/luminariasRetiradas{id}', [luminaria_retiradasController::class, 'editLuminariasRetiradasShow'])->name('proyectoss.luminariasRetiradas')->middleware('can:proyecto.Retirado.edit');
    Route::get('/retirado/pdf{id}', [luminaria_retiradasController::class, 'generarPDF'])->name('retirado.pdf')->middleware('can:proyecto.Retirado.edit');

    //rutas proyectos  ---------------------------------------------------------------------------------------------------------
    // para lo que es almacen
    Route::get('/proyectos/almacen', [proyectoController::class, 'index'])->name('proyectos.almacen')->middleware('can:proyecto.show');
    Route::post('/registro/almacen', [proyectoController::class, 'create'])->name('registro.almacen')->middleware('can:proyecto.create');
    Route::get('/showModificar/almacen/{id}', [proyectoController::class, 'editShowEsperaAlmacen'])->name('showmodificar.almacen')->middleware('can:proyecto.edit');
    Route::get('/showModificar/obras/{id}', [proyectoController::class, 'editShowObras'])->name('showmodificar.obras')->middleware('can:proyecto.edit');
    Route::post('/modificar/almacen/{id}', [proyectoController::class, 'editEsperaAlmacen'])->name('modificar.almacen')->middleware('can:proyecto.edit');
    Route::post('/modificar/ObrasEjecuatas/{id}', [proyectoController::class, 'editObrasEjecutadas'])->name('modificar.ObrasEjecuatas')->middleware('can:proyecto.edit');
    Route::get('/eliminar/proyecto{id}', [proyectoController::class, 'destroy'])->name('eliminar.proyecto')->middleware('can:proyecto.delete');
    Route::get('/detallesAccesorios/almacen/{id}', [proyectoController::class, 'reu'])->name('detallesAccesorios.almacen')->middleware('can:proyecto.show');
    // Route::get('/detallesAccesorios/almacen', [proyectoController::class, 'reu'])->name('detallesAccesorios.almacendatos')->middleware('can:· ·');
    Route::get('/datos/ejecutar/{id}', [proyectoController::class, 'ejecutarProyectodatos'])->name('datos.ejecutar')->middleware('can:proyecto.install');
    Route::post('/registrar/trabajoEjecutado/{id}', [proyectoController::class, 'registrarTrabajo'])->name('registrar.trabajoejecutado')->middleware('can:proyecto.create');
    Route::get('/Almacen/detalles/pdf{id}', [proyectoController::class, 'generarPdf'])->name('Almacen.pdf');

    Route::get('/proyectos/ObrasEjecutadas', [proyectoController::class, 'datosObras'])->name('proyectos.ObrasEjecutadas')->middleware('can:proyecto.show');

    Route::get('/dashproyectos', [proyectoController::class, 'dashproy'])->name('dashproyectos')->middleware('can:dashboard.show');

    Route::get('/dashdetalles', [proyectoController::class, 'dashdetall'])->name('dashdetalles')->middleware('can:dashboard.show');

    //rutar para reelevamiento---------------------------------------------------------------------------------------
    Route::get('/reelevamientos', [ReelevamientoController::class, 'showDist'])->name('reelevamientos');
    Route::get('/reelevamientos/dis/{id}', [ReelevamientoController::class, 'index'])->name('reelevamientos.dis');
    Route::post('/reelevamiento/create', [ReelevamientoController::class, 'create'])->name('reelevamiento.create');
    Route::post('/reelevamiento/modificar{id}', [ReelevamientoController::class, 'modificar'])->name('reelevamiento.modificar');
    Route::get('/eliminar/reelevamiento{id}', [ReelevamientoController::class, 'destroy'])->name('eliminar.reelevamiento');

    //ruta para ver  distritos----------------------------------------------------------------------
    Route::get('/detallesDistritos', [distritoController::class, 'index'])->name('detalles.Distritos')->middleware('can:Distritos.show');
    Route::post('/registro/distrito', [distritoController::class, 'create'])->name('registro.distrito')->middleware('can:Distritos.create');
    Route::post('/editar/distrito/{id}', [distritoController::class, 'edit'])->name('editar.distrito')->middleware('can:Distritos.edit');
    Route::get('/editar/urbanizacion/{id}', [distritoController::class, 'datosEdit'])->name('editar.urbanizacion')->middleware('can:Distritos.edit');
    Route::get('/eliminar/urbanizacion{id}', [distritoController::class, 'destroy'])->name('eliminar.urbanizacion')->middleware('can:Distritos.delete');





    /* Auth::routes(); */
});

require __DIR__ . '/auth.php';




// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
