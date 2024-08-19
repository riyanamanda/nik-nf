<?php

use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IntervensiController;
use App\Http\Controllers\KeperawatanController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\SatusehatController;
use App\Models\KartuIdentitasPasien;
use App\Models\Pasien;
use App\Models\Reservasi;
use App\Models\TaskActionAntrian;
use App\Models\TaskAntrianBridge;
use Carbon\Carbon;
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

        Route::controller(IntervensiController::class)
            ->prefix('intervensi')
            ->name('intervensi.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/mapping/{intervensi}', 'mapping')->name('mapping');
                Route::post('/mapping/{intervensi}', 'mappingStore')->name('mapping.store');
            });
    });

Route::get('/task-antrian-4', function () {
    $deleteTask = TaskActionAntrian::query()
        ->where('RESPONSE', 'LIKE', '%TaskId terakhir 3%')
        ->get();

    foreach ($deleteTask as $task) {
        $task->delete();
    }

    $reservasi = Reservasi::with('taa')
        ->where('TANGGALKUNJUNGAN', Carbon::today())
        ->where('STATUS', 2)
        ->get();

    foreach ($reservasi as $res) {
        $t4 = $res->taa->where('TASK_ID', 4)->first();

        if (is_null($t4)) {
            $tab = TaskAntrianBridge::query()
                ->where('REF', $res->POLI . $res->ID)
                ->where('TANGGAL', Carbon::today()->toDateString())
                ->where('TASK_ID', 4)
                ->first();

            if (!is_null($tab)) {
                TaskActionAntrian::create([
                    'TASK_ID' => $tab->TASK_ID,
                    'ANTRIAN' => $res->ID,
                    'TANGGAL' => $tab->TANGGAL_TASK,
                    'WAKTU' => $tab->TANGGAL_TASK,
                    'STATUS' => 0
                ]);
            }
        }
    }

    return to_route('home')->withToastSuccess('Task ID 4 telah diperbaharui!');
})->name('task.id.4');
