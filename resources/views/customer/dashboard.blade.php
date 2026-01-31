<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Customer</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-black via-neutral-900 to-black text-white">

{{-- NAVBAR --}}
<nav class="border-b border-neutral-800 px-8 py-4 flex justify-between items-center">
    <div>
        <h1 class="text-xl font-bold">Penyewaan Kamera & Drone</h1>
        <p class="text-xs text-gray-400">Customer Area</p>
    </div>

    <div class="flex items-center gap-4">
        <span class="text-sm text-gray-300">
            {{ auth()->user()->name }}
        </span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                class="px-4 py-2 border border-red-600 text-red-500 rounded-lg hover:bg-red-600 hover:text-white transition text-sm">
                Logout
            </button>
        </form>
    </div>
</nav>

{{-- CONTENT --}}
<div class="px-8 py-10 max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-10">
        <h2 class="text-3xl font-bold mb-2">
            Selamat Datang, {{ auth()->user()->name }}
        </h2>
        <p class="text-gray-400">
            Pilih kamera atau drone terbaik untuk kebutuhan Anda
        </p>
    </div>

    {{-- MENU --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        {{-- SEWA KAMERA --}}
        <div class="bg-neutral-900 border border-neutral-800 rounded-2xl p-8 hover:border-red-600 transition">
            <h3 class="text-xl font-semibold mb-3">Sewa Kamera</h3>
            <p class="text-gray-400 text-sm mb-6">
                Lihat berbagai kamera profesional yang tersedia.
            </p>

            <a href="{{ route('customer.items.kamera') }}"
               class="inline-block px-6 py-3 bg-red-600 rounded-lg font-semibold hover:bg-red-700 transition">
                Lihat Kamera
            </a>
        </div>

        {{-- SEWA DRONE --}}
        <div class="bg-neutral-900 border border-neutral-800 rounded-2xl p-8 hover:border-red-600 transition">
            <h3 class="text-xl font-semibold mb-3">Sewa Drone</h3>
            <p class="text-gray-400 text-sm mb-6">
                Drone terbaik untuk aerial photo & video.
            </p>

            <a href="{{ route('customer.items.drone') }}"
               class="inline-block px-6 py-3 bg-red-600 rounded-lg font-semibold hover:bg-red-700 transition">
                Lihat Drone
            </a>
        </div>

        {{-- RIWAYAT SEWA --}}
        <div class="bg-neutral-900 border border-neutral-800 rounded-2xl p-8 hover:border-red-600 transition">
            <h3 class="text-xl font-semibold mb-3">Riwayat Penyewaan</h3>
            <p class="text-gray-400 text-sm mb-6">
                Pantau status dan riwayat sewa Anda.
            </p>

            <a href="{{ route('customer.rentals.my') }}"
               class="inline-block px-6 py-3 bg-neutral-800 rounded-lg hover:bg-neutral-700 transition">
                Riwayat Sewa
            </a>
        </div>

    </div>

</div>

</body>
</html>
