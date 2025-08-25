<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        {{-- Current Password --}}
        <div x-data="{ show: false }">
            <x-input-label for="current_password" :value="__('Current Password')" />
            <div class="relative mt-1">
                <input id="current_password" name="current_password" :type="show ? 'text' : 'password'" class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" autocomplete="current-password">
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
            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
        </div>

        {{-- New Password --}}
        <div x-data="{ show: false }">
            <x-input-label for="password" :value="__('New Password')" />
            <div class="relative mt-1">
                <input id="password" name="password" :type="show ? 'text' : 'password'" class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" autocomplete="new-password">
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

        {{-- Confirm Password --}}
        <div x-data="{ show: false }">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <div class="relative mt-1">
                <input id="password_confirmation" name="password_confirmation" :type="show ? 'text' : 'password'" class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" autocomplete="new-password">
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
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>