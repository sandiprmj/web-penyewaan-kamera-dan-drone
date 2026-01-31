<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Penyewaan Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-black via-neutral-900 to-black text-white">

<div class="max-w-7xl mx-auto px-8 py-12">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold mb-1">Data Penyewaan</h1>
            <p class="text-gray-400">Kelola seluruh transaksi penyewaan</p>
        </div>

        <a href="{{ route('admin.dashboard') }}"
           class="px-5 py-2 bg-neutral-800 rounded-lg hover:bg-neutral-700 transition text-sm">
            ← Kembali ke Dashboard
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="mb-4 px-5 py-3 bg-green-500/20 text-green-400 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 px-5 py-3 bg-red-500/20 text-red-400 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="bg-neutral-900 border border-neutral-800 rounded-2xl shadow-xl overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-black text-gray-300">
            <tr>
                <th class="px-6 py-4 text-left">Customer</th>
                <th class="px-6 py-4 text-left">Barang</th>
                <th class="px-6 py-4 text-left">Tgl Sewa</th>
                <th class="px-6 py-4 text-center">Durasi</th>
                <th class="px-6 py-4 text-left">Tgl Kembali</th>
                <th class="px-6 py-4 text-left">Total</th>
                <th class="px-6 py-4 text-left">Metode</th>
                <th class="px-6 py-4 text-left">Bukti</th>
                <th class="px-6 py-4 text-left">Pembayaran</th>
                <th class="px-6 py-4 text-left">Status Sewa</th>
                <th class="px-6 py-4 text-left">Aksi</th>
            </tr>
            </thead>

            <tbody class="divide-y divide-neutral-800">
            @forelse($rentals as $r)
                <tr class="hover:bg-neutral-800 transition">

                    <td class="px-6 py-4">{{ $r->user->name ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $r->item->nama ?? '-' }}</td>

                    <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($r->tanggal_sewa)->format('d M Y') }}
                    </td>

                    <td class="px-6 py-4 text-center">
                        {{ $r->lama_sewa }} hari
                    </td>

                    <td class="px-6 py-4">
                        @if($r->tanggal_kembali)
                            {{ \Carbon\Carbon::parse($r->tanggal_kembali)->format('d M Y') }}
                        @else
                            <span class="text-yellow-400">-</span>
                        @endif
                    </td>

                    <td class="px-6 py-4 font-semibold">
                        Rp {{ number_format($r->total_harga, 0, ',', '.') }}
                    </td>

                    <td class="px-6 py-4 uppercase text-gray-400">
                        {{ $r->payment_method ?? '-' }}
                    </td>

                    <td class="px-6 py-4">
                        @if($r->payment_proof)
                            <a href="{{ asset('storage/payment_proofs/'.$r->payment_proof) }}"
                               target="_blank"
                               class="text-blue-400 underline">
                                Lihat
                            </a>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </td>

                    {{-- STATUS PEMBAYARAN --}}
                    <td class="px-6 py-4">
                        @if($r->payment_status === 'paid')
                            <span class="px-3 py-1 text-xs rounded-full bg-green-500/20 text-green-400">
                                Disetujui
                            </span>
                        @elseif($r->payment_status === 'pending')
                            <span class="px-3 py-1 text-xs rounded-full bg-yellow-500/20 text-yellow-400">
                                Menunggu
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs rounded-full bg-red-500/20 text-red-400">
                                Ditolak
                            </span>
                        @endif
                    </td>

                    {{-- STATUS SEWA --}}
                    <td class="px-6 py-4">
                        @if($r->status_sewa === 'belum_diambil')
                            <span class="px-3 py-1 text-xs rounded-full bg-gray-500/20 text-gray-300">
                                Belum Diambil
                            </span>
                        @elseif($r->status_sewa === 'aktif')
                            <span class="px-3 py-1 text-xs rounded-full bg-blue-500/20 text-blue-400">
                                Disewa
                            </span>
                        @elseif($r->status_sewa === 'selesai')
                            <span class="px-3 py-1 text-xs rounded-full bg-green-500/20 text-green-400">
                                Selesai
                            </span>
                        @endif
                    </td>

                    {{-- AKSI --}}
                    <td class="px-6 py-4">
                        <div class="flex flex-col gap-2">

                            {{-- KONFIRMASI --}}
                            @if($r->payment_status === 'pending')
                                <form method="POST" action="{{ route('admin.rentals.confirm', $r->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="w-full bg-green-600 hover:bg-green-700 px-3 py-1 rounded">
                                        Konfirmasi
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('admin.rentals.reject', $r->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="w-full bg-red-600 hover:bg-red-700 px-3 py-1 rounded">
                                        Tolak
                                    </button>
                                </form>
                            @endif

                            {{-- DIAMBIL --}}
                            @if($r->payment_status === 'paid' && $r->status_sewa === 'belum_diambil')
                                <form method="POST" action="{{ route('admin.rentals.take', $r->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="w-full bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded">
                                        Diambil
                                    </button>
                                </form>
                            @endif

                            {{-- DIKEMBALIKAN --}}
                            @if($r->status_sewa === 'aktif')
                                <form method="POST" action="{{ route('admin.rentals.returned', $r->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="w-full bg-purple-600 hover:bg-purple-700 px-3 py-1 rounded">
                                        Dikembalikan
                                    </button>
                                </form>
                            @endif

                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center py-10 text-gray-500">
                        Belum ada data penyewaan
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
