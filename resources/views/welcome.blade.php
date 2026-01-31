<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sewa Kamera & Drone</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gradient-to-br from-black via-neutral-900 to-black text-white">

<div class="relative min-h-screen flex flex-col">

    {{-- NAVBAR --}}
    <div class="flex justify-between items-center px-8 py-6">
        <h1 class="text-xl font-bold tracking-wide">DroneCam Rent</h1>

        <div class="flex items-center gap-2">
            @if (Route::has('login'))
                @auth
                    {{-- LOGOUT --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 border border-red-600 text-red-500 rounded text-sm
                                   hover:bg-red-600 hover:text-white transition">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="px-4 py-2 border rounded text-sm hover:bg-white hover:text-black transition">
                        Login
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="px-4 py-2 border rounded text-sm hover:bg-white hover:text-black transition">
                            Register
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </div>

    {{-- HERO SECTION --}}
    <div class="flex-1 flex items-center justify-center px-6">
        <div class="max-w-6xl w-full grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

            <div>
                <h2 class="text-4xl md:text-5xl font-bold leading-tight mb-6">
                    Aplikasi Penyewaan <span class="text-red-500">Kamera & Drone</span>
                </h2>
                <p class="text-gray-400 mb-8">
                    Solusi mudah dan cepat untuk menyewa kamera DSLR, mirrorless, dan drone profesional
                    untuk fotografi, videografi, dan kebutuhan event Anda.
                </p>

                <div class="flex gap-4">
                    <a href="{{ route('login') }}"
                       class="px-6 py-3 bg-red-600 rounded text-white font-semibold hover:bg-red-700 transition">
                        Mulai Sewa
                    </a>
                    <a href="{{ route('login') }}"
                       class="px-6 py-3 border rounded font-semibold hover:bg-white hover:text-black transition">
                        Lihat Produk
                    </a>
                </div>
            </div>

            <div class="flex justify-center">
                <div class="bg-neutral-900 border border-neutral-700 rounded-xl p-10 text-center shadow-xl">
                    <p class="text-sm text-gray-400 mb-2">Produk Tersedia</p>
                    <h3 class="text-3xl font-bold text-red-500">DSLR · Mirrorless · Drone</h3>
                </div>
            </div>

        </div>
    </div>

    {{-- FOOTER --}}
    <div class="text-center text-sm text-gray-500 py-4 border-t border-neutral-800">
        MANO
    </div>

</div>
</body>
</html>
