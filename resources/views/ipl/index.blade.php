<x-app-layout>
    <x-slot name="header">
        <div class="bg-white shadow-lg px-6 py-4">
            <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                {{ __('Keuangan & IPL Warga') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div x-data="{ activeTab: '{{ request('tab', 'status') }}' }" class="bg-white overflow-hidden shadow-xl sm:rounded-xl border border-gray-100">
                <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                    <nav class="flex flex-wrap space-x-2 sm:space-x-4" aria-label="Tabs">
                        <button @click="activeTab = 'status'" 
                                :class="{ 'bg-blue-600 text-white shadow-lg transform scale-105': activeTab === 'status', 'text-gray-600 hover:text-gray-800 hover:bg-gray-100 hover:shadow-md': activeTab !== 'status' }" 
                                class="px-4 py-2 font-semibold text-sm rounded-lg transition-all duration-300 ease-in-out">
                            Status Pembayaran
                        </button>
                        <button @click="activeTab = 'laporan'" 
                                :class="{ 'bg-blue-600 text-white shadow-lg transform scale-105': activeTab === 'laporan', 'text-gray-600 hover:text-gray-800 hover:bg-gray-100 hover:shadow-md': activeTab !== 'laporan' }" 
                                class="px-4 py-2 font-semibold text-sm rounded-lg transition-all duration-300 ease-in-out">
                            Laporan Arus Kas
                        </button>
                    </nav>
                </div>

                <div class="p-8 text-gray-900">
                    <div x-show="activeTab === 'status'" 
                        x-transition:enter="transition ease-out duration-300" 
                        x-transition:enter-start="opacity-0 transform translate-y-4" 
                        x-transition:enter-end="opacity-100 transform translate-y-0" 
                        x-transition:leave="transition ease-in duration-200" 
                        x-transition:leave-start="opacity-100 transform translate-y-0" 
                        x-transition:leave-end="opacity-0 transform -translate-y-4">
                        @include('ipl.partials.status-iuran')
                    </div>
                    <div x-show="activeTab === 'laporan'" 
                        x-transition:enter="transition ease-out duration-300" 
                        x-transition:enter-start="opacity-0 transform translate-y-4" 
                        x-transition:enter-end="opacity-100 transform translate-y-0" 
                        x-transition:leave="transition ease-in duration-200" 
                        x-transition:leave-start="opacity-100 transform translate-y-0" 
                        x-transition:leave-end="opacity-0 transform -translate-y-4">
                        @include('ipl.partials.laporan-keuangan')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>