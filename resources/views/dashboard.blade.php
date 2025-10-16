<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Beranda & Statistik Warga') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white p-6 shadow-sm sm:rounded-lg flex items-center">
                    <div class="bg-blue-500 text-white rounded-full h-12 w-12 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div class="ml-4">
                        <div class="text-sm text-gray-500">Total Warga</div>
                        <div class="text-2xl font-bold text-gray-800">{{ $totalWarga }}</div>
                    </div>
                </div>
                <div class="bg-white p-6 shadow-sm sm:rounded-lg flex items-center">
                    <div class="bg-green-500 text-white rounded-full h-12 w-12 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </div>
                    <div class="ml-4">
                        <div class="text-sm text-gray-500">Total Keluarga</div>
                        <div class="text-2xl font-bold text-gray-800">{{ $totalKeluarga }}</div>
                    </div>
                </div>
                <div class="bg-white p-6 shadow-sm sm:rounded-lg flex items-center">
                    <div class="bg-yellow-500 text-white rounded-full h-12 w-12 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="ml-4">
                        <div class="text-sm text-gray-500">Surat Dikeluarkan (Bulan Ini)</div>
                        <div class="text-2xl font-bold text-gray-800">{{ $suratBulanIni }}</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                    <div class="p-6 text-gray-900 flex flex-col w-full">
                        <h3 class="font-semibold text-lg mb-4 flex-shrink-0">Klasifikasi Jenis Kelamin</h3>
                        <div class="relative flex-grow">
                            <canvas id="genderChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                    <div class="p-6 text-gray-900 flex flex-col w-full">
                        <h3 class="font-semibold text-lg mb-4 flex-shrink-0">Klasifikasi Kelompok Usia</h3>
                        <div class="relative flex-grow">
                            <canvas id="ageChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                    <div class="p-6 text-gray-900 flex flex-col w-full">
                        <h3 class="font-semibold text-lg mb-4 flex-shrink-0">Klasifikasi Agama</h3>
                        <div class="relative flex-grow">
                            <canvas id="religionChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                     <div class="p-6 text-gray-900 flex flex-col w-full">
                        <h3 class="font-semibold text-lg mb-4 flex-shrink-0">Klasifikasi Pendidikan Terakhir</h3>
                        <div class="relative flex-grow">
                            <canvas id="educationChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                 <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold">Aktivitas Surat Terbaru</h3>
                        <a href="{{ route('surat.index') }}" class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full bg-white">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Surat</th>
                                    <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Warga</th>
                                    <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keperluan</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 divide-y divide-gray-200">
                                @forelse ($riwayatTerbaru as $riwayat)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4 text-sm font-mono">{{ $riwayat->nomor_surat }}</td>
                                    <td class="py-3 px-4 text-sm whitespace-nowrap">{{ $riwayat->created_at->format('d M Y') }}</td>
                                    <td class="py-3 px-4 text-sm">{{ $riwayat->warga->nama_lengkap ?? 'N/A' }}</td>
                                    <td class="py-3 px-4 text-sm">{{ $riwayat->keperluan }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">Belum ada aktivitas surat.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

    <script>
        Chart.register(ChartDataLabels);
        Chart.defaults.font.family = "'Figtree', sans-serif";
        Chart.defaults.color = '#6b7280';

        // Data dari Controller
        const genderLabels = @json($genderLabels);
        const genderCounts = @json($genderCounts);
        const ageLabels = @json($ageLabels);
        const ageCounts = @json($ageCounts);
        const educationLabels = @json($educationLabels);
        const educationCounts = @json($educationCounts);
        const religionLabels = @json($religionLabels);
        const religionCounts = @json($religionCounts);

        // Opsi umum untuk menonaktifkan aspect ratio
        const chartOptions = {
            maintainAspectRatio: false,
            responsive: true,
        };

        // Diagram Jenis Kelamin (Doughnut)
        new Chart(document.getElementById('genderChart'), {
            type: 'doughnut',
            data: {
                labels: genderLabels,
                datasets: [{
                    label: 'Jumlah Warga', data: genderCounts,
                    backgroundColor: ['rgba(59, 130, 246, 0.8)', 'rgba(239, 68, 68, 0.8)'],
                    borderColor: ['#fff'], borderWidth: 2
                }]
            },
            options: {
                ...chartOptions,
                plugins: {
                    legend: { position: 'top' },
                    datalabels: {
                        formatter: (value, ctx) => {
                            const total = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            const percentage = (value / total) * 100;
                            if (percentage < 5) return '';
                            return percentage.toFixed(1) + '%';
                        },
                        color: '#fff', font: { weight: 'bold', size: 14 }
                    }
                }
            }
        });

        // Diagram Usia (Bar)
        new Chart(document.getElementById('ageChart'), {
            type: 'bar',
            data: {
                labels: ageLabels,
                datasets: [{
                    label: 'Jumlah Warga', data: ageCounts,
                    backgroundColor: 'rgba(16, 185, 129, 0.7)',
                    borderColor: 'rgba(16, 185, 129, 1)',
                    borderWidth: 1, borderRadius: 4
                }]
            },
            options: {
                ...chartOptions,
                scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } },
                plugins: {
                    legend: { display: false },
                    datalabels: {
                        anchor: 'end', align: 'top',
                        formatter: (value) => value,
                        color: '#374151', font: { weight: 'bold' }
                    }
                }
            }
        });
        
        // Diagram Agama (Pie)
        new Chart(document.getElementById('religionChart'), {
            type: 'pie',
            data: {
                labels: religionLabels,
                datasets: [{
                    label: 'Jumlah Warga', data: religionCounts,
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)', 'rgba(239, 68, 68, 0.8)',
                        'rgba(16, 185, 129, 0.8)', 'rgba(245, 158, 11, 0.8)',
                        'rgba(139, 92, 246, 0.8)', 'rgba(236, 72, 153, 0.8)'
                    ],
                    borderColor: '#fff', borderWidth: 2
                }]
            },
            options: {
                ...chartOptions,
                plugins: {
                    legend: { position: 'top' },
                    datalabels: {
                        formatter: (value, ctx) => {
                            const total = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            const percentage = (value / total) * 100;
                            return percentage > 3 ? percentage.toFixed(1) + '%' : '';
                        },
                        color: '#fff', font: { weight: 'bold' }
                    }
                }
            }
        });

        // Diagram Pendidikan (Horizontal Bar)
        new Chart(document.getElementById('educationChart'), {
            type: 'bar',
            data: {
                labels: educationLabels,
                datasets: [{
                    label: 'Jumlah Warga', data: educationCounts,
                    backgroundColor: 'rgba(245, 158, 11, 0.7)',
                    borderColor: 'rgba(245, 158, 11, 1)',
                    borderWidth: 1, borderRadius: 4
                }]
            },
            options: {
                ...chartOptions,
                indexAxis: 'y',
                scales: { x: { beginAtZero: true, ticks: { stepSize: 1 } } },
                plugins: {
                    legend: { display: false },
                    datalabels: {
                        anchor: 'end', align: 'right',
                        formatter: (value) => value,
                        color: 'white', font: { weight: 'bold' }
                    }
                }
            }
        });
    </script>
</x-app-layout>