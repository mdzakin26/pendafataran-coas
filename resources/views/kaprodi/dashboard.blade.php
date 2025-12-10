<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Dashboard Kaprodi
        </h2>
    </x-slot>

    <!-- ========================== GRAFIK ========================== -->
    <div class="py-8">
        <div class="max-w-7xl mx-auto space-y-10">

            <!-- GRID GRAFIK -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- PIE STATUS -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                        Grafik Berdasarkan Status
                    </h3>
                    <div class="h-64">
                        <canvas id="chartStatus"></canvas>
                    </div>
                </div>

                <!-- GRAFIK MINGGUAN -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                        Grafik Pendaftar Mingguan
                    </h3>
                    <div class="h-64">
                        <canvas id="chartMinggu"></canvas>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- ========================== RINGKASAN ========================== -->
    <div class="max-w-7xl mx-auto mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 text-center">
            <h3 class="text-lg font-semibold dark:text-gray-200">Total Pendaftar</h3>
            <p class="text-3xl font-bold mt-2 text-blue-600">{{ $totalPendaftar }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 text-center">
            <h3 class="text-lg font-semibold dark:text-gray-200">Lolos Seleksi</h3>
            <p class="text-3xl font-bold mt-2 text-green-600">{{ $totalDiverifikasi }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 text-center">
            <h3 class="text-lg font-semibold dark:text-gray-200">Tidak Lolos</h3>
            <p class="text-3xl font-bold mt-2 text-red-600">{{ $totalDitolak }}</p>
        </div>

    </div>

    <!-- ========================== DATA PER PRODI ========================== -->
    {{-- <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-6 mt-10">

        <h2 class="text-xl font-semibold dark:text-gray-100 mb-4">Jumlah Pendaftar per Program Studi</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700 border-b border-gray-300 dark:border-gray-600">
                        <th class="px-4 py-3 font-semibold text-gray-900 dark:text-gray-200">Program Studi</th>
                        <th class="px-4 py-3 font-semibold text-gray-900 dark:text-gray-200">Jumlah Pendaftar</th>
                    </tr>
                </thead>

                <tbody class="dark:text-gray-100">
                    @foreach ($pendaftarPerProdi as $prodi)
                        <tr class="border-b border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900 transition">
                            <td class="px-4 py-3">{{ $prodi->nama_prodi }}</td>
                            <td class="px-4 py-3">{{ $prodi->pendaftaran_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div> --}}
<div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-6 mt-10">

        <h2 class="text-xl font-semibold dark:text-gray-100 mb-4">Pendaftar Diterima</h2>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-left">
                <thead>
                    <tr class="bg-green-200 dark:bg-green-700 border-b border-gray-300 dark:border-gray-600">
                        <th class="px-4 py-3 font-semibold ext-gray-900 dark:text-gray-200">Nama</th>
                        <th class="px-4 py-3 font-semibold ext-gray-900 dark:text-gray-200">Email</th>
                        <th class="px-4 py-3 font-semibold ext-gray-900 dark:text-gray-200">Program Studi</th>
                        <th class="px-4 py-3 font-semibold ext-gray-900 dark:text-gray-200">Tanggal Diterima</th>
                        <th class="px-4 py-3 font-semibold ext-gray-900 dark:text-gray-200">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($pendaftarans->where('status', 'diverifikasi') as $p)
                        <tr
                            class="border-b border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900 transition">
                            <td class="px-4 py-3">{{ $p->user->name }}</td>
                            <td class="px-4 py-3">{{ $p->user->email }}</td>
                            <td class="px-4 py-3">{{ $p->programStudi->nama_prodi ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $p->updated_at->format('d M Y') }}</td>
                            <td class="px-4 py-3">
                                <a href="{{ route('admin.pendaftaran.show', $p->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    {{--  --}}

    <!-- ========================== SCRIPTS ========================== -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        /* -------------------- CHART STATUS -------------------- */
        new Chart(document.getElementById("chartStatus"), {
            type: "pie",
            data: {
                labels: ["Lolos", "Tidak Lolos", "Total"],
                datasets: [{
                    data: [{{ $totalDiverifikasi }}, {{ $totalDitolak }}, {{ $totalPendaftar }}],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: (item) => `${item.label}: ${item.raw} orang`
                        }
                    }
                }
            }
        });

        /* -------------------- CHART MINGGUAN -------------------- */
        new Chart(document.getElementById("chartMinggu"), {
            type: "bar",
            data: {
                labels: @json($labelsMinggu),
                datasets: [{
                    label: "Jumlah pendaftar",
                    data: @json($valuesMinggu),
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: (item) => `${item.raw} orang`
                        }
                    },
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</x-app-layout>
