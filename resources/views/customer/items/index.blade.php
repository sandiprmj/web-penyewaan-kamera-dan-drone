<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>
        @isset($kategori)
            Daftar {{ ucfirst($kategori) }}
        @else
            Daftar Kamera & Drone
        @endisset
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-black via-neutral-900 to-black text-white">

<div class="max-w-7xl mx-auto px-8 py-12">

    {{-- BACK (DIPINDAHKAN KE ATAS) --}}
    <div class="mb-6">
        <a href="{{ route('customer.dashboard') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-neutral-800 hover:bg-neutral-700 transition text-sm font-medium">
            ← Kembali ke Dashboard
        </a>
    </div>

    {{-- HEADER --}}
    <div class="mb-10">
        <h2 class="text-3xl font-bold mb-2">
            @isset($kategori)
                Daftar {{ ucfirst($kategori) }}
            @else
                Daftar Kamera & Drone
            @endisset
        </h2>
        <p class="text-gray-400">
            Pilih {{ $kategori ?? 'kamera atau drone' }} terbaik untuk kebutuhan Anda
        </p>
    </div>

    {{-- GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        @forelse($items as $item)
        <div class="bg-neutral-900 border border-neutral-800 rounded-2xl overflow-hidden hover:border-red-600 transition shadow-lg">

            {{-- IMAGE --}}
            <div class="relative h-48 bg-black overflow-hidden">

                {{-- BADGE KATEGORI --}}
                <span class="absolute top-3 left-3 z-10 px-3 py-1 text-xs rounded-full
                    {{ $item->kategori === 'kamera'
                        ? 'bg-blue-600/80 text-white'
                        : 'bg-purple-600/80 text-white' }}">
                    {{ ucfirst($item->kategori) }}
                </span>

                @if($item->image)
                    <img
                        src="{{ asset('storage/'.$item->image) }}"
                        alt="{{ $item->nama }}"
                        class="w-full h-full object-cover hover:scale-105 transition duration-300"
                    >
                @else
                    <div class="flex items-center justify-center h-full text-gray-500 text-sm">
                        Tidak ada foto
                    </div>
                @endif
            </div>

            {{-- CONTENT --}}
            <div class="p-6">

                {{-- TITLE --}}
                <h3 class="text-xl font-semibold mb-2">
                    {{ $item->nama }}
                </h3>

                {{-- META --}}
                <div class="space-y-1 text-sm text-gray-400 mb-4">
                    <p>Harga / Hari:
                        <span class="text-white font-semibold">
                            Rp {{ number_format($item->harga_sewa) }}
                        </span>
                    </p>

                    <p>Stok:
                        <span class="{{ $item->stok > 0 ? 'text-green-400' : 'text-red-400' }}">
                            {{ $item->stok }}
                        </span>
                    </p>
                </div>

                {{-- ACTION --}}
                <div class="pt-2">
                    @if($item->stok > 0)
                        <a href="{{ route('customer.rentals.create', $item->id) }}"
                           class="block text-center px-6 py-3 bg-red-600 rounded-lg font-semibold hover:bg-red-700 transition">
                            Sewa Sekarang
                        </a>
                    @else
                        <button
                            disabled
                            class="block w-full text-center px-6 py-3 bg-gray-700 rounded-lg font-semibold cursor-not-allowed">
                            Stok Habis
                        </button>
                    @endif
                </div>

            </div>
        </div>

        @empty
        <div class="col-span-full text-center text-gray-500 py-16">
            Tidak ada barang tersedia
        </div>
        @endforelse

    </div>

</div>

</body>
</html>
