<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="flex items-baseline space-x-4">
                    <a href="{{ route('home') }}"
                        class="rounded-md px-3 py-2 text-sm font-medium text-white @if(request()->segment(1) == '') bg-gray-900  @endif"
                        aria-current="page">Home</a>

                    <a href="{{ route('pasien.index') }}"
                        class="rounded-md px-3 py-2 text-sm font-medium text-white @if(request()->segment(1) == 'pasien') bg-gray-900  @endif"
                        aria-current="page">Pasien</a>
                    <a href="{{ route('keperawatan.index') }}"
                        class="rounded-md px-3 py-2 text-sm font-medium text-white @if(
                        request()->segment(1) == 'keperawatan' || request()->segment(1) == 'mapping-diagnosa' || request()->segment(1) == 'mapping-intervensi'
                        ) bg-gray-900  @endif"
                        aria-current="page">Keperawatan</a>
                </div>
            </div>
        </div>
    </div>
</nav>
