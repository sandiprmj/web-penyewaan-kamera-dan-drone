<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalAdminController extends Controller
{
    /**
     * List semua data penyewaan
     */
    public function index()
    {
        $rentals = Rental::with(['user', 'item'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.rentals.index', compact('rentals'));
    }

    /**
     * Konfirmasi pembayaran (Cash / Transfer)
     */
    public function confirm($id)
    {
        $rental = Rental::findOrFail($id);

        // Cegah double konfirmasi
        if ($rental->payment_status === 'paid') {
            return back()->with('info', 'Pembayaran sudah dikonfirmasi sebelumnya');
        }

        $rental->update([
            'payment_status' => 'paid',
            'status_sewa'    => 'aktif',
        ]);

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi');
    }

    /**
     * Tolak pembayaran
     */
    public function reject($id)
    {
        $rental = Rental::findOrFail($id);

        // Tidak boleh ditolak jika sudah lunas
        if ($rental->payment_status === 'paid') {
            return back()->with('error', 'Pembayaran sudah lunas, tidak bisa ditolak');
        }

        $rental->update([
            'payment_status' => 'rejected',
            'status_sewa'    => 'dibatalkan',
        ]);

        return back()->with('error', 'Pembayaran ditolak');
    }

    /**
     * Tandai barang sudah dikembalikan
     */
    public function returned($id)
    {
        $rental = Rental::findOrFail($id);

        $rental->update([
            'status_sewa' => 'selesai',
        ]);

        return back()->with('success', 'Barang telah dikembalikan');
    }
}
