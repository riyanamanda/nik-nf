<x-layouts.app>
    <x-header title="Diagnosa Keperawatan" desc="Standar diagnosa keperawatan Indonesia (SDKI)" />

    <div class="bg-white p-5 rounded shadow border-none">
        <div class="text-end space-x-1 mb-3">
            <x-ui.button url="{{ route('keperawatan.index') }}" class="bg-stone-500 text-white hover:bg-stone-600">
                Kembali
            </x-ui.button>

            <x-ui.button url="{{ route('keperawatan.diagnosa.create') }}"
                class="bg-blue-500 text-white hover:bg-blue-600">
                Tambah
            </x-ui.button>
        </div>

        <table class="w-full">
            <thead class="bg-gray-50 border-b-2 border-gray-200">
                <tr>
                    <th class="w-5 p-3 text-sm font-semibold tracking-wide text-left">#</th>
                    <th class="w-20 p-3 text-sm font-semibold tracking-wide text-left">Kode</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-left">Deskripsi</th>
                    <th class="p-3 text-sm font-semibold tracking-wide text-end"></th>
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
                        <td class="p-3 text-sm text-gray-800 whitespace-nowrap text-wrap text-end space-x-1">
                            <a href="#">
                                <x-ui.button url="{{ route('keperawatan.diagnosa.mapping', $item) }}"
                                    class="text-white bg-green-500 hover:bg-green-600">
                                    Mapping
                                </x-ui.button>
                            </a>
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
</x-layouts.app>
