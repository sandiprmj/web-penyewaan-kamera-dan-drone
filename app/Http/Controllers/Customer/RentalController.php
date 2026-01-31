<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RentalController extends Controller
{
    /**
     * 📦 SEMUA BARANG
     */
    public function index()
    {
        $items = Item::where('stok', '>', 0)
            ->latest()
            ->get();

        return view('customer.items.index', compact('items'));
    }

    /**
     * 📷 KHUSUS KAMERA
     */
    public function kamera()
    {
        $items = Item::where('kategori', 'kamera')
            ->where('stok', '>', 0)
            ->latest()
            ->get();

        $kategori = 'kamera';

        return view('customer.items.index', compact('items', 'kategori'));
    }

    /**
     * 🚁 KHUSUS DRONE
     */
    public function drone()
    {
        $items = Item::where('kategori', 'drone')
            ->where('stok', '>', 0)
            ->latest()
            ->get();

        $kategori = 'drone';

        return view('customer.items.index', compact('items', 'kategori'));
    }

    /**
     * 📝 FORM SEWA
     */
    public function create(Item $item)
    {
        if ($item->stok < 1) {
            return back()->with('error', 'Stok barang habis');
        }

        return view('customer.rentals.create', compact('item'));
    }

    /**
     * 💾 SIMPAN DATA SEWA
     */
    public function store(Request $request, Item $item)
    {
        $request->validate([
            'tanggal_sewa'   => 'required|date',
            'lama_sewa'      => 'required|integer|min:1',
            'payment_method' => 'required|in:transfer,cash',
            'payment_proof'  => 'required_if:payment_method,transfer|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $tanggalSewa = Carbon::parse($request->tanggal_sewa);
            $lamaSewa    = (int) $request->lama_sewa;

            $totalHarga = $item->harga_sewa * $lamaSewa;

            $rental = new Rental();
            $rental->user_id      = Auth::id();
            $rental->item_id      = $item->id;
            $rental->tanggal_sewa = $tanggalSewa;
            $rental->lama_sewa    = $lamaSewa;
            $rental->total_harga  = $totalHarga;

            // 💳 PEMBAYARAN
            $rental->payment_method = $request->payment_method;
            $rental->payment_status = 'pending';

            // 🔑 STATUS SEWA
            // setelah sewa → belum diambil
            $rental->status_sewa = 'belum_diambil';

            // 📤 UPLOAD BUKTI TRANSFER
            if ($request->hasFile('payment_proof')) {
                $path = $request->file('payment_proof')
                    ->store('payment_proofs', 'public');

                $rental->payment_proof = basename($path);
            }

            $rental->save();

            // 📦 KURANGI STOK
            $item->decrement('stok');

            DB::commit();

            return redirect()
                ->route('customer.rentals.my')
                ->with('success', 'Penyewaan berhasil dibuat. Menunggu konfirmasi admin.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    /**
     * 📜 RIWAYAT SEWA CUSTOMER
     */
    public function myRentals()
    {
        $rentals = Rental::with('item')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('customer.rentals.my', compact('rentals'));
    }

    /**
     * 🧾 BUKTI PEMINJAMAN
     */
    public function receipt(Rental $rental)
    {
        // 🔒 SECURITY: hanya pemilik rental
        if ($rental->user_id !== Auth::id()) {
            abort(403);
        }

        return view('customer.rentals.receipt', compact('rental'));
    }
}
