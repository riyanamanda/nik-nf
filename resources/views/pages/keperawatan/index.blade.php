<x-layouts.app>
    <x-header title="Asuhan Keperawatan" desc="Indikator keperawatan berdasarkan jenis dan kategorinya." />

    <div class="bg-white p-5 rounded shadow border-none">
        <div class="flex items-center justify-start space-x-3 mb-3">
            <x-ui.button url="{{ route('keperawatan.diagnosa.index') }}"
                class="bg-sky-500 text-white hover:bg-sky-600">Mapping diagnosa</x-ui.button>

            <x-ui.button url="{{ route('keperawatan.intervensi.index') }}"
                class="bg-yellow-500 text-white hover:bg-yellow-600">Mapping Intervensi</x-ui.button>
        </div>

        <div class="mb-5 border p-3 rounded">
            <h1 class="text-sm font-medium mb-3">Form pengisian indikator keperawatan</h1>
            <form action="{{ route('keperawatan.store') }}" method="POST" class="flex justify-between items-center">
                @csrf

                <select name="jenis_indikator" tabindex="1"
                    class="block w-full rounded-md max-w-36 mr-3 border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="" selected></option>
                    @foreach ($jenis as $item)
                        <option value="{{ $item->ID }}" @selected(old('jenis_indikator') == $item->ID)>{{ $item->DESKRIPSI }}</option>
                    @endforeach
                </select>

                <input tabindex="2"
                    class="block w-full mr-3 rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    type="text" name="deskripsi" placeholder="deskripsi indikator" value="{{ old('deskripsi') }}">

                <select name="kategori" tabindex="3"
                    class="block w-full rounded-md max-w-36 mr-3 border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="0" selected>None</option>
                    @foreach ($kategori as $item)
                        <option value="{{ $item->value }}" @selected(old('kategori') == $item->value)>{{ str()->title($item->name) }}
                        </option>
                    @endforeach
                </select>

                <x-ui.button type="submit" tabindex="4" class="bg-blue-500 text-white hover:bg-blue-700 ml-auto">
                    Simpan
                </x-ui.button>
            </form>
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
                        <td class="p-3 text-sm text-gray-800 whitespace-nowrap text-wrap">
                            {{ $perawatan->DESKRIPSI }}
                        </td>
                        <td class="p-3 text-sm text-gray-800 whitespace-nowrap text-center">
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
</x-layouts.app>
