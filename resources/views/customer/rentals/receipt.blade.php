<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Peminjaman</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-black text-white flex items-center justify-center">

<div class="max-w-xl w-full bg-neutral-900 border border-neutral-800 rounded-2xl p-8 shadow-xl">

    <h2 class="text-2xl font-bold mb-6 text-center">
         Bukti Peminjaman
    </h2>

    <div class="space-y-4 text-sm">
        <div class="flex justify-between">
            <span class="text-gray-400">Nama Customer</span>
            <span>{{ $rental->user->name }}</span>
        </div>

        <div class="flex justify-between">
            <span class="text-gray-400">Barang</span>
            <span>{{ $rental->item->nama }}</span>
        </div>

        <div class="flex justify-between">
            <span class="text-gray-400">Tanggal Sewa</span>
            <span>{{ \Carbon\Carbon::parse($rental->tanggal_sewa)->format('d-m-Y') }}</span>
        </div>

        <div class="flex justify-between">
            <span class="text-gray-400">Durasi</span>
            <span>{{ $rental->lama_sewa }} hari</span>
        </div>

        <div class="flex justify-between">
            <span class="text-gray-400">Total Harga</span>
            <span class="font-semibold">
                Rp {{ number_format($rental->total_harga, 0, ',', '.') }}
            </span>
        </div>

        <div class="flex justify-between">
            <span class="text-gray-400">Status Sewa</span>
            <span class="text-green-400 font-medium uppercase">
                {{ $rental->status_sewa }}
            </span>
        </div>
    </div>

    <div class="mt-8 text-center text-xs text-gray-500">
        Bukti ini sah dan dibuat secara otomatis oleh sistem.
    </div>

    <div class="mt-6 flex justify-center gap-4">
        <button onclick="window.print()"
            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg text-sm">
            🖨️ Cetak
        </button>

        <a href="{{ route('customer.rentals.my') }}"
           class="px-4 py-2 bg-neutral-700 hover:bg-neutral-600 rounded-lg text-sm">
            Kembali
        </a>
    </div>

</div>

</body>
</html>
