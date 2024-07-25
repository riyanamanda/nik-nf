<?php

namespace App\Http\Controllers;

use App\Exports\PatientsExport;
use App\Models\KartuIdentitasPasien;
use App\Models\Pasien;
use App\Models\Patient;
use Bpjs\Bridging\Vclaim\BridgeVclaim;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    protected $bridging;

    public function __construct()
    {
        $this->bridging = new BridgeVclaim();
    }

    public function index()
    {
        $patients = Patient::with('identitas', 'asuransi')
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

    public function edit_nik($refid, $no_kartu)
    {
        $patient = Patient::query()
            ->where('refId', $refid)
            ->first();

        if (is_null($patient->kartu)) {
            return back()->withToastError('Pasien tidak memiliki NIK di master pasien!');
        }

        $time = Carbon::now()->format('Y-m-d');
        $endpoint = 'Peserta/nokartu/'.$no_kartu.'/tglSEP/'.$time;
        $bpjs = json_decode($this->bridging->getRequest($endpoint), true);

        if ($bpjs['response'] == null) {
            return back()->withToastError($patient->identitas->NAMA.' '.$bpjs['metaData']['message']);
        }

        return view('edit-nik', compact('patient', 'bpjs'));
    }

    public function update_nik(Request $request, $norm)
    {
        if (! is_null($request->norm_bpjs) && $norm != $request->norm_bpjs) {
            return back()->withToastError('No RM tidak sesuai');
        }

        DB::connection('gos_master')->transaction(function () use ($request, $norm) {
            $pasien = Pasien::where('NORM', $norm)->first();
            $pasien->update([
                'TANGGAL_LAHIR' => $request->tgl_lahir,
            ]);

            $kip = KartuIdentitasPasien::query()
                ->where('NORM', $norm)
                ->where('JENIS', 1)
                ->first();
            $kip->update([
                'NOMOR' => $request->nik,
            ]);

            DB::connection('gos_ihs')->transaction(function () use ($request, $norm) {
                $patient = Patient::where('refId', $norm)->first();
                $patient->update([
                    'nik' => $request->nik,
                    'statusRequest' => 1,
                ]);
            });
        });

        return to_route('home')->withToastSuccess('Updated successfully');
    }
}
