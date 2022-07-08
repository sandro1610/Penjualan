<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReturController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenjualanController;

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

Auth::routes();
Route::resource('produks', ProdukController::class);
Route::resource('penjualans', PenjualanController::class);
Route::resource('returs', ReturController::class);
Route::get('', [DashboardController::class, 'index'])->name('Dashboard');
Route::get('dashboard', [DashboardController::class, 'index'])->name('Dashboard');

