<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicioController;

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

Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios.index');
Route::post('/servicios', [ServicioController::class, 'store'])->name('servicios.store');

Route::get('/servicios/{servicio}/edit', [ServicioController::class, 'edit'])->name('servicios.edit');
Route::put('/servicios/{servicio}', [ServicioController::class, 'update'])->name('servicios.update');
Route::put('/servicios/{servicio}/toggle', [ServicioController::class, 'EliminacionEstado'])->name('servicios.eliminarEstado');

