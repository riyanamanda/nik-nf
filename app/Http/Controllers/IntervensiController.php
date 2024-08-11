<?php

namespace App\Http\Controllers;

use App\Models\IndikatorKeperawatan;
use App\Models\JenisIndikatorKeperawatan;
use App\Models\MappingIntervensiIndikator;
use Illuminate\Http\Request;

class IntervensiController extends Controller
{
    public function index()
    {
        $intervensi = IndikatorKeperawatan::with('jenis_indikator')
            ->where('JENIS', 5)
            ->latest('ID')
            ->paginate(10);

        return view('pages.keperawatan.intervensi.index', compact('intervensi'));
    }

    public function mapping($id)
    {
        $intervensi = IndikatorKeperawatan::query()
            ->where('JENIS', 5)
            ->where('ID', $id)
            ->first();

        $mapping = MappingIntervensiIndikator::with('jenis_indikator', 'indikator', 'jenis_intervensi')
            ->where('INTERVENSI', $id)
            ->latest('ID')
            ->paginate(10);

        $jenis = JenisIndikatorKeperawatan::where('ID', '!=', 5)->get();
        $indikator = IndikatorKeperawatan::where('JENIS', '!=', 5)->get();

        return view('pages.keperawatan.intervensi.mapping', compact('intervensi', 'mapping', 'jenis', 'indikator'));
    }

    public function mappingStore(Request $request, $intervensi)
    {
        $request->validate([
            'jenis_indikator' => 'required|numeric',
            'indikator' => 'required|numeric',
        ]);

        MappingIntervensiIndikator::create([
            'JENIS' => $request->jenis_indikator,
            'INDIKATOR' => $request->indikator,
            'INTERVENSI' => $intervensi,
        ]);

        return back()->withToastSuccess('Mapping berhasil disimpan');
    }
}
