<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MarcaController;

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
    return view('welcome');
});
//rutas para servicios
Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios.index');
Route::post('/servicios', [ServicioController::class, 'store'])->name('servicios.store');

Route::get('/servicios/{servicio}/edit', [ServicioController::class, 'edit'])->name('servicios.edit');
Route::put('/servicios/{servicio}', [ServicioController::class, 'update'])->name('servicios.update');
Route::put('/servicios/{servicio}/toggle', [ServicioController::class, 'EliminacionEstado'])->name('servicios.eliminarEstado');

//rutas para usuarios
Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');

Route::get('/usuarios/{usuario}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{usuario}', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::put('/usuarios/{usuario}/toggle', [UsuarioController::class, 'eliminarEstado'])->name('usuarios.eliminarEstado');

//rutas para equipos
Route::get('/equipos', [EquipoController::class, 'index'])->name('equipos.index');
Route::post('/equipos', [EquipoController::class, 'store'])->name('equipos.store');

Route::get('/equipos/{equipo}/edit', [EquipoController::class, 'edit'])->name('equipos.edit');
Route::put('/equipos/{equipo}', [EquipoController::class, 'update'])->name('equipos.update');
Route::put('/equipos/{equipo}/toggle', [EquipoController::class, 'eliminarEstado'])->name('equipos.eliminarEstado');

//rutas para clientes
Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');

Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
Route::put('/clientes/{cliente}/toggle', [ClienteController::class, 'eliminarEstado'])->name('clientes.eliminarEstado');

//rutas para marca
Route::get('/marcas', [MarcaController::class, 'index'])->name('marcas.index');
Route::post('/marcas', [MarcaController::class, 'store'])->name('marcas.store');

Route::get('/marcas/{marca}/edit', [MarcaController::class, 'edit'])->name('marcas.edit');
Route::put('/marcas/{marca}', [MarcaController::class, 'update'])->name('marcas.update');
Route::put('/marcas/{marca}/toggle', [MarcaController::class, 'eliminarEstado'])->name('marcas.eliminarEstado');