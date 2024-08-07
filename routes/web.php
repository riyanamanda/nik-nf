<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PasienController;
use App\Models\DiagnosaKeperawatan;
use Illuminate\Support\Facades\File;
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
