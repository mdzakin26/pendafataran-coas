<x-guest-layout>
    <x-slot name="title">
        Login
    </x-slot>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4" x-data="{ show: false }">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
                {{-- KITA GANTI <x-text-input> DENGAN <input> BIASA --}}
                <input id="password" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password" />

                {{-- Tombol Ikon Mata (tetap sama) --}}
                <div @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                    <svg x-show="!show" class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                        <path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 010-1.18l1.105-1.99a.5.5 0 01.866.5L1.321 9.4a1.651 1.651 0 010 1.18l1.32 2.376a.5.5 0 01-.866.5L.664 11.77a1.651 1.651 0 010-1.18zM19.336 9.41a1.651 1.651 0 010 1.18l-1.105 1.99a.5.5 0 01-.866-.5l1.321-2.377a1.651 1.651 0 010-1.18l-1.32-2.376a.5.5 0 01.866-.5l1.105 1.99a1.651 1.651 0 010 1.18z" clip-rule="evenodd" />
                    </svg>
                    <svg x-show="show" class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="display: none;">
                        <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.5 2.5 0 013.464 3.464l1.515 1.514a4.501 4.501 0 00-6.494-6.494zM10 15a4.5 4.5 0 01-4.5-4.5c0-1.35.6-2.55 1.515-3.464l6.95 6.95A4.5 4.5 0 0110 15z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <div class="text-center mt-6">
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Mengalami kendala saat login atau mendaftar?
            <a href="mailto:admin@pendaftaran.com" class="underline text-indigo-600 dark:text-indigo-400 hover:text-indigo-800">
                Hubungi Admin
            </a>
        </p>
    </div>
</x-guest-layout>