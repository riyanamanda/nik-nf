<?php

namespace App\Http\Controllers;

use App\Models\DiagnosaKeperawatan;
use App\Models\IndikatorKeperawatan;
use App\Models\JenisIndikatorKeperawatan;
use App\Models\MappingDiagnosaIndikator;
use Illuminate\Http\Request;

class DiagnosaController extends Controller
{
    public function index()
    {
        $diagnosa = DiagnosaKeperawatan::query()
            ->latest('ID')
            ->paginate(10);

        return view('pages.keperawatan.diagnosa.index', compact('diagnosa'));
    }

    public function create()
    {
        return view('pages.keperawatan.diagnosa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:gos_medicalrecord.diagnosa_keperawatan,KODE',
            'deskripsi' => 'required',
        ]);

        DiagnosaKeperawatan::create([
            'KODE' => $request->kode,
            'DESKRIPSI' => $request->deskripsi,
        ]);

        return to_route('keperawatan.diagnosa.index')->withToastSuccess('Diagnosa berhasil disimpan');
    }

    public function mapping(DiagnosaKeperawatan $diagnosa)
    {
        $mapping = MappingDiagnosaIndikator::with('jenis_indikator', 'indikator', 'diagnosa')
            ->where('DIAGNOSA', $diagnosa->ID)
            ->latest('ID')
            ->paginate(10);

        $jenis = JenisIndikatorKeperawatan::query()
            ->whereIn('id', [1, 2, 3, 4, 5, 10, 11])
            ->get();
        $indikator = IndikatorKeperawatan::all();

        return view('pages.keperawatan.diagnosa.mapping', compact('diagnosa', 'mapping', 'jenis', 'indikator'));
    }

    public function mappingStore(Request $request, DiagnosaKeperawatan $diagnosa)
    {
        $request->validate([
            'jenis_indikator' => 'required|numeric',
            'indikator' => 'required|numeric',
        ]);

        MappingDiagnosaIndikator::create([
            'JENIS' => $request->jenis_indikator,
            'INDIKATOR' => $request->indikator,
            'DIAGNOSA' => $diagnosa->ID,
        ]);

        return back()->withToastSuccess('Mapping berhasil disimpan');
    }

    public function getIndikator($jenis)
    {
        $indikator_keperawatan = IndikatorKeperawatan::query()
            ->where('JENIS', $jenis)
            ->orderBy('DESKRIPSI', 'ASC')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $indikator_keperawatan,
        ], 200);
    }
}
