<x-guest-layout>
    <x-slot name="logo"></x-slot>
    {{-- <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-black via-neutral-900 to-black"> --}}
        <div class="w-full max-w-md bg-neutral-900 border border-neutral-800 rounded-xl shadow-xl p-8">

            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-400">DroneCam Rent</h1>
                <p class="text-sm text-gray-400 mt-2">Login untuk mulai menyewa kamera & drone</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email"
                        class="block mt-1 w-full bg-black border-neutral-700 text-white"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password"
                        class="block mt-1 w-full bg-black border-neutral-700 text-white"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-sm">
                    <label for="remember_me" class="inline-flex items-center text-gray-400">
                        <input id="remember_me"
                               type="checkbox"
                               class="rounded border-neutral-700 bg-black text-red-600 focus:ring-red-600"
                               name="remember">
                        <span class="ms-2">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-gray-400 hover:text-white underline" href="{{ route('password.request') }}">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <!-- Submit -->
                <div>
                    <button type="submit"
                            class="w-full py-3 bg-red-600 rounded-lg font-semibold text-white hover:bg-red-700 transition">
                        Login
                    </button>
                </div>
            </form>

            <!-- Register -->
            <div class="text-center mt-6 text-sm text-gray-400">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-red-500 hover:underline">Daftar sekarang</a>
            </div>
        </div>
    </div>
</x-guest-layout>
