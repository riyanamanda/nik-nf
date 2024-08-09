@extends('layouts.app')

@section('header')
    <x-header title="Asuhan Keperawatan" desc="Indikator keperawatan berdasarkan jenis dan kategorinya." />
@endsection

@section('content')
    <div class="bg-white p-5 rounded shadow border-none">

        <table class="w-full">
            <thead class="bg-gray-50 border-b-2 border-gray-200">
                <tr>
                    <th class="w-5 p-3 text-sm font-semibold tracking-wide text-left">#</th>
                    <th class="w-20 p-3 text-sm font-semibold tracking-wide text-left">Kode</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">Deskripsi</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($diagnosa as $item)
                    <tr class="bg-white">
                        <td class="p-3 text-sm text-gray-800 whitespace-nowrap">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="p-3 text-sm text-gray-800 whitespace-nowrap">
                            {{ $item->KODE }}
                        </td>
                        <td class="p-3 text-sm text-gray-800 whitespace-nowrap text-wrap">
                            {{ $item->DESKRIPSI }}
                        </td>
                        <td class="p-3 text-sm text-gray-800 whitespace-nowrap text-wrap">
                            <button class="px-3 py-1 text-white bg-blue-500 rounded font-medium text-xs tracking-wide">Update</button>
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
            {{ $diagnosa->links() }}
        </div>
    </div>
@endsection
