<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\FormasiController;
use App\Http\Controllers\StokObatController;

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
    return view('welcome');
});

Route::resource('obat', ObatController::class);
Route::resource('formasi', FormasiController::class);

Route::resource('stok-obat', StokObatController::class);
Route::get('/stok-obat/{id}/harga', [StokObatController::class, 'getHarga']);