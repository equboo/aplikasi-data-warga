<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center bg-white px-6 py-4 shadow-lg">
            <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                {{ __('Beranda & Statistik Warga') }}
            </h2>
            <a href="{{ route('dashboard.cetak') }}" target="_blank" class="inline-flex items-center px-6 py-3 bg-white text-green-600 border border-transparent rounded-lg font-semibold text-sm uppercase tracking-widest hover:bg-gray-100 transition-all duration-300 shadow-md hover:shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Cetak Laporan
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Statistik Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
                <a href="{{ route('manajemen.index', ['tab' => 'warga']) }}" class="bg-white p-8 shadow-lg sm:rounded-xl flex items-center hover:shadow-2xl hover:scale-105 transition-all duration-300 border border-gray-100">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-full h-16 w-16 flex items-center justify-center flex-shrink-0 shadow-md">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Warga</div>
                        <div class="text-3xl font-extrabold text-gray-900">{{ $totalWarga }}</div>
                    </div>
                </a>
                <a href="{{ route('manajemen.index', ['tab' => 'keluarga']) }}" class="bg-white p-8 shadow-lg sm:rounded-xl flex items-center hover:shadow-2xl hover:scale-105 transition-all duration-300 border border-gray-100">
                    <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-full h-16 w-16 flex items-center justify-center flex-shrink-0 shadow-md">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <div class="ml-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Keluarga</div>
                        <div class="text-3xl font-extrabold text-gray-900">{{ $totalKeluarga }}</div>
                    </div>
                </a>
                <a href="{{ route('surat.index') }}" class="bg-white p-8 shadow-lg sm:rounded-xl flex items-center hover:shadow-2xl hover:scale-105 transition-all duration-300 border border-gray-100">
                    <div class="bg-gradient-to-br from-yellow-500 to-orange-500 text-white rounded-full h-16 w-16 flex items-center justify-center flex-shrink-0 shadow-md">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-6">
                        <div class="text-sm font-medium text-gray-500 uppercase tracking-wide">Surat Dikeluarkan (Bulan Ini)</div>
                        <div class="text-3xl font-extrabold text-gray-900">{{ $suratBulanIni }}</div>
                    </div>
                </a>
            </div>

            <!-- Charts Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                    <div class="p-8 text-gray-900 flex flex-col w-full">
                        <h3 class="font-bold text-xl mb-6 text-gray-800">Klasifikasi Jenis Kelamin</h3>
                        <div class="relative flex-grow">
                            <canvas id="genderChart" class="w-full h-64"></canvas>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                    <div class="p-8 text-gray-900 flex flex-col w-full">
                        <h3 class="font-bold text-xl mb-6 text-gray-800">Klasifikasi Kelompok Usia</h3>
                        <div class="relative flex-grow">
                            <canvas id="ageChart" class="w-full h-64"></canvas>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                    <div class="p-8 text-gray-900 flex flex-col w-full">
                        <h3 class="font-bold text-xl mb-6 text-gray-800">Klasifikasi Agama</h3>
                        <div class="relative flex-grow">
                            <canvas id="religionChart" class="w-full h-64"></canvas>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                    <div class="p-8 text-gray-900 flex flex-col w-full">
                        <h3 class="font-bold text-xl mb-6 text-gray-800">Klasifikasi Pendidikan Terakhir</h3>
                        <div class="relative flex-grow">
                            <canvas id="educationChart" class="w-full h-64"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aktivitas Surat Terbaru -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Aktivitas Surat Terbaru</h3>
                        <a href="{{ route('surat.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium hover:underline transition-colors duration-200">Lihat Semua</a>
                    </div>
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="w-full bg-white divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No. Surat</th>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Warga</th>
                                    <th class="py-4 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Keperluan</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 divide-y divide-gray-200">
                                @forelse ($riwayatTerbaru as $riwayat)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="py-4 px-6 text-sm font-mono text-gray-900">{{ $riwayat->nomor_surat }}</td>
                                    <td class="py-4 px-6 text-sm whitespace-nowrap text-gray-900">{{ $riwayat->created_at->format('d M Y') }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-900">{{ $riwayat->warga->nama_lengkap ?? 'N/A' }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-900">{{ $riwayat->keperluan }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-8 text-gray-500">Belum ada aktivitas surat.</td>
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
        Chart.defaults.font.family = "'Inter', sans-serif";
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

        // Opsi umum untuk menonaktifkan aspect ratio dan animasi smooth
        const chartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            animation: {
                duration: 1000,
                easing: 'easeOutQuart'
            }
        };

        // Diagram Jenis Kelamin (Doughnut)
        new Chart(document.getElementById('genderChart'), {
            type: 'doughnut',
            data: {
                labels: genderLabels,
                datasets: [{
                    label: 'Jumlah Warga', data: genderCounts,
                    backgroundColor: ['rgba(59, 130, 246, 0.9)', 'rgba(239, 68, 68, 0.9)'],
                    borderColor: ['#ffffff'], borderWidth: 3,
                    hoverBorderWidth: 5
                }]
            },
            options: {
                ...chartOptions,
                plugins: {
                    legend: { position: 'top', labels: { padding: 20, usePointStyle: true } },
                    datalabels: {
                        formatter: (value, ctx) => {
                            const total = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            const percentage = (value / total) * 100;
                            if (percentage < 5) return '';
                            return percentage.toFixed(1) + '%';
                        },
                        color: '#ffffff', font: { weight: 'bold', size: 14 }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0,0,0,0.8)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff'
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
                    backgroundColor: 'rgba(16, 185, 129, 0.8)',
                    borderColor: 'rgba(16, 185, 129, 1)',
                    borderWidth: 2, borderRadius: 6,
                    hoverBackgroundColor: 'rgba(16, 185, 129, 1)'
                }]
            },
            options: {
                ...chartOptions,
                scales: { 
                    y: { 
                        beginAtZero: true, 
                        ticks: { stepSize: 1 },
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    },
                    x: {
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    }
                },
                plugins: {
                    legend: { display: false },
                    datalabels: {
                        anchor: 'end', align: 'top',
                        formatter: (value) => value,
                        color: '#374151', font: { weight: 'bold' }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0,0,0,0.8)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff'
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
                        'rgba(59, 130, 246, 0.9)', 'rgba(239, 68, 68, 0.9)',
                        'rgba(16, 185, 129, 0.9)', 'rgba(245, 158, 11, 0.9)',
                        'rgba(139, 92, 246, 0.9)', 'rgba(236, 72, 153, 0.9)'
                    ],
                    borderColor: '#ffffff', borderWidth: 3,
                    hoverBorderWidth: 5
                }]
            },
            options: {
                ...chartOptions,
                plugins: {
                    legend: { position: 'top', labels: { padding: 20, usePointStyle: true } },
                    datalabels: {
                        formatter: (value, ctx) => {
                            const total = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            const percentage = (value / total) * 100;
                            return percentage > 3 ? percentage.toFixed(1) + '%' : '';
                        },
                        color: '#ffffff', font: { weight: 'bold' }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0,0,0,0.8)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff'
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
                          backgroundColor: 'rgba(245, 158, 11, 0.8)',
                          borderColor: 'rgba(245, 158, 11, 1)',
                          borderWidth: 2, borderRadius: 6,
                          hoverBackgroundColor: 'rgba(245, 158, 11, 1)'
                      }]
                  },
                  options: {
                      ...chartOptions,
                      indexAxis: 'y',
                      scales: { 
                          x: { 
                              beginAtZero: true, 
                              ticks: { stepSize: 1 },
                              grid: { color: 'rgba(0,0,0,0.05)' }
                          },
                          y: {
                              grid: { color: 'rgba(0,0,0,0.05)' }
                          }
                      },
                      plugins: {
                          legend: { display: false },
                          datalabels: {
                              anchor: 'end', align: 'right',
                              formatter: (value) => value,
                              color: '#ffffff', font: { weight: 'bold' }
                          },
                          tooltip: {
                              backgroundColor: 'rgba(0,0,0,0.8)',
                              titleColor: '#ffffff',
                              bodyColor: '#ffffff'
                          }
                      }
                  }
              });
    </script>
</x-app-layout>