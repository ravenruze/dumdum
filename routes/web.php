<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SapiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesananController;
use App\Models\Sapi;

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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');



Route::get('/sapi', [SapiController::class, 'index'])->name('sapi.index');
Route::get('/sapi/create', [SapiController::class, 'create'])->name('sapi.create');
Route::post('/sapi', [SapiController::class, 'store'])->name('sapi.store');
Route::get('/sapi/{sapi}/edit', [SapiController::class, 'edit'])->name('sapi.edit');
Route::put('/sapi/{sapi}/update', [SapiController::class, 'update'])->name('sapi.update');
Route::delete('/sapi/{sapi}/destroy', [SapiController::class, 'destroy'])->name('sapi.destroy');


Route::get('/sapi/{sapi}/booking', [PesananController::class, 'create'])->name('pesanan.create');
Route::post('/sapi/{sapi}/booking', [PesananController::class, 'store'])->name('pesanan.store');
Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
Route::get('/pesanan/{pesanan}', [PesananController::class, 'show'])->name('pesanan.show');