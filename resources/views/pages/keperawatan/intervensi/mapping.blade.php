@extends('layouts.app')

@section('header')
    <x-header title="Mapping Intervensi" desc="Mapping intervensi dengan indikator keperawatan berdasarkan jenis dan kategorinya." />
@endsection

@section('content')
    <div class="bg-white p-5 rounded shadow border-none mx-auto">
        <div class="mb-5 border p-3 rounded w-full">
            <h1 class="text-sm mb-3">Intervensi: <span class="font-medium">{{ $intervensi->DESKRIPSI }}</span></h1>
            <form action="{{ route('keperawatan.intervensi.mapping.store', $intervensi) }}" method="POST">
                @csrf

                <div class="flex items-center mb-3">
                    <select name="jenis_indikator" id="jenis_indikator" tabindex="1"
                        class="block w-full rounded-md mr-3 max-w-36 border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="" selected></option>
                        @foreach ($jenis as $item)
                            <option value="{{ $item->ID }}" @selected(old('jenis_indikator') == $item->ID)>{{ $item->DESKRIPSI }}</option>
                        @endforeach
                    </select>

                    <select name="indikator" id="indikator" tabindex="2"
                        class="block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">

                    </select>
                </div>

                <div class="text-end space-x-1 mb-3">
                    <x-ui.button url="{{ route('keperawatan.intervensi.index') }}"
                        class="bg-stone-500 text-white hover:bg-stone-600">
                        Kembali
                    </x-ui.button>

                    <x-ui.button type="submit" tabindex="3" class="bg-blue-500 text-white hover:bg-blue-700 ml-auto">
                        Simpan
                    </x-ui.button>
                </div>
            </form>
        </div>

        <table class="w-full">
            <thead class="bg-gray-50 border-b-2 border-gray-200">
                <tr>
                    <th class="w-5 p-3 text-sm font-semibold tracking-wide text-left">#</th>
                    <th class="w-20 p-3 text-sm font-semibold tracking-wide text-left">Jenis</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">Indikator</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">Intervensi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($mapping as $item)
                    <tr class="bg-white">
                        <td class="p-3 text-sm text-gray-800 whitespace-nowrap">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="p-3 text-sm text-gray-800 whitespace-nowrap">
                            {{ $item->jenis_indikator->DESKRIPSI }}
                        </td>
                        <td class="p-3 text-sm text-gray-800 whitespace-nowrap text-wrap">
                            {{ $item->indikator->DESKRIPSI }}
                        </td>
                        <td class="p-3 text-sm text-gray-800 whitespace-nowrap text-wrap">
                            {{ $item->jenis_intervensi->DESKRIPSI }}
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
            {{ $mapping->links() }}
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#jenis_indikator').on('change', function() {
                var jenis = $(this).val();
                $.ajax({
                    url: '{{ url('') }}/keperawatan/diagnosa/indikator-keperawatan/' + jenis,
                    type: 'GET',
                    success: function(data) {
                        $('#indikator').empty();
                        $.each(data.data, function(key, indikator) {
                            $('#indikator').append(
                                `<option value="${indikator.ID}">${indikator.DESKRIPSI}</option>`);

                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
@endpush
