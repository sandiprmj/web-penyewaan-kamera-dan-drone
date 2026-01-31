<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kamera & Drone</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-black via-neutral-900 to-black text-white">

<div class="max-w-7xl mx-auto px-6 py-10">

    <!-- HERO HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10 gap-4">

        <div>
            <h1 class="text-4xl font-bold mb-2">
                Data Kamera & Drone
            </h1>
            <p class="text-gray-400">
                Kelola kamera dan drone yang tersedia untuk disewakan
            </p>
        </div>

        <div class="flex gap-3">
            <!-- TOMBOL KEMBALI -->
            <a href="{{ route('admin.dashboard') }}"
               class="px-6 py-3 bg-neutral-800 border border-neutral-700 rounded-lg
                      text-gray-300 hover:bg-neutral-700 transition">
                ← Kembali
            </a>

            <!-- TAMBAH BARANG -->
            <a href="{{ route('admin.items.create') }}"
               class="px-6 py-3 bg-red-600 rounded-lg font-semibold hover:bg-red-700 transition">
                + Tambah Barang
            </a>
        </div>

    </div>

    <!-- ALERT -->
    @if(session('success'))
        <div class="mb-6 px-4 py-3 bg-green-500/20 border border-green-500/30 text-green-400 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- TABLE CARD -->
    <div class="bg-neutral-900 border border-neutral-800 rounded-2xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-neutral-800 text-gray-300">
                    <tr>
                        <th class="px-6 py-4 text-left">Foto</th>
                        <th class="px-6 py-4 text-left">Nama</th>
                        <th class="px-6 py-4 text-left">Kategori</th>
                        <th class="px-6 py-4 text-left">Harga / Hari</th>
                        <th class="px-6 py-4 text-left">Stok</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-neutral-800">

                    @forelse($items as $item)
                    <tr class="hover:bg-neutral-800 transition">

                        <!-- FOTO -->
                        <td class="px-6 py-4">
                            @if($item->image)
                                <img
                                    src="{{ asset('storage/'.$item->image) }}"
                                    alt="{{ $item->nama }}"
                                    class="w-20 h-14 object-cover rounded-lg border border-neutral-700"
                                >
                            @else
                                <div class="w-20 h-14 flex items-center justify-center
                                            bg-neutral-800 text-gray-500 text-xs rounded-lg border border-neutral-700">
                                    No Image
                                </div>
                            @endif
                        </td>

                        <!-- NAMA -->
                        <td class="px-6 py-4 font-semibold">
                            {{ $item->nama }}
                        </td>

                        <!-- KATEGORI -->
                        <td class="px-6 py-4 capitalize text-gray-400">
                            {{ $item->kategori }}
                        </td>

                        <!-- HARGA -->
                        <td class="px-6 py-4">
                            Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}
                        </td>

                        <!-- STOK -->
                        <td class="px-6 py-4">
                            @if($item->stok > 0)
                                <span class="px-3 py-1 text-xs rounded-full bg-green-600/20 text-green-400">
                                    {{ $item->stok }} tersedia
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs rounded-full bg-red-600/20 text-red-400">
                                    Habis
                                </span>
                            @endif
                        </td>

                        <!-- AKSI -->
                        <td class="px-6 py-4 text-center space-x-2">
                            <a href="{{ route('admin.items.edit', $item->id) }}"
                               class="inline-block px-4 py-2 bg-yellow-500 text-black rounded-lg hover:bg-yellow-400 transition">
                                Edit
                            </a>

                            <form action="{{ route('admin.items.destroy', $item->id) }}"
                                  method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button
                                    onclick="return confirm('Hapus data ini?')"
                                    class="px-4 py-2 bg-red-600 rounded-lg hover:bg-red-700 transition">
                                    Hapus
                                </button>
                            </form>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-10 text-gray-500">
                            Belum ada data barang
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>
