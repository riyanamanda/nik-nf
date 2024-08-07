@extends('layouts.app')

@section('header')
    <x-header title="Pasien" desc="Update NIK pasien sesuai dengan BPJS."/>
@endsection

@section('content')
    <div class="bg-white p-5 rounded shadow border-none w-7/12 mx-auto">
        <form action="{{ route('edit.update', $patient->refId) }}" method="POST">
            @csrf
            @method('PATCH')

            <input type="text" name="nik" value="{{ $bpjs['response']['peserta']['nik'] }}" readonly hidden>
            <input type="date" name="tgl_lahir" value="{{ $bpjs['response']['peserta']['tglLahir'] }}" readonly hidden>
            <input type="number" name="norm_bpjs" value="{{ $bpjs['response']['peserta']['mr']['noMR'] }}" readonly hidden>

            <div class="flex items-center justify-between mb-5 border-b pb-3">
                <p class="tracking-wider leading-relaxed flex flex-col">
                    <span class="text-xs">Rekam Medis</span>
                    <span class="font-semibold text-sm">{{ $patient->refId }}</span>
                </p>

                <div class="flex items-center space-x-3 text-xs">
                    @if (
                        \Carbon\Carbon::parse($patient->identitas->TANGGAL_LAHIR)->format('d-m-y') !=
                            \Carbon\Carbon::parse($bpjs['response']['peserta']['tglLahir'])->format('d-m-y') ||
                            $patient->kartu->NOMOR != $bpjs['response']['peserta']['nik']
                    )
                        <div class="px-3 py-1 rounded shadow shadow-red-500/20 bg-red-500 text-white">UNMATCH</div>
                    @endif
                    <div class="px-3 py-1 rounded shadow shadow-lime-500/20 bg-lime-100 text-lime-700">SIMGOS</div>
                    <div class="px-3 py-1 rounded shadow shadow-sky-500/20 bg-sky-100 text-sky-500">BPJS</div>
                </div>
            </div>

            <div class="flex items-start justify-between">
                <div class="leading-relaxed text-sm">
                    <div>Nama</div>
                    <p class="font-semibold bg-lime-100 px-3 py-0.5">{{ $patient->identitas->NAMA }}</p>
                    <p class="font-semibold bg-sky-100 px-3 py-0.5">{{ $bpjs['response']['peserta']['nama'] }} @if ($bpjs['response']['peserta']['mr']['noMR'])
                        ({{ $bpjs['response']['peserta']['mr']['noMR'] }})
                    @endif</p>
                </div>

                <div class="mb-3 text-sm flex items-center space-x-5">
                    <div class="leading-relaxed font-medium">
                        <div>NIK</div>
                        <p class="bg-lime-100 px-3 py-0.5"
                        @if ($patient->kartu->NOMOR != $bpjs['response']['peserta']['nik'])
                            style="background-color:red;color:white;"
                        @endif
                        >{{ $patient->kartu->NOMOR }}</p>
                        <p class="bg-sky-100 px-3 py-0.5">{{ $bpjs['response']['peserta']['nik'] }}</p>
                    </div>

                    <div class="leading-relaxed">
                        <div>Tanggal Lahir</div>
                        <div class="bg-lime-100 flex space-x-3 px-3 py-0.5"
                        @if (\Carbon\Carbon::parse($patient->identitas->TANGGAL_LAHIR)->format('d-m-y') != \Carbon\Carbon::parse($bpjs['response']['peserta']['tglLahir'])->format('d-m-y'))
                            style="background-color:red;color:white;"
                        @endif
                        >
                            {{ \Carbon\Carbon::parse($patient->identitas->TANGGAL_LAHIR)->isoFormat('DD MMMM YYYY') }}
                        </div>
                        <p class="bg-sky-100 px-3 py-0.5">
                            {{ \Carbon\Carbon::parse($bpjs['response']['peserta']['tglLahir'])->isoFormat('DD MMMM YYYY') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-3 border-t py-3">
                <a href="{{ URL::previous() }}">
                    <button type="button"
                        class="px-3 py-1 rounded bg-gray-300 shadow tracking-wide text-sm">Cancel</button>
                </a>
                <button type="submit"
                    class="px-3 py-1 rounded bg-blue-500 text-white shadow tracking-wide text-sm">Update</button>
            </div>
        </form>
    </div>
@endsection
