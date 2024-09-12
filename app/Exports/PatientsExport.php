<?php

namespace App\Exports;

use App\Models\Pasien;
use App\Models\Patient;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PatientsExport implements FromView, ShouldAutoSize, WithColumnFormatting, WithStyles
{
    public function view(): View
    {
        $patients = Patient::with('identitas', 'asuransi')
            ->select('id', 'birthDate', 'refId', 'nik', 'getDate', 'statusRequest')
            ->where('id', null)
            ->where('statusRequest', 0)
            ->orderBy(
                Pasien::query()
                    ->select('NAMA')
                    ->whereColumn('pasien.NORM', 'patient.refId')
            )
            ->get();

        return view('components.layouts.export', compact('patients'));
    }

    public function columnFormats(): array
    {
        return [
            'C' => '0',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
