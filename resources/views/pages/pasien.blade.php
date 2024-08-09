@extends('layouts.app')

@section('header')
    <x-header title="No Rekam Medis" desc="Update norm pasien yang salah." />
@endsection

@section('content')
    <div class="bg-white rounded border-none mx-auto w-6/12 p-5">
        <form action="{{ route('pasien.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Pasien</h2>
                    <p class="text-xs leading-6 text-red-500 font-medium"><span class="font-bold">NORM</span> pasien dapat diganti jika
                        belom didaftarkan ke
                        poli. Jika pasien sudah pernah terdaftar di poli maka ubah <span class="font-bold">NORM</span>
                        melalui form ini, setalh itu ubah secara manual pada DB
                        <span class="font-bold">pendaftaran.pendaftaran</span>
                    </p>

                    <div class="mt-3 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="norm" class="block text-sm font-medium leading-6 text-gray-900">
                                NORM Lama
                            </label>
                            <div class="mt-2">
                                <input type="text" name="norm" id="norm"
                                    class="block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="norm_baru" class="block text-sm font-medium leading-6 text-gray-900">
                                NORM Baru
                            </label>
                            <div class="mt-2">
                                <input type="text" name="norm_baru" id="norm_baru"
                                    class="block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-x-6">
                <button type="submit"
                    class="px-3 py-1 text-sm text-white bg-blue-500 hover:bg-blue-700 rounded shadow-xl shadow-blue-500/20 tracking-wide transition-colors duration-75 mt-5">Update</button>
            </div>
        </form>
    </div>
@endsection
