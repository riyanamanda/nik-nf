<?php

use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IntervensiController;
use App\Http\Controllers\KeperawatanController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\SatusehatController;
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
        ->orWhere('TANGGAL', '0000-00-00 00:00:00')
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
                ->where('REF', $res->POLI.$res->ID)
                ->where('TANGGAL', Carbon::today()->toDateString())
                ->get();

            $t3 = $tab->where('TASK_ID', 3)->first();
            $t5 = $tab->where('TASK_ID', 5)->first();

            if (! is_null($t3) || ! is_null($t5)) {
                $t3_time = strtotime($t3->TANGGAL_TASK);
                $t5_time = strtotime($t5->TANGGAL_TASK);

                if ($t3_time < $t5_time) {
                    $new_t4 = mt_rand($t3_time, $t5_time);
                    $final_t4 = date('Y-m-d H:i:s', $new_t4);

                    if ($tab->isNotEmpty()) {
                        TaskActionAntrian::create([
                            'TASK_ID' => 4,
                            'ANTRIAN' => $res->ID,
                            'TANGGAL' => $final_t4,
                            'WAKTU' => $final_t4,
                            'STATUS' => 0,
                        ]);
                    }
                }
            }
        }
    }

    return to_route('home')->withToastSuccess('Task ID 4 telah diperbaharui!');
})->name('task.id.4');
