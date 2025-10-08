<div x-data="{ open: true, darkMode: localStorage.theme === 'dark' }" x-init="if (darkMode) document.documentElement.classList.add('dark');
else document.documentElement.classList.remove('dark');" class="flex h-screen bg-gray-100 dark:bg-gray-900">

    <!-- Sidebar -->
    <aside :class="open ? 'w-64' : 'w-20'"
        class="fixed inset-y-0 left-0 z-30 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 
               transition-all duration-300 shadow-xl flex flex-col border-r border-gray-200 dark:border-gray-700">

        <!-- Header / Logo -->
        <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('assets/logo-if.png') }}" alt="Logo" class="h-8">

            </div>
            <button @click="open = !open" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                <i class="bi" :class="open ? 'bi-chevron-left' : 'bi-chevron-right'"></i>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-2 py-4 space-y-2">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg transition-all 
                      hover:bg-blue-400 hover:text-white 
                      {{ request()->routeIs('dashboard') ? 'bg-blue-400 text-white' : '' }}">
                <div class="p-2 rounded-md bg-gray-200 dark:bg-gray-700">
                    <i class="bi bi-house"></i>
                </div>
                <span x-show="open"></span>
            </a>

            <!-- Menu Admin -->
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('admin.pendaftaran.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg transition-all 
                          hover:bg-blue-400 hover:text-white 
                          {{ request()->routeIs('admin.pendaftaran.*') ? 'bg-blue-400 text-white' : '' }}">
                    <div class="p-2 rounded-md bg-gray-200 dark:bg-gray-700">
                        <i class="bi bi-people"></i>
                    </div>
                    <span x-show="open">Pendaftar</span>
                </a>

                <a href="{{ route('admin.program-studi.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg transition-all 
                          hover:bg-blue-400 hover:text-white 
                          {{ request()->routeIs('admin.program-studi.*') ? 'bg-blue-400 text-white' : '' }}">
                    <div class="p-2 rounded-md bg-gray-200 dark:bg-gray-700">
                        <i class="bi bi-journal-bookmark"></i>
                    </div>
                    <span x-show="open">Program Studi</span>
                </a>

                <a href="{{ route('admin.matakuliah.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg transition-all 
                          hover:bg-blue-400 hover:text-white 
                          {{ request()->routeIs('admin.matakuliah.*') ? 'bg-blue-400 text-white' : '' }}">
                    <div class="p-2 rounded-md bg-gray-200 dark:bg-gray-700">
                        <i class="bi bi-book"></i>
                    </div>
                    <span x-show="open">Mata Kuliah</span>
                </a>
                <a href="{{ route('admin.pendaftaran.laporan') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg transition-all 
          hover:bg-blue-400 hover:text-white 
          {{ request()->routeIs('admin.pendaftaran.laporan') ? 'bg-blue-400 text-white' : '' }}">
                    <div class="p-2 rounded-md bg-gray-200 dark:bg-gray-700">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <span x-show="open">Laporan </span>
                </a>
            @else
                <!-- Menu Mahasiswa -->
                @php
                    $pendaftaran = Auth::user()->pendaftaran ?? null;
                    $status = $pendaftaran->status ?? 'Belum Daftar';
                    $badgeColor = match ($status) {
                        'pending' => 'bg-yellow-500 text-white',
                        'diterima' => 'bg-green-600 text-white',
                        'ditolak' => 'bg-red-600 text-white',
                        default => 'bg-gray-400 text-white',
                    };
                @endphp

                <a href="{{ route('mahasiswa.status') }}"
                    class="flex items-center justify-between px-3 py-2 rounded-lg transition-all 
                          hover:bg-blue-400 hover:text-white 
                          {{ request()->routeIs('mahasiswa.status') ? 'bg-blue-400 text-white' : '' }}">

                    <div class="flex items-center gap-3">
                        <div class="p-2 rounded-md bg-gray-200 dark:bg-gray-700">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <span x-show="open">Status Pendaftaran</span>
                    </div>

                    <!-- Badge -->
                    <span class="text-xs px-2 py-1 rounded-full font-semibold {{ $badgeColor }}">
                        {{ ucfirst($status) }}
                    </span>
                </a>
            @endif
        </nav>

        <!-- Footer -->
        <div class="p-4 border-t border-gray-200 dark:border-gray-700 space-y-3">
            <div class="flex items-center gap-3">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}"
                    class="h-10 w-10 rounded-full border">
                <div x-show="open">
                    <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <!-- Dark Mode -->
            <button
                @click="
                    darkMode = !darkMode;
                    if (darkMode) { 
                        document.documentElement.classList.add('dark'); 
                        localStorage.theme = 'dark'; 
                    } else { 
                        document.documentElement.classList.remove('dark'); 
                        localStorage.theme = 'light'; 
                    }
                "
                class="flex items-center gap-3 w-full px-3 py-2 rounded-lg 
                   bg-gray-100 dark:bg-gray-700 hover:bg-blue-500 hover:text-white transition">
                <i :class="darkMode ? 'bi bi-moon-fill' : 'bi bi-brightness-high-fill'"></i>
                <span x-show="open" x-text="darkMode ? 'Dark Mode' : 'Light Mode'"></span>
            </button>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center gap-3 w-full px-3 py-2 rounded-lg 
                   bg-red-100 dark:bg-red-700/30 text-red-600 dark:text-red-300 
                   hover:bg-red-500 hover:text-white transition">
                    <i class="bi bi-box-arrow-right"></i>
                    <span x-show="open">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->

</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
