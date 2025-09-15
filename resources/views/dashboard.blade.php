<x-app-layout>
    {{-- <x-slot name="title">
        Dashboard Pendaftaran
    </x-slot> --}}

    <div class="py-10 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-5xl mx-auto px-6">

            <!-- Welcome Card -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6 mb-8">
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">
                    Selamat Datang, {{ Auth::user()->name }}
                </h3>
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    Kelola pendaftaran dan pantau status Anda di sini.
                </p>
            </div>

            <!-- Alerts -->
            @if(session('success'))
            <div class="mb-6 bg-green-50 dark:bg-green-900/30 border border-green-300 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg text-sm">
                <p class="font-medium">✅ {{ session('success') }}</p>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 bg-red-50 dark:bg-red-900/30 border border-red-300 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg text-sm">
                <p class="font-medium">⚠️ {{ session('error') }}</p>
            </div>
            @endif

            <!-- Status + Progress -->
            @if(Auth::user()->pendaftaran)
                @php $pendaftaran = Auth::user()->pendaftaran; @endphp

                <!-- Progress Bar -->
                <div class="mb-8">
                    <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400">
                        <span>Pendaftaran</span>
                        <span>{{ ucfirst($pendaftaran->status) }}</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-2">
                        <div class="
                            @if($pendaftaran->status == 'diverifikasi') bg-green-500
                            @elseif($pendaftaran->status == 'ditolak') bg-red-500
                            @else bg-yellow-500
                            @endif
                            h-2 rounded-full
                        " style="width: 
                            @if($pendaftaran->status == 'sedang ditinjau') 50%
                            @elseif($pendaftaran->status == 'diverifikasi') 100%
                            @else 100%
                            @endif
                        "></div>
                    </div>
                </div>

                <!-- Status Card -->
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Status Pendaftaran</h4>

                    @if($pendaftaran->status == 'diverifikasi')
                        <div class="flex items-start space-x-4">
                            <div class="shrink-0 text-green-500">
                                <i class="bi bi-check-circle-fill text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-lg font-medium text-green-700 dark:text-green-300">Diverifikasi</p>
                                <p class="text-gray-600 dark:text-gray-400 text-sm">Pendaftaran Anda sudah diverifikasi. Info selanjutnya akan dikirim via email.</p>
                            </div>
                        </div>

                    @elseif($pendaftaran->status == 'ditolak')
                        <div class="flex items-start space-x-4">
                            <div class="shrink-0 text-red-500">
                                <i class="bi bi-x-circle-fill text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-lg font-medium text-red-700 dark:text-red-300">Ditolak</p>
                                <p class="text-gray-600 dark:text-gray-400 text-sm">Catatan Admin: {{ $pendaftaran->catatan_admin ?? 'Tidak ada catatan.' }}</p>
                            </div>
                        </div>

                    @else
                        <div class="flex items-start space-x-4">
                            <div class="shrink-0 text-yellow-500">
                                <i class="bi bi-hourglass-split text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-lg font-medium text-yellow-700 dark:text-yellow-300">Sedang Ditinjau</p>
                                <p class="text-gray-600 dark:text-gray-400 text-sm">Data Anda sedang diperiksa oleh admin. Mohon ditunggu.</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Ringkasan Data -->
                <div class="mt-6 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-6">
                    <h4 class="text-md font-semibold mb-3 text-gray-900 dark:text-white">Ringkasan Data</h4>
                    <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2">
                        <li><strong>Nama:</strong> {{ Auth::user()->name }}</li>
                        <li><strong>Tanggal Daftar:</strong> {{ $pendaftaran->created_at->format('d M Y') }}</li>
                        <li><strong>Status:</strong> {{ ucfirst($pendaftaran->status) }}</li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                @if($pendaftaran->status == 'diverifikasi')
                <div class="mt-6 flex space-x-4">
                    {{-- <a href="{{ route('pendaftaran.show', $pendaftaran->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">📄 Lihat Detail</a> --}}
                    {{-- <a href="{{ route('pendaftaran.cetak', $pendaftaran->id) }}" target="_blank" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">🖨 Cetak Bukti</a> --}}
                </div>
                @endif

            @else
            <!-- Belum daftar -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-10 text-center">
                <i class="bi bi-file-earmark-text text-gray-400 dark:text-gray-500 text-5xl"></i>
                <h3 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">Belum Melengkapi Pendaftaran</h3>
                <p class="mt-2 text-gray-600 dark:text-gray-400 text-sm">Lengkapi formulir untuk memulai pendaftaran Anda.</p>
                <a href="{{ route('pendaftaran.create') }}" class="mt-5 inline-block bg-blue-600 text-white text-sm font-medium px-5 py-3 rounded-md hover:bg-blue-700 transition">
                    Lengkapi Formulir
                </a>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
