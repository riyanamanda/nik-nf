<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\TaskActionAntrian;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function taskId4()
    {
        $this->deleteInvalidAntrian();

        $reservasi = Reservasi::with('taa')
            ->where('TANGGALKUNJUNGAN', Carbon::today())
            ->where('STATUS', 2)
            ->get();

        foreach ($reservasi as $res) {
            $t3_taa = $res->taa->where('TASK_ID', 3)->first();
            $t4_taa = $res->taa->where('TASK_ID', 4)->first();
            $t5_taa = $res->taa->where('TASK_ID', 5)->first();

            if (! is_null($t3_taa) && is_null($t4_taa) && ! is_null($t5_taa)) {
                $t3_time = strtotime($t3_taa->TANGGAL) + 60;
                $t5_time = strtotime($t5_taa->TANGGAL) - 60;

                if ($t3_time < $t5_time) {
                    $new_t4 = mt_rand($t3_time, $t5_time);
                    $final_t4 = date('Y-m-d H:i:s', $new_t4);

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

        return to_route('home')->withToastSuccess('Task ID 4 telah diperbaharui!');
    }

    public function taskId5()
    {
        $this->deleteInvalidAntrian();

        $reservasi = Reservasi::with('taa')
            ->where('TANGGALKUNJUNGAN', Carbon::today())
            ->where('STATUS', 2)
            ->get();

        foreach ($reservasi as $res) {
            $t4_taa = $res->taa->where('TASK_ID', 4)->first();
            $t5_taa = $res->taa->where('TASK_ID', 5)->first();
            $t6_taa = $res->taa->where('TASK_ID', 6)->first();

            if (! is_null($t5_taa) && $t5_taa->STATUS == 0) {
                if (strtotime($t5_taa->TANGGAL) <= strtotime($t4_taa->TANGGAL)) {
                    $t5_taa->delete();
                }
            }

            $checkT5 = TaskActionAntrian::where('ANTRIAN', $res->ID)->where('TASK_ID', 5)->first();

            if (! is_null($t4_taa) && is_null($checkT5) && ! is_null($t6_taa)) {
                $t4_time = strtotime($t4_taa->TANGGAL) + 30;
                $t6_time = strtotime($t6_taa->TANGGAL) - 30;

                if ($t4_time < $t6_time) {
                    $new_t5 = mt_rand($t4_time, $t6_time);
                    $final_t5 = date('Y-m-d H:i:s', $new_t5);

                    TaskActionAntrian::create([
                        'TASK_ID' => 5,
                        'ANTRIAN' => $res->ID,
                        'TANGGAL' => $final_t5,
                        'WAKTU' => $final_t5,
                        'STATUS' => 0,
                    ]);
                }
            }
        }

        return to_route('home')->withToastSuccess('Task ID 5 telah diperbaharui!');
    }

    public function deleteInvalidAntrian()
    {
        $deleteTask = TaskActionAntrian::query()
            ->where('RESPONSE', 'LIKE', '%TaskId terakhir 3%')
            ->orWhere('TANGGAL', '0000-00-00 00:00:00')
            ->get();

        foreach ($deleteTask as $task) {
            $task->delete();
        }
    }
}
