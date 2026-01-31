<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Rental;

class DashboardController extends Controller
{
    public function index()
    {
        // 📷 Total kamera
        $totalKamera = Item::where('kategori', 'kamera')->count();

        // 🚁 Total drone
        $totalDrone = Item::where('kategori', 'drone')->count();

        // 🔄 Transaksi aktif (barang sedang disewa)
        $transaksiAktif = Rental::where('status_sewa', 'aktif')->count();

        return view('admin.dashboard', compact(
            'totalKamera',
            'totalDrone',
            'transaksiAktif'
        ));
    }
}
