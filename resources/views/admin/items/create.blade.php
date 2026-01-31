<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-black via-neutral-900 to-black text-white">

<div class="max-w-3xl mx-auto px-6 py-12">

    <!-- HEADER -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-2">Tambah Barang</h1>
        <p class="text-gray-400">Tambahkan kamera atau drone baru</p>
    </div>

    <!-- ERROR VALIDATION -->
    @if ($errors->any())
        <div class="mb-6 bg-red-500/20 border border-red-500/40 text-red-400 px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FORM CARD -->
    <div class="bg-neutral-900 border border-neutral-800 rounded-2xl shadow-xl p-8">

        {{-- ⚠️ enctype WAJIB untuk upload file --}}
        <form
            method="POST"
            action="{{ route('admin.items.store') }}"
            enctype="multipart/form-data"
            class="space-y-6"
        >
            @csrf

            <!-- Nama -->
            <div>
                <label class="block mb-2 text-sm text-gray-400">
                    Nama Barang
                </label>
                <input
                    type="text"
                    name="nama"
                    value="{{ old('nama') }}"
                    {{-- placeholder="Contoh: Canon EOS R5" --}}
                    class="w-full bg-black border border-neutral-700 rounded-lg px-4 py-3
                           focus:outline-none focus:ring-2 focus:ring-red-600"
                    required
                >
            </div>

            <!-- Kategori -->
            <div>
                <label class="block mb-2 text-sm text-gray-400">
                    Kategori
                </label>
                <select
                    name="kategori"
                    class="w-full bg-black border border-neutral-700 rounded-lg px-4 py-3
                           focus:outline-none focus:ring-2 focus:ring-red-600"
                    required
                >
                    <option value="">-- Pilih Kategori --</option>
                    <option value="kamera" {{ old('kategori') === 'kamera' ? 'selected' : '' }}>
                        Kamera
                    </option>
                    <option value="drone" {{ old('kategori') === 'drone' ? 'selected' : '' }}>
                        Drone
                    </option>
                </select>
            </div>

            <!-- Harga -->
            <div>
                <label class="block mb-2 text-sm text-gray-400">
                    Harga Sewa / Hari
                </label>
                <input
                    type="number"
                    name="harga_sewa"
                    value="{{ old('harga_sewa') }}"
                    {{-- placeholder="Contoh: 250000" --}}
                    min="0"
                    class="w-full bg-black border border-neutral-700 rounded-lg px-4 py-3
                           focus:outline-none focus:ring-2 focus:ring-red-600"
                    required
                >
            </div>

            <!-- Stok -->
            <div>
                <label class="block mb-2 text-sm text-gray-400">
                    Stok
                </label>
                <input
                    type="number"
                    name="stok"
                    value="{{ old('stok') }}"
                    {{-- placeholder="Contoh: 5" --}}
                    min="0"
                    class="w-full bg-black border border-neutral-700 rounded-lg px-4 py-3
                           focus:outline-none focus:ring-2 focus:ring-red-600"
                    required
                >
            </div>

            <!-- 📸 Foto Barang -->
            <div>
                <label class="block mb-2 text-sm text-gray-400">
                    Foto Barang
                </label>
                <input
                    type="file"
                    name="image"
                    accept="image/*"
                    class="w-full bg-black border border-neutral-700 rounded-lg px-4 py-3
                           file:bg-neutral-800 file:text-white file:border-0
                           file:rounded-lg file:px-4 file:py-2"
                >
                <p class="text-xs text-gray-500 mt-1">
                    Format JPG / PNG • Maks 2MB
                </p>
            </div>

            <!-- ACTION -->
            <div class="flex justify-between items-center pt-6">
                <a
                    href="{{ route('admin.items.index') }}"
                    class="px-6 py-3 bg-neutral-800 border border-neutral-700 rounded-lg
                      text-gray-300 hover:bg-neutral-700 transition">
                    ← Kembali
                </a>

                <button
                    type="submit"
                    class="px-8 py-3 bg-red-600 rounded-lg font-semibold
                           hover:bg-red-700 transition">
                    Simpan
                </button>
            </div>

        </form>
    </div>

</div>

</body>
</html>
