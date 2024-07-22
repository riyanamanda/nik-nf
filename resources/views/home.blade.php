<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>NIK NF</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    @vite('resources/css/app.css')
</head>

<body class="antialiased h-full font-roboto">
    <div class="min-h-full">
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-8 w-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500"
                                alt="Your Company">
                        </div>
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="{{ route('home') }}"
                                class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white"
                                aria-current="page">Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 leading-relaxed">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900 mb-2">Pasien</h1>
                <p class="text-sm">Pasien satu sehat yang tidak memiliki ID.</p>
            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <div class="bg-white p-5 rounded shadow border-none">
                    <div class="flex items-start justify-between">
                        <h2 class="text-xs mb-4">Pasien di-filter berdasarkan <span class="font-medium">id IS NULL</span>
                            &amp;&amp; <span class="font-medium">statusRequest = 0</span> | artinya NIK pasien sudah pernah dikirim tapi tidak dapat balikan ID.
                        </h2>

                        <a href="{{ route('export') }}" target="_blank">
                            <button class="bg-emerald-500 px-3 py-1 text-white shadow-md shadow-emerald-500/20 rounded text-sm hover:bg-emerald-700 transition-colors duration-200">Export</button>
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
                                <th class="w-32 p-3 text-sm font-semibold tracking-wide text-left">ID Satu Sehat</th>
                                <th class="w-24 p-3 text-sm font-semibold tracking-wide text-left">Get Date</th>
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
                                    <td class="p-3 text-sm text-gray-500 whitespace-nowrap text-center">
                                        {{ $patient->id ?? 'null' }}
                                    </td>
                                    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($patient->getDate)->isoFormat('d MMMM Y') }}
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-5">
                        {{ $patients->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>

</html>
