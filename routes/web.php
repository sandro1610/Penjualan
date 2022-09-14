<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChartController;
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
Route::middleware(['is_pimpinan'])->group(function () { 
    Route::get('pimpinan/retur', [ReturController::class, 'pimpinan'])->name('pimpinan.retur');
    Route::get('pimpinan/penjualan', [PenjualanController::class, 'pimpinan'])->name('pimpinan.penjualan');
    Route::get('pimpinan/produk', [ProdukController::class, 'pimpinan'])->name('pimpinan.produk');
});
Route::resource('produks', ProdukController::class);
Route::resource('penjualans', PenjualanController::class);
Route::resource('returs', ReturController::class);
Route::get('/penjualan/cetak_pdf', [PenjualanController::class, 'cetak_pdf'])->name('Cetak_PDF');
Route::get('/produk/cetak_pdf', [ProdukController::class, 'cetak_pdf'])->name('Cetak_PDF');
Route::get('', [DashboardController::class, 'index']);
Route::get('home', [DashboardController::class, 'index'])->name('home');
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('hitung', [DashboardController::class, 'index'])->name('hitung');
Route::get('chart1C1', [ChartController::class, 'chart1C1'])->name('chart1C1');
Route::get('chart1C2', [ChartController::class, 'chart1C2'])->name('chart1C2');
Route::get('chart2C1', [ChartController::class, 'chart2C1'])->name('chart2C1');
Route::get('chart2C2', [ChartController::class, 'chart2C2'])->name('chart2C2');
Route::get('chart3C1', [ChartController::class, 'chart3C1'])->name('chart3C1');
Route::get('chart3C2', [ChartController::class, 'chart3C2'])->name('chart3C2');
Route::get('chart4C1', [ChartController::class, 'chart4C1'])->name('chart4C1');
Route::get('chart4C2', [ChartController::class, 'chart4C2'])->name('chart4C2');
Route::get('chart5C1', [ChartController::class, 'chart5C1'])->name('chart5C1');
Route::get('chart5C2', [ChartController::class, 'chart5C2'])->name('chart5C2');

