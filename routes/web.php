<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DolarController;
use App\Http\Controllers\DetalleCotizacionController;

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

Route::get('/', [DolarController::class, 'obtenerCotizaciones']);
Route::post('/detalle-cotizacion', [DetalleCotizacionController::class, 'detalleCotizacion'])->name('detalle.cotizacion');


