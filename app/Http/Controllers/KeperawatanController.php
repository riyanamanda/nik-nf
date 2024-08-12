<?php

namespace App\Http\Controllers;

use App\Enums\KategoriIndikatorKeperawatanEnum;
use App\Models\IndikatorKeperawatan;
use App\Models\JenisIndikatorKeperawatan;
use Illuminate\Http\Request;

class KeperawatanController extends Controller
{
    public function index()
    {
        $keperawatan = IndikatorKeperawatan::with('jenis_indikator')
            ->orderBy('DESKRIPSI', 'ASC')
            ->paginate(10);

        $jenis = JenisIndikatorKeperawatan::all();
        $kategori = KategoriIndikatorKeperawatanEnum::cases();

        return view('pages.keperawatan.index', compact('keperawatan', 'jenis', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_indikator' => 'required|numeric ',
            'deskripsi' => 'required|string',
            'kategori' => 'required|numeric ',
        ]);

        $check = IndikatorKeperawatan::query()
            ->where('JENIS', $request->jenis_indikator)
            ->where('DESKRIPSI', $request->deskripsi)
            ->first();

        if ($check) {
            return back()->withToastError('Jenis dan Deskripsi sudah ada, periksa kembali inputan anda!');
        }

        IndikatorKeperawatan::create([
            'JENIS' => $request->jenis_indikator,
            'DESKRIPSI' => $request->deskripsi,
            'KATEGORI' => $request->kategori,
        ]);

        return to_route('keperawatan.index')->withToastSuccess('Indikator berhasil disimpan');
    }
}
