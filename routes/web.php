<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SapiController;

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
    return view('depan');
});



Route::get('/sapi', [SapiController::class, 'index'])->name('sapi.index');
Route::get('/sapi/create', [SapiController::class, 'create'])->name('sapi.create');
Route::post('/sapi', [SapiController::class, 'store'])->name('sapi.store');
Route::get('/sapi/{sapi}/edit', [SapiController::class, 'edit'])->name('sapi.edit');
Route::put('/sapi/{sapi}/update', [SapiController::class, 'update'])->name('sapi.update');
Route::delete('/sapi/{sapi}/destroy', [SapiController::class, 'destroy'])->name('sapi.destroy');