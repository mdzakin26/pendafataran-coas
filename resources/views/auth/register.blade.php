<x-guest-layout>
    <x-slot name="title">
        {{ __('Daftar Akun Baru') }}
    </x-slot>

    {{-- Alpine.js sekarang membungkus SEMUANYA agar modal berfungsi --}}
    <div x-data="{ showPanduan: false }">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Daftar Akun</h2>
            <button @click="showPanduan = true" type="button" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                Lihat Panduan
            </button>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-input-label for="name" :value="__('Nama Lengkap ')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="nrp" :value="__(' NRP')" />
                <x-text-input id="nrp" class="block mt-1 w-full" type="text" name="nrp" :value="old('nrp')" required maxlength="9" />
                <x-input-error :messages="$errors->get('nrp')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="email" :value="__('Email Aktif')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="no_telepon" :value="__('Nomor Telepon/HP Aktif')" />
                <x-text-input id="no_telepon" class="block mt-1 w-full" type="tel" name="no_telepon" :value="old('no_telepon')" required placeholder="Contoh: 081234567890" />
                <x-input-error :messages="$errors->get('no_telepon')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
                <x-text-input id="tanggal_lahir" class="block mt-1 w-full" type="date" name="tanggal_lahir" :value="old('tanggal_lahir')" required />
                <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
            </div>

            <div class="mt-4" x-data="{ show: false }">
                <x-input-label for="password" :value="__('Password')" />
                <div class="relative">
                    <input id="password" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :type="show ? 'text' : 'password'" name="password" required autocomplete="new-password" />

                    <div @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                        {{-- Ikon Mata Terbuka --}}
                        <svg x-show="!show" class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                            <path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 010-1.18l1.105-1.99a.5.5 0 01.866.5L1.321 9.4a1.651 1.651 0 010 1.18l1.32 2.376a.5.5 0 01-.866.5L.664 11.77a1.651 1.651 0 010-1.18zM19.336 9.41a1.651 1.651 0 010 1.18l-1.105 1.99a.5.5 0 01-.866-.5l1.321-2.377a1.651 1.651 0 010-1.18l-1.32-2.376a.5.5 0 01.866-.5l1.105 1.99a1.651 1.651 0 010 1.18z" clip-rule="evenodd" />
                        </svg>
                        {{-- Ikon Mata Tertutup --}}
                        <svg x-show="show" class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="display: none;">
                            <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.5 2.5 0 013.464 3.464l1.515 1.514a4.501 4.501 0 00-6.494-6.494zM10 15a4.5 4.5 0 01-4.5-4.5c0-1.35.6-2.55 1.515-3.464l6.95 6.95A4.5 4.5 0 0110 15z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-4" x-data="{ show: false }">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <div class="relative">
                    <input id="password_confirmation" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :type="show ? 'text' : 'password'" name="password_confirmation" required autocomplete="new-password" />

                    <div @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                        {{-- Ikon Mata Terbuka --}}
                        <svg x-show="!show" class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                            <path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 010-1.18l1.105-1.99a.5.5 0 01.866.5L1.321 9.4a1.651 1.651 0 010 1.18l1.32 2.376a.5.5 0 01-.866.5L.664 11.77a1.651 1.651 0 010-1.18zM19.336 9.41a1.651 1.651 0 010 1.18l-1.105 1.99a.5.5 0 01-.866-.5l1.321-2.377a1.651 1.651 0 010-1.18l-1.32-2.376a.5.5 0 01.866-.5l1.105 1.99a1.651 1.651 0 010 1.18z" clip-rule="evenodd" />
                        </svg>
                        {{-- Ikon Mata Tertutup --}}
                        <svg x-show="show" class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="display: none;">
                            <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.5 2.5 0 013.464 3.464l1.515 1.514a4.501 4.501 0 00-6.494-6.494zM10 15a4.5 4.5 0 01-4.5-4.5c0-1.35.6-2.55 1.515-3.464l6.95 6.95A4.5 4.5 0 0110 15z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>

        <div x-show="showPanduan" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50" style="display: none;">
            <div @click.away="showPanduan = false" class="bg-white dark:bg-gray-800 rounded-lg shadow-xl overflow-hidden max-w-2xl w-full m-4">
                <div class="flex justify-between items-center p-4 border-b dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Panduan Pendaftaran</h3>
                    <button @click="showPanduan = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-6 space-y-4 text-gray-700 dark:text-gray-300 max-h-[60vh] overflow-y-auto">
                    <div>
                        <h4 class="font-semibold">Langkah 1: Membuat Akun</h4>
                        <p class="text-sm mt-1">Isi semua data pada formulir ini (Nama, NIK, Email, No. Telepon, Tanggal Lahir, dan Password) dengan data yang valid, lalu klik tombol "Register".</p>
                    </div>
                    <div>
                        <h4 class="font-semibold">Langkah 2: Melengkapi Pendaftaran</h4>
                        <p class="text-sm mt-1">Setelah berhasil membuat akun, Anda akan diarahkan ke Dashboard. Klik tombol "Lengkapi Formulir Sekarang" untuk melanjutkan ke tahap pengisian data alamat dan upload dokumen.</p>
                    </div>
                    <div>
                        <h4 class="font-semibold">Langkah 3: Upload Dokumen</h4>
                        <p class="text-sm mt-1">Siapkan scan KTP dan Ijazah terakhir Anda dalam format PDF, JPG, atau PNG dengan ukuran maksimal 2MB, lalu unggah pada form yang tersedia.</p>
                    </div>
                    <div>
                        <h4 class="font-semibold">Langkah 4: Proses Verifikasi</h4>
                        <p class="text-sm mt-1">Setelah Anda mengirim formulir pendaftaran, status Anda akan menjadi "Pending". Tim admin kami akan memeriksa data dan dokumen Anda. Anda akan menerima notifikasi melalui email jika status pendaftaran Anda sudah diupdate.</p>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-3 text-right">
                    <button @click="showPanduan = false" type="button" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition">
                        Saya Mengerti
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>