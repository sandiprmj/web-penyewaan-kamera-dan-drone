<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sewa {{ $item->nama }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-black text-white">

<div class="max-w-xl mx-auto px-6 py-16">

    <!-- TOMBOL KEMBALI -->
    <button onclick="history.back()"
            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-neutral-800 hover:bg-neutral-700 transition text-sm font-medium">
        ← Kembali
    </button>

    <h1 class="text-2xl font-bold mb-6 text-center">
        Sewa {{ $item->nama }}
    </h1>

    {{-- ERROR VALIDASI --}}
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-900 text-red-200 rounded">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ route('customer.rentals.store', $item->id) }}"
          enctype="multipart/form-data"
          class="space-y-6 bg-neutral-900 p-8 rounded-xl border border-neutral-800">

        @csrf

        <input type="hidden" name="item_id" value="{{ $item->id }}">

        {{-- TANGGAL SEWA --}}
        <div>
            <label class="block text-sm text-gray-400 mb-1">
                Tanggal Sewa
            </label>
            <input type="date"
                   id="tanggal_sewa"
                   name="tanggal_sewa"
                   required
                   onclick="this.showPicker()"
                   class="w-full p-3 bg-black border border-neutral-700 rounded">
        </div>

        {{-- LAMA SEWA --}}
        <div>
            <label class="block text-sm text-gray-400 mb-1">
                Lama Sewa (hari)
            </label>
            <input type="number"
                   id="lama_sewa"
                   name="lama_sewa"
                   min="1"
                   required
                   placeholder="Contoh: 3"
                   class="w-full p-3 bg-black border border-neutral-700 rounded">
        </div>

        {{-- TANGGAL KEMBALI --}}
        <div>
            <label class="block text-sm text-gray-400 mb-1">
                Tanggal Kembali
            </label>
            <input type="date"
                   id="tanggal_kembali"
                   name="tanggal_kembali"
                   readonly
                   class="w-full p-3 bg-gray-800 border border-neutral-700 rounded text-gray-400">
        </div>

        {{-- METODE PEMBAYARAN --}}
        <div>
            <label class="block text-sm text-gray-400 mb-1">
                Metode Pembayaran
            </label>
            <select name="payment_method"
                    id="payment_method"
                    required
                    class="w-full p-3 bg-black border border-neutral-700 rounded">
                <option value="">-- Pilih Metode --</option>
                <option value="transfer">Transfer / QRIS</option>
                <option value="cash">Cash (Bayar di Tempat)</option>
            </select>
        </div>

        {{-- TRANSFER --}}
        <div id="transferBox"
             class="hidden text-center border border-neutral-700 p-4 rounded">

            <p class="mb-3 text-sm text-gray-300">
                Silakan scan QRIS di bawah ini lalu upload bukti pembayaran
            </p>

            <img src="{{ asset('images/qris.jpeg') }}"
                 alt="QRIS"
                 class="mx-auto w-40 mb-4 rounded">

            <label class="block text-sm text-gray-400 mb-1">
                Bukti Transfer <span class="text-red-400">*</span>
            </label>

            <input type="file"
                   name="payment_proof"
                   id="payment_proof"
                   accept="image/*"
                   class="w-full text-sm text-gray-300">
        </div>

        {{-- TOMBOL SEWA --}}
        <button type="submit"
                class="w-full bg-red-600 hover:bg-red-700 transition px-6 py-3 rounded font-semibold">
            Sewa Sekarang
        </button>

    </form>
</div>

{{-- SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const tanggalSewa = document.getElementById('tanggal_sewa');
    const lamaSewa = document.getElementById('lama_sewa');
    const tanggalKembali = document.getElementById('tanggal_kembali');

    // 👉 ISI OTOMATIS TANGGAL HARI INI
    const today = new Date().toISOString().split('T')[0];
    tanggalSewa.value = today;

    function hitungTanggalKembali() {
        if (tanggalSewa.value && lamaSewa.value) {
            let sewa = new Date(tanggalSewa.value);
            sewa.setDate(sewa.getDate() + parseInt(lamaSewa.value));
            tanggalKembali.value = sewa.toISOString().split('T')[0];
        }
    }

    tanggalSewa.addEventListener('change', hitungTanggalKembali);
    lamaSewa.addEventListener('input', hitungTanggalKembali);

    const paymentSelect = document.getElementById('payment_method');
    const transferBox = document.getElementById('transferBox');
    const paymentProof = document.getElementById('payment_proof');

    paymentSelect.addEventListener('change', function () {
        if (this.value === 'transfer') {
            transferBox.classList.remove('hidden');
            paymentProof.required = true;
        } else {
            transferBox.classList.add('hidden');
            paymentProof.required = false;
            paymentProof.value = '';
        }
    });

});
</script>

</body>
</html>
