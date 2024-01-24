<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControlDiarioController;
use App\Http\Controllers\RubroController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecepcionInventarioController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/getResumenVentas', [DashboardController::class, 'getResumenVentas']);
    Route::get('/dashboard/getResumenCompras', [DashboardController::class, 'getResumenCompras']);

    //RECEPCION INVENTARIO
    Route::get('/inventario/create', [RecepcionInventarioController::class, 'create'])->name('inventario.create');
    Route::post('/inventario/store', [RecepcionInventarioController::class, 'store'])->name('inventario.store');

    //CONTROL DIARIO
    Route::get('/daily', [ControlDiarioController::class, 'index'])->name('control.index');
    Route::post('/daily', [ControlDiarioController::class, 'store'])->name('control.store');

    Route::get('/getClientHistory', [ControlDiarioController::class, 'getClientHistory'])->name('control.history');

    //RUBROS
    Route::get('/rubros', [RubroController::class, 'index'])->name('rubros');

    Route::get('/rubros/create', [RubroController::class, 'create'])->name('rubros.create');
    Route::post('/rubros', [RubroController::class, 'store'])->name('rubros.store');

    Route::get('/rubros/{rubro}', [RubroController::class, 'show'])->name('rubros.show');

    Route::get('/rubros/{rubro}/edit', [RubroController::class, 'edit'])->name('rubros.edit');
    Route::put('/rubros/{rubro}', [RubroController::class, 'update'])->name('rubros.update');

    //USUARIOS
    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios');

    Route::get('/usuarios/create', [UserController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');

    Route::get('/usuarios/{usuario}', [UserController::class, 'show'])->name('usuarios.show');

    Route::get('/usuarios/{usuario}/edit', [UserController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{usuario}', [UserController::class, 'update'])->name('usuarios.update');

    //REPORTES
    Route::get('/reportes/diario', [ReportesController::class, 'getReporteDiario'])->name('reporte.diario');
    Route::get('/reportes/personalizado', [ReportesController::class, 'getReportePersonalizado'])->name('reporte.personalizado');
    Route::get('/reportes/personalizado/info', [ReportesController::class, 'getReportePersonalizadoInfo'])->name('reporte.personalizado.info');
    Route::get('/reportes/inventario', [ReportesController::class, 'getInventarioIndex'])->name('reporte.inventario');
    Route::get('/reportes/inventario/{inventario}', [ReportesController::class, 'getInventarioDetail'])->name('reporte.inventario.detalle');
});

/*Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/dashboard/getResumenVentas', [DashboardController::class, 'getResumenVentas']);
Route::get('/dashboard/getResumenCompras', [DashboardController::class, 'getResumenCompras']);

//RECEPCION INVENTARIO
Route::get('/inventario/create', [RecepcionInventarioController::class, 'create'])->name('inventario.create');
Route::post('/inventario/store', [RecepcionInventarioController::class, 'store'])->name('inventario.store');

//CONTROL DIARIO
Route::get('/daily', [ControlDiarioController::class, 'index'])->name('control.index');
Route::post('/daily', [ControlDiarioController::class, 'store'])->name('control.store');

Route::get('/getClientHistory', [ControlDiarioController::class, 'getClientHistory'])->name('control.history');

//RUBROS
Route::get('/rubros', [RubroController::class, 'index'])->name('rubros');

Route::get('/rubros/create', [RubroController::class, 'create'])->name('rubros.create');
Route::post('/rubros', [RubroController::class, 'store'])->name('rubros.store');

Route::get('/rubros/{rubro}', [RubroController::class, 'show'])->name('rubros.show');

Route::get('/rubros/{rubro}/edit', [RubroController::class, 'edit'])->name('rubros.edit');
Route::put('/rubros/{rubro}', [RubroController::class, 'update'])->name('rubros.update');

//USUARIOS
Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios');

Route::get('/usuarios/create', [UserController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');

Route::get('/usuarios/{usuario}', [UserController::class, 'show'])->name('usuarios.show');

Route::get('/usuarios/{usuario}/edit', [UserController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{usuario}', [UserController::class, 'update'])->name('usuarios.update');

//REPORTES
Route::get('/reportes/diario', [ReportesController::class, 'getReporteDiario'])->name('reporte.diario');
Route::get('/reportes/personalizado', [ReportesController::class, 'getReportePersonalizado'])->name('reporte.personalizado');
Route::get('/reportes/personalizado/info', [ReportesController::class, 'getReportePersonalizadoInfo'])->name('reporte.personalizado.info');
Route::get('/reportes/inventario', [ReportesController::class, 'getInventarioIndex'])->name('reporte.inventario');
Route::get('/reportes/inventario/{inventario}', [ReportesController::class, 'getInventarioDetail'])->name('reporte.inventario.detalle');*/
