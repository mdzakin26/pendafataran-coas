<div x-data="{ open: false }" class="flex h-screen bg-gray-100 dark:bg-gray-900">
    <!-- Sidebar -->
    <aside :class="open ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-30 w-64 bg-gray-800 text-gray-200 transition-transform duration-300 ease-in-out sm:translate-x-0">

        <!-- Logo / Header -->
        <div class="flex items-center justify-center h-16 border-b border-gray-700">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/logo-if.png') }}" alt="Logo" class="h-8">
            </a>
        </div>

        <!-- Navigation -->
        <nav class="mt-6">
            <ul class="space-y-2 px-4">
                @if (Auth::user()->role === 'admin')
                    <li>
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"
                            class="w-full block rounded-lg px-3 py-2 hover:bg-gray-700">
                            {{ __('Beranda') }}
                        </x-nav-link>
                    </li>
                    <li>
                        <x-nav-link :href="route('admin.pendaftaran.index')" :active="request()->routeIs('admin.pendaftaran.*')"
                            class="w-full block rounded-lg px-3 py-2 hover:bg-gray-700">
                            {{ __('Pendaftar') }}
                        </x-nav-link>
                    </li>
                    <li>
                        <x-nav-link :href="route('admin.program-studi.index')" :active="request()->routeIs('admin.program-studi.*')"
                            class="w-full block rounded-lg px-3 py-2 hover:bg-gray-700">
                            {{ __('Program Studi') }}
                        </x-nav-link>
                    </li>
                    <li>
                        <x-nav-link :href="route('admin.matakuliah.index')" :active="request()->routeIs('admin.matakuliah.*')"
                            class="w-full block rounded-lg px-3 py-2 hover:bg-gray-700">
                            {{ __('Mata Kuliah') }}
                        </x-nav-link>
                    </li>
                @else
                    <li>
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                            class="w-full block rounded-lg px-3 py-2 hover:bg-gray-700">
                            {{ __('Beranda') }}
                        </x-nav-link>
                    </li>
                @endif
            </ul>
        </nav>

        <!-- User Info -->
        <div class="absolute bottom-0 w-full border-t border-gray-700 p-4">
            <div class="mb-2">
                <div class="font-medium text-base">{{ Auth::user()->name }}</div>
                <div class="text-sm text-gray-400">{{ Auth::user()->email }}</div>
            </div>
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm text-gray-400">Mode</span>
                <button @click="document.documentElement.classList.toggle('dark')"
                    class="p-2 rounded bg-gray-200 dark:bg-gray-700">
                    🌞 / 🌙
                </button>
            </div>
            <div class="space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="block rounded-lg px-3 py-2 hover:bg-gray-700">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="block rounded-lg px-3 py-2 hover:bg-gray-700">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>

        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col sm:ml-64">
        <!-- Mobile header (toggle button) -->
        <header
            class="sm:hidden flex items-center justify-between h-16 px-4 bg-gray-800 text-gray-200 border-b border-gray-700">
            <button @click="open = ! open" class="p-2 focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <span class="font-bold">Dashboard</span>
        </header>

        <!-- Page content -->
        {{-- <main class="flex-1 overflow-y-auto p-6">
            {{ $slot }}
        </main> --}}
    </div>

</div>
