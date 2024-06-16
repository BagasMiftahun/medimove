<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\FormasiController;
use App\Http\Controllers\StokObatController;
use App\Http\Controllers\PerpindahanController;

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
    return redirect()->route('perpindahan.index');
});

Route::resource('obat', ObatController::class);
Route::resource('formasi', FormasiController::class);

Route::resource('stok-obat', StokObatController::class);
Route::get('/stok-obat/{id}/harga', [StokObatController::class, 'getHarga']);

Route::resource('perpindahan', PerpindahanController::class);
Route::get('/get-obat-by-formasi', [PerpindahanController::class, 'getObatByFormasi'])->name('get.obat.by.formasi');
Route::get('/get-obat-perpindahan', [PerpindahanController::class, 'getObatPerpindahan'])->name('get.obat.perpindahan');