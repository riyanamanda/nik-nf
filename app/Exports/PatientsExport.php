<?php

namespace App\Exports;

use App\Models\Patient;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class PatientsExport implements FromView, WithColumnFormatting
{
    public function view(): View
    {
        $patients = Patient::with('identitas')
            ->select('id', 'refId', 'nik', 'statusRequest')
            ->where('id', null)
            ->where('statusRequest', 0)
            ->get();

        return view('layouts.export', compact('patients'));
    }

    public function columnFormats(): array
    {
        return [
            'B' => '0',
        ];
    }
}
