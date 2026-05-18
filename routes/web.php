<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SapiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PembayaranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () { return view('depan'); });

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/sapi', [SapiController::class, 'index'])->name('sapi.index')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':SuperAdmin,Admin');
Route::get('/sapi/create', [SapiController::class, 'create'])->name('sapi.create')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':SuperAdmin,Admin');
Route::post('/sapi', [SapiController::class, 'store'])->name('sapi.store')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':SuperAdmin,Admin');
Route::get('/sapi/{sapi}/edit', [SapiController::class, 'edit'])->name('sapi.edit')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':SuperAdmin,Admin');
Route::put('/sapi/{sapi}/update', [SapiController::class, 'update'])->name('sapi.update')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':SuperAdmin,Admin');
Route::delete('/sapi/{sapi}/destroy', [SapiController::class, 'destroy'])->name('sapi.destroy')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':SuperAdmin,Admin');

Route::get('/sapi/{sapi}/booking', [PesananController::class, 'create'])->name('pesanan.create')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':SuperAdmin,Admin');
Route::post('/sapi/{sapi}/booking', [PesananController::class, 'store'])->name('pesanan.store')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':SuperAdmin,Admin');
Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':SuperAdmin,Admin');
Route::get('/pesanan/{pesanan}', [PesananController::class, 'show'])->name('pesanan.show')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':SuperAdmin,Admin');
Route::delete('/pesanan/{pesanan}', [PesananController::class, 'destroy'])->name('pesanan.destroy')->middleware(\App\Http\Middleware\RoleMiddleware::class . ':SuperAdmin,Admin');

Route::get('/pesanan/{pesanan}/pembayaran', [PembayaranController::class, 'create'])->name('pembayaran.create');
Route::post('/pesanan/{pesanan}/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
Route::get('/pesanan/{pesanan}/invoice', [PembayaranController::class, 'invoice'])->name('pembayaran.invoice');