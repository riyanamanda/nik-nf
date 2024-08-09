@extends('layouts.app')

@section('header')
    <x-header title="Pasien" desc="Pasien satu sehat yang tidak memiliki ID satu sehat."/>
@endsection

@section('content')
    <div class="bg-white p-5 rounded shadow border-none">
        <div class="flex items-start justify-between">
            <h2 class="text-xs mb-4">Pasien di-filter berdasarkan <span class="font-medium">id IS
                    NULL</span>
                &amp;&amp; <span class="font-medium">statusRequest = 0</span> | artinya NIK pasien sudah
                pernah dikirim tapi tidak dapat balikan ID.
            </h2>

            <a href="{{ route('export') }}" target="_blank">
                <button
                    class="bg-emerald-500 px-3 py-1 text-white shadow-md shadow-emerald-500/20 rounded text-sm hover:bg-emerald-700 transition-colors duration-200">Export</button>
            </a>
        </div>

        <table class="w-full">
            <thead class="bg-gray-50 border-b-2 border-gray-200">
                <tr>
                    <th class="w-5 p-3 text-sm font-semibold tracking-wide text-left">#</th>
                    <th class="w-20 p-3 text-sm font-semibold tracking-wide text-left">NO. RM</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">Nama</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Tanggal Lahir</th>
                    <th class="w-24 p-3 text-sm font-semibold tracking-wide text-left">NIK</th>
                    <th class="w-24 p-3 text-sm font-semibold tracking-wide text-left">BPJS</th>
                    <th class="w-32 p-3 text-sm font-semibold tracking-wide text-left">ID Satu Sehat</th>
                    <th class="w-24 p-3 text-sm font-semibold tracking-wide text-left">Get Date</th>
                    <th class="w-24 p-3 text-sm font-semibold tracking-wide text-left">Action</th>

                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($patients as $patient)
                    <tr class="bg-white">
                        <td class="p-3 text-sm text-gray-800 whitespace-nowrap">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="p-3 text-sm text-gray-800 whitespace-nowrap">
                            {{ $patient->refId }}
                        </td>
                        <td class="p-3 text-sm text-gray-700">
                            {{ $patient->identitas == null ? 'null' : $patient->identitas->NAMA }}
                        </td>
                        <td class="p-3 text-sm text-gray-700 text-center">
                            {{ $patient->identitas == null ? 'null' : \Carbon\Carbon::parse($patient->identitas->TANGGAL_LAHIR)->isoFormat('DD-MM-YYYY') }}
                        </td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                            <span
                                class="p-1.5 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50">
                                {{ $patient->nik }}
                            </span>
                        </td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                            <span
                                class="p-1.5 text-xs font-medium uppercase tracking-wider text-rose-800 bg-rose-200 rounded-lg bg-opacity-50">
                                {{ $patient->asuransi == null ? 'null' : $patient->asuransi->NOMOR }}
                            </span>
                        </td>
                        <td class="p-3 text-sm text-gray-500 whitespace-nowrap text-center">
                            {{ $patient->id ?? 'null' }}
                        </td>
                        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($patient->getDate)->isoFormat('d MMMM Y') }}
                        </td>
                        <td>
                            @if ($patient->asuransi != null)
                                <a href="{{ route('edit.nik', [$patient->refId, $patient->asuransi->NOMOR]) }}">
                                    <button
                                        class="bg-rose-500 px-3 py-1 text-white shadow-md shadow-rose-500/20 rounded text-xs hover:bg-rose-700 transition-colors duration-200">Update
                                        NIK</button>
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center font-medium text-sm pt-5">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-5">
            {{ $patients->links() }}
        </div>
    </div>
@endsection
