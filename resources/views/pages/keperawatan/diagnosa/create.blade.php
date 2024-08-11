@extends('layouts.app')

@section('header')
    <x-header title="Diagnosa Keperawatan" desc="Standar diagnosa keperawatan Indonesia (SDKI)" />
@endsection

@section('content')
    <div class="bg-white p-5 rounded shadow border-none mx-auto w-8/12">
        <form action="{{ route('keperawatan.diagnosa.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Diagnosa Keperawatan</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Standar diagnosa dalam asuhan keperawatan.</p>
            </div>

            <div class="flex items-center space-x-3 mb-3">
                <input type="text" name="kode"
                    class="block w-24 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-3"
                    placeholder="Kode" value="{{ old('kode') }}" />

                <input type="text" name="deskripsi"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-3"
                    placeholder="Deskripsi" value="{{ old('deskripsi') }}" />
            </div>

            <div class="text-end">
                <x-ui.button type="button" url="{{ route('keperawatan.diagnosa.index') }}" class="text-white bg-gray-500 hover:bg-gray-600">
                    Cancel
                </x-ui.button>

                <x-ui.button type="submit" class="text-white bg-blue-500 hover:bg-blue-600">
                    Create
                </x-ui.button>
            </div>
        </form>
    </div>
@endsection
