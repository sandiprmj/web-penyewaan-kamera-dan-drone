<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RentalController extends Controller
{
    /**
     * 📋 TAMPILKAN SEMUA DATA SEWA
     */
    public function index()
    {
        $rentals = Rental::with(['user', 'item'])
            ->latest()
            ->get();

        return view('admin.rentals.index', compact('rentals'));
    }

    /**
     * ✅ KONFIRMASI PEMBAYARAN
     * status:
     * payment_status -> paid
     * status_sewa    -> belum_diambil
     */
    public function confirm(Rental $rental)
    {
        // 🔒 Validasi bukti pembayaran (transfer / qris)
        if (
            in_array($rental->payment_method, ['transfer', 'qris']) &&
            !$rental->payment_proof
        ) {
            return back()->with('error', 'Bukti pembayaran belum diupload');
        }

        // ❗ Cegah konfirmasi ulang
        if ($rental->payment_status === 'paid') {
            return back()->with('error', 'Pembayaran sudah dikonfirmasi');
        }

        $rental->update([
            'payment_status' => 'paid',
            'status_sewa'    => 'belum_diambil',
        ]);

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi');
    }

    /**
     * 📦 BARANG DIAMBIL CUSTOMER
     * route: admin.rentals.take
     * status_sewa -> aktif
     */
    public function take(Rental $rental)
    {
        // ❗ Hanya boleh jika sudah dibayar & belum diambil
        if (
            $rental->payment_status !== 'paid' ||
            $rental->status_sewa !== 'belum_diambil'
        ) {
            return back()->with('error', 'Barang belum bisa diambil');
        }

        $rental->update([
            'status_sewa' => 'aktif',
        ]);

        return back()->with('success', 'Barang berhasil diambil customer');
    }

    /**
     * ❌ TOLAK PEMBAYARAN
     */
    public function reject(Rental $rental)
    {
        // ❗ Tidak bisa ditolak jika sudah aktif / selesai
        if (in_array($rental->status_sewa, ['aktif', 'selesai'])) {
            return back()->with('error', 'Sewa sudah berjalan');
        }

        $rental->update([
            'payment_status' => 'rejected',
            'status_sewa'    => 'dibatalkan',
        ]);

        return back()->with('success', 'Pembayaran berhasil ditolak');
    }

    /**
     * 🔄 BARANG DIKEMBALIKAN
     */
    public function returned(Rental $rental)
    {
        // ❗ Hanya sewa aktif
        if ($rental->status_sewa !== 'aktif') {
            return back()->with('error', 'Barang belum disewa atau sudah selesai');
        }

        $rental->update([
            'status_sewa'     => 'selesai',
            'tanggal_kembali' => Carbon::now()->toDateString(),
        ]);

        // ➕ Stok barang kembali
        if ($rental->item) {
            $rental->item->increment('stok');
        }

        return back()->with('success', 'Barang berhasil dikembalikan');
    }
}
