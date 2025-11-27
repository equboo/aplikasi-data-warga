<x-app-layout>
    <x-slot name="header">
        <div class="bg-white shadow-lg px-6 py-4">
            <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                {{ __('Manajemen Warga & Keluarga') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div x-data="{ activeTab: '{{ request('tab', 'warga') }}' }" class="bg-white overflow-hidden shadow-xl sm:rounded-xl border border-gray-100">
                <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                    <nav class="flex flex-wrap space-x-2 sm:space-x-4" aria-label="Tabs">
                        <button @click="activeTab = 'warga'" 
                                :class="{ 'bg-blue-600 text-white shadow-lg transform scale-105': activeTab === 'warga', 'text-gray-600 hover:text-gray-800 hover:bg-gray-100 hover:shadow-md': activeTab !== 'warga' }" 
                                class="px-4 py-2 font-semibold text-sm rounded-lg transition-all duration-300 ease-in-out">
                            Data Warga
                        </button>
                        <button @click="activeTab = 'keluarga'" 
                                :class="{ 'bg-blue-600 text-white shadow-lg transform scale-105': activeTab === 'keluarga', 'text-gray-600 hover:text-gray-800 hover:bg-gray-100 hover:shadow-md': activeTab !== 'keluarga' }" 
                                class="px-4 py-2 font-semibold text-sm rounded-lg transition-all duration-300 ease-in-out">
                            Data Keluarga
                        </button>
                        <button @click="activeTab = 'tambah'" 
                                :class="{ 'bg-green-600 text-white shadow-lg transform scale-105': activeTab === 'tambah', 'text-gray-600 hover:text-gray-800 hover:bg-gray-100 hover:shadow-md': activeTab !== 'tambah' }" 
                                class="px-4 py-2 font-semibold text-sm rounded-lg transition-all duration-300 ease-in-out">
                            + Tambah Keluarga
                        </button>
                    </nav>
                </div>

                <div class="p-8 text-gray-900">
                    <div x-show="activeTab === 'warga'" 
                         x-transition:enter="transition ease-out duration-300" 
                         x-transition:enter-start="opacity-0 transform translate-y-4" 
                         x-transition:enter-end="opacity-100 transform translate-y-0" 
                         x-transition:leave="transition ease-in duration-200" 
                         x-transition:leave-start="opacity-100 transform translate-y-0" 
                         x-transition:leave-end="opacity-0 transform -translate-y-4">
                        @include('manajemen.partials.data-warga')
                    </div>

                    <div x-show="activeTab === 'keluarga'" 
                         x-transition:enter="transition ease-out duration-300" 
                         x-transition:enter-start="opacity-0 transform translate-y-4" 
                         x-transition:enter-end="opacity-100 transform translate-y-0" 
                         x-transition:leave="transition ease-in duration-200" 
                         x-transition:leave-start="opacity-100 transform translate-y-0" 
                         x-transition:leave-end="opacity-0 transform -translate-y-4">
                        @include('manajemen.partials.data-keluarga')
                    </div>

                    <div x-show="activeTab === 'tambah'" 
                         x-transition:enter="transition ease-out duration-300" 
                         x-transition:enter-start="opacity-0 transform translate-y-4" 
                         x-transition:enter-end="opacity-100 transform translate-y-0" 
                         x-transition:leave="transition ease-in duration-200" 
                         x-transition:leave-start="opacity-100 transform translate-y-0" 
                         x-transition:leave-end="opacity-0 transform -translate-y-4">
                        @include('manajemen.partials.tambah-keluarga')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>