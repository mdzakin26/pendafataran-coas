<x-guest-layout>
    <x-slot name="title">
        Login
    </x-slot>

    <!-- Card Container -->
    <div class="max-w-md mx-auto bg-white dark:bg-gray-900 rounded-2xl shadow-xl p-8 mt-10">
        <!-- Header -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Selamat Datang </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Masuk untuk melanjutkan</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" 
                    class="block mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-gray-700 dark:bg-gray-800 dark:text-gray-200" 
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div x-data="{ show: false }">
                <x-input-label for="password" :value="__('Password')" />
                <div class="relative mt-1">
                    <input id="password" 
                        class="block w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-gray-700 dark:bg-gray-800 dark:text-gray-200 pr-10" 
                        :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password" />
                    
                    <!-- Eye Toggle -->
                    <button type="button" @click="show = !show" 
                        class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor" style="display:none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 012.51-4.375M6.343 6.343A9.97 9.97 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.96 9.96 0 01-4.136 5.274M6.343 6.343l11.314 11.314" />
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me + Forgot Password -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400">
                    <input id="remember_me" type="checkbox" 
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-800 dark:border-gray-600">
                    <span class="ml-2">Ingat saya</span>
                </label>
                
                @if (Route::has('password.request'))
                    <a class="text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 underline" 
                       href="{{ route('password.request') }}">
                        Lupa kata sandi?
                    </a>
                @endif
            </div>

            <!-- Submit -->
            <x-primary-button class="w-full py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition ease-in-out duration-200">
                {{ __('Log in') }}
            </x-primary-button>
        </form>

        <!-- Register Section -->
        @if (Route::has('register'))
        <div class="text-center mt-6">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Belum punya akun?
            </p>
            <a href="{{ route('register') }}" 
               class="mt-2 inline-block w-full text-center py-2 rounded-xl border border-indigo-600 text-indigo-600 hover:bg-indigo-50 dark:border-indigo-400 dark:text-indigo-400 dark:hover:bg-gray-800 transition ease-in-out duration-200">
                Daftar Sekarang
            </a>
        </div>
        @endif

        <!-- Contact -->
        <div class="text-center mt-6">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Kendala saat login? 
                <a href="mailto:admin@pendaftaran.com" 
                   class="underline text-indigo-600 dark:text-indigo-400 hover:text-indigo-800">
                    Hubungi Admin
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>
