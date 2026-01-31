<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * 📋 List semua barang
     */
    public function index()
    {
        $items = Item::latest()->get();
        return view('admin.items.index', compact('items'));
    }

    /**
     * ➕ Form tambah barang
     */
    public function create()
    {
        return view('admin.items.create');
    }

    /**
     * 💾 Simpan barang baru + upload foto
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'        => 'required|string|max:255',
            'kategori'    => 'required|in:kamera,drone',
            'harga_sewa'  => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'nama'       => $request->nama,
            'kategori'   => $request->kategori,
            'harga_sewa' => $request->harga_sewa,
            'stok'       => $request->stok,
        ];

        // 📸 Upload foto (jika ada)
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('items', 'public');
        }

        Item::create($data);

        return redirect()
            ->route('admin.items.index')
            ->with('success', 'Barang berhasil ditambahkan');
    }

    /**
     * ✏️ Form edit barang
     */
    public function edit(Item $item)
    {
        return view('admin.items.edit', compact('item'));
    }

    /**
     * 🔄 Update barang + ganti foto (opsional)
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'nama'        => 'required|string|max:255',
            'kategori'    => 'required|in:kamera,drone',
            'harga_sewa'  => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'nama'       => $request->nama,
            'kategori'   => $request->kategori,
            'harga_sewa' => $request->harga_sewa,
            'stok'       => $request->stok,
        ];

        // 📸 Jika upload foto baru
        if ($request->hasFile('image')) {

            // ❌ hapus foto lama
            if ($item->image && Storage::disk('public')->exists($item->image)) {
                Storage::disk('public')->delete($item->image);
            }

            // ✅ simpan foto baru
            $data['image'] = $request->file('image')
                ->store('items', 'public');
        }

        $item->update($data);

        return redirect()
            ->route('admin.items.index')
            ->with('success', 'Barang berhasil diperbarui');
    }

    /**
     * 🗑️ Hapus barang + foto
     */
    public function destroy(Item $item)
    {
        // ❌ hapus foto dari storage
        if ($item->image && Storage::disk('public')->exists($item->image)) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return back()->with('success', 'Barang berhasil dihapus');
    }
}
