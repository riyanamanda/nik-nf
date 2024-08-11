<?php

use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeperawatanController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\SatusehatController;
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
    });

Route::controller(SatusehatController::class)
    ->prefix('satu-sehat')
    ->name('satusehat.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/edit-nik/{norm}/{no_kartu}', 'edit_nik')->name('edit.nik');
        Route::patch('/edit-nik/{norm}', 'update_nik')->name('nik.update');
        Route::get('/export', 'export')->name('export');
    });

Route::controller(PasienController::class)
    ->prefix('pasien')
    ->name('pasien.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/', 'update')->name('update');
    });

Route::controller(KeperawatanController::class)
    ->prefix('keperawatan')
    ->name('keperawatan.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');

        Route::controller(DiagnosaController::class)
            ->prefix('diagnosa')
            ->name('diagnosa.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/create', 'store')->name('store');
                Route::get('/mapping/{diagnosa}', 'mapping')->name('mapping');
                Route::post('/mapping/{diagnosa}', 'mappingStore')->name('mapping.store');

                Route::get('/indikator-keperawatan/{jenis}', 'getIndikator');
            });
    });
