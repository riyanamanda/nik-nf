<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeperawatanController;
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

Route::controller(HomeController::class)
    ->group(function () {
        Route::get('/', 'index')->name('home');
        Route::get('/edit-nik/{norm}/{no_kartu}', 'edit_nik')->name('edit.nik');
        Route::patch('/edit-nik/{norm}', 'update_nik')->name('edit.update');
        Route::get('/export', 'export')->name('export');
    });

Route::controller(PasienController::class)
    ->group(function () {
        Route::get('/pasien', 'index')->name('pasien.index');
        Route::put('/pasien', 'update')->name('pasien.update');
    });

Route::controller(KeperawatanController::class)
    ->group(function () {
        Route::get('/keperawatan', 'index')->name('keperawatan.index');
        Route::post('/keperawatan', 'store')->name('keperawatan.store');
    });
