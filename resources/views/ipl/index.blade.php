<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Keuangan & IPL Warga') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div x-data="{ activeTab: '{{ request('tab', 'status') }}' }" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <nav class="flex space-x-4" aria-label="Tabs">
                        <button @click="activeTab = 'status'" :class="{ 'bg-blue-600 text-white shadow': activeTab === 'status', 'text-gray-500 hover:text-gray-700': activeTab !== 'status' }" class="px-3 py-2 font-medium text-sm rounded-md">
                            Status Pembayaran
                        </button>
                        <button @click="activeTab = 'laporan'" :class="{ 'bg-blue-600 text-white shadow': activeTab === 'laporan', 'text-gray-500 hover:text-gray-700': activeTab !== 'laporan' }" class="px-3 py-2 font-medium text-sm rounded-md">
                            Laporan Arus Kas
                        </button>
                    </nav>
                </div>

                <div class="p-6 text-gray-900">
                    <div x-show="activeTab === 'status'" x-transition>
                        @include('ipl.partials.status-iuran')
                    </div>
                    <div x-show="activeTab === 'laporan'" x-transition>
                        @include('ipl.partials.laporan-keuangan')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>