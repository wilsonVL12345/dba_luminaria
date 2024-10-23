<?php

use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DetalleController;
use App\Http\Controllers\DistritoController;
use App\Http\Controllers\EquipamientoController;
use App\Http\Controllers\InspeccionController;

use App\Http\Controllers\Lista_accesorioController;
use App\Http\Controllers\Logincontroller;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Router;
// use App\Http\Controllers\logincontroller;
use App\Http\Controllers\Luminaria_retiradasController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProyectoController;
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
    /* Route::post('/inicia-sesion', [Logincontroller::class, 'login'])->name('inicia-sesion');
    Route::get('/logout', [Logincontroller::class, 'logout'])->name('logout'); */


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
    Route::get('/restablecer/usuario{id}', [UserController::class, 'restablecer'])->name('restablecer.usuario')->middleware('can:user.delete');
    Route::get('/listaUsers', [UserController::class, 'getUserData'])->name('listaUsers.usuario')->middleware('can:user.show');
    Route::get('/datosUser{id}', [UserController::class, 'editDatosUser'])->name('datosUser.usuario')->middleware('can:user.edit');

    // cambiar contraseña
    Route::get('/cambiar/password{id}', [LoginController::class, 'showcambiarPassword'])->name('cambiar.password');
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
    Route::get('/agendar', [DetalleController::class, 'agendar'])->name('agendar')->middleware('can:agendar.show');
    // crea el trabajo para que posteriormente lo ejecute el tecnico
    Route::post('/agendar/trabajo', [DetalleController::class, 'create'])->name('agendar.trabajo')->middleware('can:agendar.show');

    //ruta para ver los detalles generales de los trabajos------------------------------------------------------------------------------------------
    Route::get('/detalles/espera', [DetalleController::class, 'index'])->name('detalles.espera')->middleware('can:detallesGen.show');
    Route::get('/listadatos/espera', [DetalleController::class, 'getTrabEsperaData'])->name('listadatos.espera')->middleware('can:detallesGen.show');
    Route::get('/editdatos/esperaa{id}', [DetalleController::class, 'editDatosEspera'])->name('editdatos.espera')->middleware('can:detallesGen.edit');

    Route::get('/detalles/realizados', [DetalleController::class, 'realizados'])->name('detalles.realizados')->middleware('can:detallesGen.show');
    Route::get('/listadatos/realizados', [DetalleController::class, 'getTrabajoRealizadoData'])->name('listadatos.realizados')->middleware('can:detallesGen.show');

    Route::get('/detalles/realizados/edit{id}', [DetalleController::class, 'editRealizadosShow'])->name('detalles.realizadosEdit')->middleware('can:detallesGen.edit');
    Route::get('/detalles/mantenimiento/pdf{id}', [DetalleController::class, 'generarpdf'])->name('detalles.pdf')->middleware('can:detallesGen.report');

    Route::get('/detalle/realizados/informacion/{id}', [DetalleController::class, 'DetallesRealizado'])->name('realizados.informacion')->middleware('can:detallesGen.show');
    Route::get('/eliminar/detallegen{id}', [DetalleController::class, 'destroy'])->name('eliminar.detallegen')->middleware('can:detallesGen.delete');
    //rutas  para  detalles en espera,realizar trabajo------------------------------------------------------------------------------------------
    Route::get('/ejecutar/trabajo/{id}', [DetalleController::class, 'ejecutar'])->name('ejecutar.trabajo')->middleware('can:realizar.show');

    Route::get('/pendiente/trabajo', [DetalleController::class, 'pendiente'])->name('pendiente.trabajo')->middleware('can:realizar.show');
    Route::post('/store/trabajo/{id}', [DetalleController::class, 'storeTrabajo'])->name('store.trabajo')->middleware('can:realizar.show');
    Route::post('/edit/espera/{id}', [DetalleController::class, 'edit'])->name('edit.espera')->middleware('can:detallesGen.edit');
    Route::post('/edit/realizado/{id}', [DetalleController::class, 'editRealizado'])->name('edit.realizado')->middleware('can:detallesGen.edit');
    Route::get('/lista/Pendiente', [DetalleController::class, 'getTrabPendientesData'])->name('lista.Pendiente')->middleware('can:realizar.show');






    //ruta para inspecciones----------------------------------------------------------------------------------------------------
    Route::get('/inspecciones/espera', [InspeccionController::class, 'index'])->name('inspecciones.espera')->middleware('can:inspecciones.show');
    Route::post('/registro/inspecciones', [InspeccionController::class, 'create'])->name('registro.inspecciones')->middleware('can:inspecciones.create');
    Route::post('/editar/inspeccionespera{id}', [InspeccionController::class, 'edit'])->name('editar.inspeccionespera')->middleware('can:inspecciones.edit');

    Route::get('/Empezar/inspeccion{id}', [InspeccionController::class, 'EmpezarInspeccion'])->name('Empezar.inspeccion')->middleware('can:inspecciones.install');
    Route::post('/empezar/inspeccionespera{id}', [InspeccionController::class, 'ready'])->name('empezar.inspeccionespera')->middleware('can:inspecciones.install');
    Route::get('/inspecciones/realizadas', [InspeccionController::class, 'realizadas'])->name('inspecciones.espera')->middleware('can:inspecciones.show');
    Route::post('/inspecciones/editrealizadas/{id}', [InspeccionController::class, 'editRealizada'])->name('inspecciones.editrealizadas')->middleware('can:inspecciones.edit');
    Route::get('/eliminar/inspeccion{id}', [InspeccionController::class, 'destroy'])->name('eliminar.inspeccion')->middleware('can:inspecciones.delete');
    Route::get('/listarDatos/inspeccion', [InspeccionController::class, 'getInspeccioRealizadoData'])->name('listarDatos.inspeccion')->middleware('can:inspecciones.show');
    Route::get('/editDatos/inspeccion/{id}', [InspeccionController::class, 'editInspeccionRealizados'])->name('editDatos.inspeccion')->middleware('can:inspecciones.edit');

    // route::get('/check-new-inspecciones', [InspeccionController::class, 'checkNewInspecciones'])->middleware('auth');
    // Route::post('/mark-inspecciones-seen', [InspeccionController::class, 'markInspeccionesAsSeen'])->middleware('auth');

    Route::get('/listaDatos/inspeccion', [InspeccionController::class, 'getInspeccioEsperaData'])->name('listadatos.inspeccion')->middleware('can:inspecciones.show');

    // Route::get('/editDatos/inspeccion{id}', [InspeccionController::class, 'editInspeccionRealData'])->name('editDatos.inspeccion');
    Route::get('/editDatos/inspeccionEspe/{id}', [InspeccionController::class, 'editInspeccionespe'])->name('editDatos.inspeccionespera')->middleware('can:inspecciones.edit');



    //rutas para equipamiento y accesorios--------------------------------------------------------------------------------
    //ruta para lista de accesorios
    Route::get('/equipos/accesorios', [Lista_accesorioController::class, 'index'])->name('equipos.accesorios')->middleware('can:accesorios.show');
    Route::get('/eliminar/accesorios{id}', [Lista_accesorioController::class, 'destroy'])->name('eliminar.accesorios')->middleware('can:accesorios.delete');
    Route::post('/registro/accesorios', [Lista_accesorioController::class, 'create'])->name('registro.accesorios')->middleware('can:accesorios.create');
    Route::post('/editar/accesorios', [Lista_accesorioController::class, 'edit'])->name('editar.accesorios')->middleware('can:accesorios.edit');
    Route::get('/editdatos/accesorios{id}', [Lista_accesorioController::class, 'editdatos'])->name('editdatos.accesorios')->middleware('can:accesorios.edit');
    Route::get('/listaAccesorios/data', [Lista_accesorioController::class, 'listaAccesoriosdata'])->middleware('can:inspecciones.show');

    //ruta para ver detalles equipamientos
    Route::get('/equipos/equipamiento', [EquipamientoController::class, 'index'])->name('equipos.equipamientos')->middleware('can:equipamiento.show');
    Route::get('/eliminar/equipamiento/{id}', [EquipamientoController::class, 'destroy'])->name('eliminar.equipamiento')->middleware('can:equipamiento.delete');
    Route::get('/equipamiento/distrito', [EquipamientoController::class, 'showEquipDistrito'])->name('equipamiento.distrito')->middleware('can:equipamiento.show');
    //rutar para la parte de equipos equipamientos
    Route::post('/registro/equipamiento', [EquipamientoController::class, 'create'])->name('registro.equipamiento')->middleware('can:equipamiento.create');
    Route::post('/editar/equipamiento', [EquipamientoController::class, 'edit'])->name('editar.equipamiento')->middleware('can:equipamiento.edit');
    Route::get('/editardatos/equipamiento{id}', [EquipamientoController::class, 'editdatos'])->name('editardatos.equipamiento')->middleware('can:equipamiento.edit');
    Route::get('/listaDatos/equipamiento', [EquipamientoController::class, 'listaEquipamientoData'])->name('editdatos.equipamiento')->middleware('can:equipamiento.show');


    //rutas para luminarias retiradas
    Route::get('/proyectos/luminariasRetiradas', [Luminaria_retiradasController::class, 'index'])->name('proyectos.luminariasretiradas')->middleware('can:proyecto.Retirado.show');
    Route::post('/registro/retirados', [Luminaria_retiradasController::class, 'create'])->name('registro.retirados')->middleware('can:proyecto.Retirado.create');
    Route::get('/detalles/luminarias/retiradas/{id}', [Luminaria_retiradasController::class, 'retiradaDetalle'])->name('detalles.luminarias.retiradas')->middleware('can:proyecto.Retirado.show');
    Route::post('/modificar/retirados/{id}', [Luminaria_retiradasController::class, 'editretirada'])->name('modificar.retirados')->middleware('can:proyecto.Retirado.edit');
    Route::get('/eliminar/retirada{id}', [Luminaria_retiradasController::class, 'destroy'])->name('eliminar.retirada')->middleware('can:proyecto.Retirado.delete');
    Route::get('/proyectos/luminariasRetiradas{id}', [Luminaria_retiradasController::class, 'editLuminariasRetiradasShow'])->name('proyectoss.luminariasRetiradas')->middleware('can:proyecto.Retirado.edit');
    Route::get('/retirado/pdf{id}', [Luminaria_retiradasController::class, 'generarPDF'])->name('retirado.pdf')->middleware('can:proyecto.Retirado.edit');
    Route::get('/listaLumRetiradas', [Luminaria_retiradasController::class, 'getProyLumRetiradaData'])->name('listaLumRetiradas');
    // ->middleware('can::proyecto.Retirado.show')
    //rutas proyectos  ---------------------------------------------------------------------------------------------------------
    // para lo que es almacen
    Route::get('/proyectos/almacen', [ProyectoController::class, 'index'])->name('proyectos.almacen')->middleware('can:proyecto.show');
    Route::post('/registro/almacen', [ProyectoController::class, 'create'])->name('registro.almacen')->middleware('can:proyecto.create');
    Route::get('/showModificar/almacen/{id}', [ProyectoController::class, 'editShowEsperaAlmacen'])->name('showmodificar.almacen')->middleware('can:proyecto.edit');
    Route::get('/showModificar/obras/{id}', [ProyectoController::class, 'editShowObras'])->name('showmodificar.obras')->middleware('can:proyecto.edit');
    Route::post('/modificar/almacen/{id}', [ProyectoController::class, 'editEsperaAlmacen'])->name('modificar.almacen')->middleware('can:proyecto.edit');
    Route::post('/modificar/ObrasEjecuatas/{id}', [ProyectoController::class, 'editObrasEjecutadas'])->name('modificar.ObrasEjecuatas')->middleware('can:proyecto.edit');
    Route::get('/eliminar/proyecto{id}', [ProyectoController::class, 'destroy'])->name('eliminar.proyecto')->middleware('can:proyecto.delete');
    Route::get('/detallesAccesorios/almacen/{id}', [ProyectoController::class, 'reu'])->name('detallesAccesorios.almacen')->middleware('can:proyecto.show');
    Route::get('/listaProy/almacen', [ProyectoController::class, 'getProyectoData'])->name('listaProy.almacen')->middleware('can:proyecto.show');
    Route::get('/listaProyObras/almacen', [ProyectoController::class, 'getProyectoObrasData'])->name('listaProyObras.almacen')->middleware('can:proyecto.show');

    // Route::get('/detallesAccesorios/almacen', [ProyectoController::class, 'reu'])->name('detallesAccesorios.almacendatos')->middleware('can:· ·');
    Route::get('/datos/ejecutar/{id}', [ProyectoController::class, 'ejecutarProyectodatos'])->name('datos.ejecutar')->middleware('can:proyecto.install');
    Route::post('/registrar/trabajoEjecutado/{id}', [ProyectoController::class, 'registrarTrabajo'])->name('registrar.trabajoejecutado')->middleware('can:proyecto.create');
    Route::get('/Almacen/detalles/pdf{id}', [ProyectoController::class, 'generarPdf'])->name('Almacen.pdf')->middleware('can:proyecto.report');

    Route::get('/proyectos/ObrasEjecutadas', [ProyectoController::class, 'datosObras'])->name('proyectos.ObrasEjecutadas')->middleware('can:proyecto.show');

    Route::get('/dashproyectos', [ProyectoController::class, 'dashproy'])->name('dashproyectos')->middleware('can:dashboard.show');

    Route::get('/dashdetalles', [ProyectoController::class, 'dashdetall'])->name('dashdetalles')->middleware('can:dashboard.show');

    //rutar para reelevamiento---------------------------------------------------------------------------------------
    Route::get('/reelevamientos', [ReelevamientoController::class, 'showDist'])->name('reelevamientos')->middleware('can:Reelevamiento.show');
    Route::get('/reelevamientos/dis/{id}', [ReelevamientoController::class, 'index'])->name('reelevamientos.dis')->middleware('can:Reelevamiento.show');
    Route::post('/reelevamiento/create', [ReelevamientoController::class, 'create'])->name('reelevamiento.create')->middleware('can:Reelevamiento.create');
    Route::post('/reelevamiento/modificar{id}', [ReelevamientoController::class, 'modificar'])->name('reelevamiento.modificar')->middleware('can:Reelevamiento.edit');
    Route::get('/eliminar/reelevamiento{id}', [ReelevamientoController::class, 'destroy'])->name('eliminar.reelevamiento')->middleware('can:Reelevamiento.delete');
    Route::get('/lista/reelevamiento', [ReelevamientoController::class, 'getReelevamientosData'])->name('lista.reelevamiento')->middleware('can:Reelevamiento.show');
    Route::get('/editardatos/reelevamiento{id}', [ReelevamientoController::class, 'editardatosRelev'])->name('editardatos.reelevamiento')->middleware('can:Reelevamiento.edit');

    //ruta para ver  distritos----------------------------------------------------------------------
    Route::get('/detallesDistritos', [DistritoController::class, 'index'])->name('detalles.Distritos')->middleware('can:Distritos.show');
    Route::post('/registro/distrito', [DistritoController::class, 'create'])->name('registro.distrito')->middleware('can:Distritos.create');
    Route::post('/editar/distrito/{id}', [DistritoController::class, 'edit'])->name('editar.distrito')->middleware('can:Distritos.edit');
    Route::get('/editar/urbanizacion/{id}', [DistritoController::class, 'datosEdit'])->name('editar.urbanizacion')->middleware('can:Distritos.edit');
    Route::get('/eliminar/urbanizacion{id}', [DistritoController::class, 'destroy'])->name('eliminar.urbanizacion')->middleware('can:Distritos.delete');
    Route::get('/urbanizaciones/data', [DistritoController::class, 'getUrbanizacionesData'])->middleware('can:Distritos.show');




    /* Auth::routes(); */
});

require __DIR__ . '/auth.php';




// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
