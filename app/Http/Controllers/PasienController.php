<?php

namespace App\Http\Controllers;

use App\Models\Cetakan;
use App\Models\Consent;
use App\Models\KartuAsuransiPasien;
use App\Models\KartuIdentitasPasien;
use App\Models\KeluargaPasien;
use App\Models\KontakKeluargaPasien;
use App\Models\KontakPasien;
use App\Models\Pasien;
use App\Models\PasienLog;
use App\Models\Patient;
use App\Models\Peserta;
use App\Models\PesertaBpjs;
use App\Models\Reservasi;
use App\Models\ReservasiTmp;
use App\Models\SuratRujukanPasien;
use App\Models\Tagihan;
use App\Models\TaskAntrianBridge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    public function index()
    {
        return view('pages.pasien.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'norm' => 'required|numeric',
            'norm_baru' => 'required|numeric',
        ]);

        $pasien = Pasien::query()
            ->where('NORM', $request->norm)
            ->get();

        if ($pasien->count() > 1) {
            return back()->withToastError('NORM lebih dari 1');
        }

        if ($pasien->isEmpty()) {
            return back()->withToastError('NORM tidak ditemukan');
        }

        $new_pasien = Pasien::query()
            ->where('NORM', $request->norm_baru)
            ->get();

        if ($new_pasien->isNotEmpty()) {
            return back()->withToastError('NORM ' . $request->norm_baru . ' sudah ada.');
        }

        DB::connection('gos_master')->transaction(function () use ($request) {
            $ktp = KartuIdentitasPasien::where('NORM', $request->norm)->get();
            if ($ktp->isNotEmpty()) {
                foreach ($ktp as $new_ktp) {
                    $new_ktp->update([
                        'NORM' => $request->norm_baru,
                    ]);
                }
            }

            $asuransi = KartuAsuransiPasien::where('NORM', $request->norm)->get();
            if ($asuransi->isNotEmpty()) {
                foreach ($asuransi as $new_asuransi) {
                    $new_asuransi->update([
                        'NORM' => $request->norm_baru,
                    ]);
                }
            }

            $keluarga = KeluargaPasien::where('NORM', $request->norm)->get();
            if ($keluarga->isNotEmpty()) {
                foreach ($keluarga as $new_keluarga) {
                    $new_keluarga->update([
                        'NORM' => $request->norm_baru,
                    ]);
                }
            }

            $kontak_keluarga = KontakKeluargaPasien::where('NORM', $request->norm)->get();
            if ($kontak_keluarga->isNotEmpty()) {
                foreach ($kontak_keluarga as $new_kontak_keluarga) {
                    $new_kontak_keluarga->update([
                        'NORM' => $request->norm_baru,
                    ]);
                }
            }

            $kontak_pasien = KontakPasien::where('NORM', $request->norm)->get();
            if ($kontak_pasien->isNotEmpty()) {
                foreach ($kontak_pasien as $new_kontak_pasien) {
                    $new_kontak_pasien->update([
                        'NORM' => $request->norm_baru,
                    ]);
                }
            }

            $log = PasienLog::where('NORM', $request->norm)->get();
            if ($log->isNotEmpty()) {
                foreach ($log as $new_log) {
                    $new_log->update([
                        'norm' => $request->norm_baru,
                    ]);
                }
            }

            DB::connection('gos_ihs')->transaction(function () use ($request) {
                $patient = Patient::where('refId', $request->norm)->get();
                if ($patient->isNotEmpty()) {
                    foreach ($patient as $new_patient) {
                        $new_patient->update([
                            'refId' => $request->norm_baru,
                        ]);
                    }
                }

                $consent = Consent::where('norm', $request->norm)->get();
                if ($consent->isNotEmpty()) {
                    foreach ($consent as $new_consent) {
                        $new_consent->update([
                            'norm' => $request->norm_baru,
                        ]);
                    }
                }

                DB::connection('gos_regonline')->transaction(function () use ($request) {
                    $peserta = Peserta::where('norm', $request->norm)->get();
                    if ($peserta->isNotEmpty()) {
                        foreach ($peserta as $new_peserta) {
                            $new_peserta->update([
                                'NORM' => $request->norm_baru,
                            ]);
                        }
                    }

                    $reservasi = Reservasi::where('norm', $request->norm)->get();
                    if ($reservasi->isNotEmpty()) {
                        foreach ($reservasi as $new_reservasi) {
                            $new_reservasi->update([
                                'NORM' => $request->norm_baru,
                            ]);
                        }
                    }

                    $reservasi_tmp = ReservasiTmp::where('norm', $request->norm)->get();
                    if ($reservasi_tmp->isNotEmpty()) {
                        foreach ($reservasi_tmp as $new_reservasi_tmp) {
                            $new_reservasi_tmp->update([
                                'NORM' => $request->norm_baru,
                            ]);
                        }
                    }

                    $task_antrian_bridge = TaskAntrianBridge::where('norm', $request->norm)->get();
                    if ($task_antrian_bridge->isNotEmpty()) {
                        foreach ($task_antrian_bridge as $new_task_antrian_bridge) {
                            $new_task_antrian_bridge->update([
                                'NORM' => $request->norm_baru,
                            ]);
                        }
                    }

                    DB::connection('gos_cetakan')->transaction(function () use ($request) {
                        $kartu_pasien = Cetakan::where('norm', $request->norm)->get();
                        if ($kartu_pasien->isNotEmpty()) {
                            foreach ($kartu_pasien as $new_kartu_pasien) {
                                $new_kartu_pasien->update([
                                    'norm' => $request->norm_baru,
                                ]);
                            }
                        }

                        DB::connection('gos_bpjs')->transaction(function () use ($request) {
                            $peserta_bpjs = PesertaBpjs::where('norm', $request->norm)->get();
                            if ($peserta_bpjs->isNotEmpty()) {
                                foreach ($peserta_bpjs as $new_peserta_bpjs) {
                                    $new_peserta_bpjs->update([
                                        'NORM' => $request->norm_baru,
                                    ]);
                                }
                            }

                            DB::connection('gos_pembayaran')->transaction(function () use ($request) {
                                $tagihan = Tagihan::where('REF', $request->norm)->get();
                                if ($tagihan->isNotEmpty()) {
                                    foreach ($tagihan as $new_tagihan) {
                                        $new_tagihan->update([
                                            'REF' => $request->norm_baru,
                                        ]);
                                    }
                                }

                                DB::connection('gos_pendaftaran')->transaction(function () use ($request) {
                                    $rujukan = SuratRujukanPasien::where('NORM', $request->norm)->get();
                                    if ($rujukan->isNotEmpty()) {
                                        foreach ($rujukan as $new_rujukan) {
                                            $new_rujukan->update([
                                                'NORM' => $request->norm_baru,
                                            ]);
                                        }
                                    }
                                });
                            });
                        });
                    });
                });
            });
        });

        return to_route('pasien.index')->withToastSuccess('NORM berhasil diubah, silahkan ubah manual di DB pendaftaran.pendaftaran jika pasien sudah pernah terdaftar ke poli.');
    }
}
