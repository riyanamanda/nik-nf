<?php

namespace App\Http\Controllers;

use App\Exports\PatientsExport;
use App\Models\Pasien;
use App\Models\Patient;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    public function index()
    {
        $patients = Patient::with('identitas')
            ->select('id', 'refId', 'nik', 'getDate', 'statusRequest')
            ->where('id', null)
            ->where('statusRequest', 0)
            ->orderBy(
                Pasien::query()
                    ->select('NAMA')
                    ->whereColumn('pasien.NORM', 'patient.refId')
            )
            ->paginate(10);

        return view('home', compact('patients'));
    }

    public function export()
    {
        return Excel::download(new PatientsExport, 'patient.xlsx');
    }
}
