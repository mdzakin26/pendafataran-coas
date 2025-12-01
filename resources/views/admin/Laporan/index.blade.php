<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Laporan Pendaftaran
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto space-y-10">

            {{-- GRAPH --}}
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-6">
                    Grafik Berdasarkan Status
                </h3>
                <div class="h-64">
                    <canvas id="chartStatus"></canvas>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-6">
                    Grafik Pendaftar Mingguan
                </h3>
                <div class="h-64">
                    <canvas id="chartMinggu"></canvas>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-6">
                    Grafik Program Studi
                </h3>
                <div class="h-72">
                    <canvas id="chartProdi"></canvas>
                </div>
            </div>

        </div>
    </div>

    {{-- ===================== SCRIPT ===================== --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        console.log("STATUS:", @json($labelsStatus), @json($valuesStatus));
        console.log("MINGGU:", @json($labelsMinggu), @json($valuesMinggu));
        console.log("PRODI :", @json($labelsProdi), @json($valuesProdi));

        // ---- STATUS ----
        new Chart(document.getElementById("chartStatus"), {
            type: "pie",
            data: {
                labels: @json($labelsStatus),
                datasets: [{
                    data: @json($valuesStatus),
                    borderWidth: 1
                }]
            }
        });

        // ---- MINGGU ----
        new Chart(document.getElementById("chartMinggu"), {
            type: "line",
            data: {
                labels: @json($labelsMinggu),
                datasets: [{
                    data: @json($valuesMinggu),
                    fill: true,
                    tension: 0.3,
                    borderWidth: 2
                }]
            }
        });

        // ---- PRODI ----
        new Chart(document.getElementById("chartProdi"), {
            type: "bar",
            data: {
                labels: @json($labelsProdi),
                datasets: [{
                    data: @json($valuesProdi),
                    borderWidth: 1
                }]
            }
        });
    </script>

</x-app-layout>
