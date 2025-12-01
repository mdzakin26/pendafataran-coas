<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Laporan Pendaftaran
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto space-y-10">

            {{-- 2 KOLOM GRAFIK --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- PIE STATUS --}}
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                        Grafik Berdasarkan Status
                    </h3>
                    <div class="h-64">
                        <canvas id="chartStatus"></canvas>
                    </div>
                </div>

                {{-- GRAFIK MINGGUAN --}}
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


    {{-- DATA PENDAFTAR --}}
    <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-6 mt-10">
<a href="{{ route('admin.laporan.export') }}"
   class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
   Export Excel
</a>

        <h2 class="text-xl font-semibold dark:text-gray-100 mb-4">Data Pendaftar</h2>

        <div class="overflow-x-auto">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700 border-b border-gray-300 dark:border-gray-600">
                            <th class="px-4 py-3 text-gray-900 dark:text-gray-200 font-semibold">Nama</th>
                            <th class="px-4 py-3 text-gray-900 dark:text-gray-200 font-semibold">Email</th>
                            <th class="px-4 py-3 text-gray-900 dark:text-gray-200 font-semibold">Program Studi</th>
                            <th class="px-4 py-3 text-gray-900 dark:text-gray-200 font-semibold">Status</th>
                            <th class="px-4 py-3 text-gray-900 dark:text-gray-200 font-semibold">Tanggal</th>
                        </tr>
                    </thead>

                    <tbody class="dark:text-gray-100">
                        @foreach ($pendaftarans as $p)
                            <tr
                                class="border-b border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900 transition">

                                <td class="px-4 py-3">
                                    {{ $p->user->name }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $p->user->email }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $p->programStudi->nama_prodi ?? '-' }}
                                </td>

                                <td class="px-4 py-3">
                                    <span
                                        class="
        px-2 py-1 rounded text-xs font-semibold
        @if (strtolower($p->status) == 'diverifikasi') bg-green-600 text-white
        @elseif (strtolower($p->status) == 'pending') bg-yellow-500 text-white
        @elseif (strtolower($p->status) == 'ditolak') bg-red-600 text-white
        @else bg-gray-500 text-white @endif
    ">
                                        {{ ucfirst($p->status) }}
                                    </span>
                                </td>


                                <td class="px-4 py-3">
                                    {{ $p->created_at->format('d M Y') }}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>


    {{-- SCRIPTS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // CHART STATUS
        new Chart(document.getElementById("chartStatus"), {
            type: "pie",
            data: {
                labels: @json($labelsStatus),
                datasets: [{
                    data: @json($valuesStatus),
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

        // CHART MINGGUAN
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
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>

</x-app-layout>
