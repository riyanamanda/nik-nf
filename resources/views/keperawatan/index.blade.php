@extends('layouts.app')

@section('header')
    <x-header title="Asuhan Keperawatan" desc="Indikator keperawatan berdasarkan jenis dan kategorinya." />
@endsection

@section('content')
    <div class="bg-white p-5 rounded shadow border-none">
        <div class="">
            <h1 class="text-sm font-medium">Form pengisian indikator keperawatan</h1>
            <form action="#" method="POST">
                <input class="block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" type="text" name="deskripsi" placeholder="deskripsi indikator">
            </form>

            {{-- <a href="{{ route('export') }}">
                <button
                    class="bg-emerald-500 px-3 py-1 text-white shadow-md shadow-emerald-500/20 rounded text-sm hover:bg-emerald-700 transition-colors duration-200">Export</button>
            </a> --}}
        </div>

        <table class="w-full">
            <thead class="bg-gray-50 border-b-2 border-gray-200">
                <tr>
                    <th class="w-5 p-3 text-sm font-semibold tracking-wide text-left">#</th>
                    <th class="w-20 p-3 text-sm font-semibold tracking-wide text-left">Jenis</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">Deskripsi</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-center">Kategori</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($keperawatan as $perawatan)
                    <tr class="bg-white">
                        <td class="p-3 text-sm text-gray-800 whitespace-nowrap">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="p-3 text-sm text-gray-800 whitespace-nowrap">
                            {{ $perawatan->jenis_indikator->DESKRIPSI }}
                        </td>
                        <td class="p-3 text-sm text-gray-800 whitespace-nowrap">
                            {{ $perawatan->DESKRIPSI }}
                        </td>
                        <td class="p-3 text-sm text-gray-800 whitespace-nowrap">
                            @if ($perawatan->KATEGORI === 1)
                                <span>Mayor</span>
                            @elseif($perawatan->KATEGORI === 2)
                                <span>Minor</span>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center font-medium text-sm pt-5">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-5">
            {{ $keperawatan->links() }}
        </div>
    </div>
@endsection
