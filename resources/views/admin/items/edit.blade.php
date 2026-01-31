<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-black via-neutral-900 to-black text-white">

<div class="max-w-3xl mx-auto px-6 py-12">

    <!-- HEADER -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-2">✏️ Edit Barang</h1>
        <p class="text-gray-400">Perbarui data kamera atau drone</p>
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
            action="{{ route('admin.items.update', $item->id) }}"
            enctype="multipart/form-data"
            class="space-y-6"
        >
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div>
                <label class="block mb-2 text-sm text-gray-400">
                    Nama Barang
                </label>
                <input
                    type="text"
                    name="nama"
                    value="{{ old('nama', $item->nama) }}"
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
                    <option value="kamera"
                        {{ old('kategori', $item->kategori) === 'kamera' ? 'selected' : '' }}>
                        Kamera
                    </option>
                    <option value="drone"
                        {{ old('kategori', $item->kategori) === 'drone' ? 'selected' : '' }}>
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
                    value="{{ old('harga_sewa', $item->harga_sewa) }}"
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
                    value="{{ old('stok', $item->stok) }}"
                    min="0"
                    class="w-full bg-black border border-neutral-700 rounded-lg px-4 py-3
                           focus:outline-none focus:ring-2 focus:ring-red-600"
                    required
                >
            </div>

            <!-- 🖼️ FOTO SAAT INI -->
            <div>
                <label class="block mb-2 text-sm text-gray-400">
                    Foto Saat Ini
                </label>

                @if($item->image)
                    <img
                        src="{{ asset('storage/'.$item->image) }}"
                        alt="{{ $item->nama }}"
                        class="w-48 h-32 object-cover rounded-lg border border-neutral-700 mb-3"
                    >
                @else
                    <p class="text-gray-500 text-sm mb-3">
                        Belum ada foto
                    </p>
                @endif
            </div>

            <!-- 📸 GANTI FOTO -->
            <div>
                <label class="block mb-2 text-sm text-gray-400">
                    Ganti Foto (Opsional)
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
                    Kosongkan jika tidak ingin mengganti foto
                </p>
            </div>

            <!-- ACTION -->
            <div class="flex justify-between items-center pt-6">
                <a
                    href="{{ route('admin.items.index') }}"
                    class="text-gray-400 hover:text-white underline"
                >
                    ← Kembali
                </a>

                <button
                    type="submit"
                    class="px-8 py-3 bg-red-600 rounded-lg font-semibold
                           hover:bg-red-700 transition"
                >
                    Update
                </button>
            </div>

        </form>
    </div>

</div>

</body>
</html>
