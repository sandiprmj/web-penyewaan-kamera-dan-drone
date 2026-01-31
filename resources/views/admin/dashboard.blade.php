<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-black via-neutral-900 to-black text-white">

{{-- NAVBAR --}}
<nav class="border-b border-neutral-800 px-8 py-4 flex justify-between items-center">
    <div>
        <h1 class="text-xl font-bold">Admin Panel</h1>
        <p class="text-xs text-gray-400">Penyewaan Kamera & Drone</p>
    </div>

    <div class="flex items-center gap-6 text-sm">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-red-500">Dashboard</a>
        <a href="{{ route('admin.items.index') }}" class="hover:text-red-500">Barang</a>
        <a href="{{ route('admin.rentals.index') }}" class="hover:text-red-500">Penyewaan</a>
    </div>

    <div class="flex items-center gap-4">
        <span class="text-sm text-gray-300">
            {{ auth()->user()->name }}
        </span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="px-4 py-2 border border-red-600 text-red-500 rounded-lg hover:bg-red-600 hover:text-white transition text-sm">
                Logout
            </button>
        </form>
    </div>
</nav>

{{-- CONTENT --}}
<div class="px-8 py-10 max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-10">
        <h2 class="text-3xl font-bold mb-1">Dashboard Admin</h2>
        <p class="text-gray-400">Ringkasan sistem penyewaan</p>
    </div>

    {{-- STAT --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">

        <div class="bg-neutral-900 border border-neutral-800 rounded-xl p-6">
            <p class="text-sm text-gray-400 mb-1">Total Kamera</p>
            <p class="text-3xl font-bold">{{ $totalKamera }}</p>
        </div>

        <div class="bg-neutral-900 border border-neutral-800 rounded-xl p-6">
            <p class="text-sm text-gray-400 mb-1">Total Drone</p>
            <p class="text-3xl font-bold">{{ $totalDrone }}</p>
        </div>

        <div class="bg-neutral-900 border border-neutral-800 rounded-xl p-6">
            <p class="text-sm text-gray-400 mb-1">Transaksi Aktif</p>
            <p class="text-3xl font-bold">{{ $transaksiAktif }}</p>
        </div>

    </div>

    {{-- MENU --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        {{-- BARANG --}}
        <div class="bg-neutral-900 border border-neutral-800 rounded-2xl p-8 hover:border-red-600 transition">
            <h3 class="text-xl font-semibold mb-3">Kelola Barang</h3>
            <p class="text-gray-400 text-sm mb-6">
                Tambah, edit, dan hapus kamera serta drone.
            </p>

            <a href="{{ route('admin.items.index') }}"
               class="inline-block px-6 py-3 bg-red-600 rounded-lg font-semibold hover:bg-red-700 transition">
                Kelola Barang
            </a>
        </div>

        {{-- PENYEWAAN --}}
        <div class="bg-neutral-900 border border-neutral-800 rounded-2xl p-8 hover:border-red-600 transition">
            <h3 class="text-xl font-semibold mb-3">Data Penyewaan</h3>
            <p class="text-gray-400 text-sm mb-6">
                Lihat dan konfirmasi transaksi penyewaan.
            </p>

            <a href="{{ route('admin.rentals.index') }}"
               class="inline-block px-6 py-3 bg-neutral-800 rounded-lg hover:bg-neutral-700 transition">
                Lihat Penyewaan
            </a>
        </div>

    </div>

</div>
</body>
</html>
