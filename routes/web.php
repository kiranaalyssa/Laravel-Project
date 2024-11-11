<?php

use App\Http\Controllers\PasienController;
use Illuminate\Support\Facades\Route;

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

Route::get('pasien', [PasienController::class, 'index']);
Route::post('pasien', [PasienController::class, 'store']);
Route::post('/pasien/tambah-kunjungan', [PasienController::class, 'tambahKunjungan'])->name('pasien.tambahKunjungan');
