<x-guest-layout>
    <x-slot name="logo"></x-slot>

    {{-- <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-black via-neutral-900 to-black px-4"> --}}

        <!-- REGISTER CARD -->
        <div class="w-full max-w-md bg-neutral-900 border border-neutral-800 rounded-xl shadow-xl p-8">

            <h1 class="text-2xl font-bold text-center mb-2 text-gray-400">DroneCam Rent</h1>
            <p class="text-center text-gray-400 text-sm mb-6">Buat akun untuk mulai menyewa kamera & drone</p>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name"
                        class="block mt-1 w-full bg-black border-neutral-700 text-white"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required
                        autofocus
                        autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email"
                        class="block mt-1 w-full bg-black border-neutral-700 text-white"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
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
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation"
                        class="block mt-1 w-full bg-black border-neutral-700 text-white"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <button type="submit"
                        class="w-full py-3 bg-red-600 rounded-lg font-semibold text-white hover:bg-red-700 transition">
                    Register
                </button>
            </form>

            <p class="text-center text-sm text-gray-400 mt-6">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-red-500 hover:underline">Login</a>
            </p>
        </div>

    </div>
</x-guest-layout>
