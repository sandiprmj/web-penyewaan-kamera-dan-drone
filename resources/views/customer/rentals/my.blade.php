<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Sewa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-black via-neutral-900 to-black text-white">

<div class="max-w-7xl mx-auto px-8 py-12">

    {{-- BACK BUTTON (DIPINDAH KE ATAS & JADI TOMBOL) --}}
    <div class="mb-6">
        <a href="{{ route('customer.dashboard') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-neutral-800 hover:bg-neutral-700 transition text-sm font-medium">
            ← Kembali ke Dashboard
        </a>
    </div>

    {{-- HEADER --}}
    <div class="mb-8">
        <h2 class="text-3xl font-bold mb-2">Riwayat Sewa Saya</h2>
        <p class="text-gray-400">Daftar penyewaan yang pernah Anda lakukan</p>
    </div>

    {{-- TABLE --}}
    <div class="bg-neutral-900 border border-neutral-800 rounded-2xl shadow-xl overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-black text-gray-300">
            <tr>
                <th class="px-6 py-4 text-left">Barang</th>
                <th class="px-6 py-4 text-left">Tanggal Sewa</th>
                <th class="px-6 py-4 text-center">Durasi</th>
                <th class="px-6 py-4 text-left">Tanggal Kembali</th>
                <th class="px-6 py-4 text-left">Total</th>
                <th class="px-6 py-4 text-left">Metode</th>
                <th class="px-6 py-4 text-left">Pembayaran</th>
                <th class="px-6 py-4 text-left">Status Sewa</th>
                <th class="px-6 py-4 text-center">Bukti</th>
            </tr>
            </thead>

            <tbody class="divide-y divide-neutral-800">
            @forelse($rentals as $r)
                <tr class="hover:bg-neutral-800 transition">

                    <td class="px-6 py-4 font-medium">
                        {{ $r->item->nama ?? '-' }}
                    </td>

                    <td class="px-6 py-4 text-gray-400">
                        {{ \Carbon\Carbon::parse($r->tanggal_sewa)->format('d M Y') }}
                    </td>

                    <td class="px-6 py-4 text-center text-gray-400">
                        {{ $r->lama_sewa }} hari
                    </td>

                    <td class="px-6 py-4 text-gray-400">
                        @if($r->tanggal_kembali)
                            {{ \Carbon\Carbon::parse($r->tanggal_kembali)->format('d M Y') }}
                        @else
                            <span class="text-yellow-400">-</span>
                        @endif
                    </td>

                    <td class="px-6 py-4 font-semibold">
                        Rp {{ number_format($r->total_harga, 0, ',', '.') }}
                    </td>

                    <td class="px-6 py-4 uppercase text-gray-300">
                        {{ $r->payment_method ?? '-' }}
                    </td>

                    <td class="px-6 py-4">
                        @if($r->payment_status === 'pending')
                            <span class="px-3 py-1 rounded-full text-xs bg-yellow-500/20 text-yellow-400">
                                Menunggu
                            </span>
                        @elseif($r->payment_status === 'paid')
                            <span class="px-3 py-1 rounded-full text-xs bg-green-500/20 text-green-400">
                                Disetujui
                            </span>
                        @elseif($r->payment_status === 'rejected')
                            <span class="px-3 py-1 rounded-full text-xs bg-red-500/20 text-red-400">
                                Ditolak
                            </span>
                        @endif
                    </td>

                    <td class="px-6 py-4">
                        @if($r->status_sewa === 'belum_diambil')
                            <span class="px-3 py-1 rounded-full text-xs bg-gray-500/20 text-gray-300">
                                Belum Diambil
                            </span>
                        @elseif($r->status_sewa === 'aktif')
                            <span class="px-3 py-1 rounded-full text-xs bg-blue-500/20 text-blue-400">
                                Disewa
                            </span>
                        @elseif($r->status_sewa === 'selesai')
                            <span class="px-3 py-1 rounded-full text-xs bg-green-500/20 text-green-400">
                                Selesai
                            </span>
                        @elseif($r->status_sewa === 'dibatalkan')
                            <span class="px-3 py-1 rounded-full text-xs bg-red-500/20 text-red-400">
                                Dibatalkan
                            </span>
                        @endif
                    </td>

                    <td class="px-6 py-4 text-center">
                        @if(in_array($r->status_sewa, ['aktif', 'selesai']))
                            <a href="{{ route('customer.rentals.receipt', $r->id) }}"
                               class="inline-block px-4 py-2 text-xs rounded-lg bg-indigo-600 hover:bg-indigo-700 transition">
                                Lihat Bukti
                            </a>
                        @else
                            <span class="text-gray-500 text-xs italic">
                                Belum tersedia
                            </span>
                        @endif
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center py-10 text-gray-500">
                        Belum ada riwayat penyewaan
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
