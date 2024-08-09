@props(['title', 'desc'])

<header class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 leading-relaxed">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900 mb-2">{{ $title ?? 'No Title' }}</h1>
        <p class="text-sm">{{ $desc ?? 'No Desc' }}</p>
    </div>
</header>
