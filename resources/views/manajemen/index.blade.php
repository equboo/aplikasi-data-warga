<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Warga & Keluarga') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div x-data="{ activeTab: '{{ request('tab', 'warga') }}' }" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <nav class="flex space-x-2 sm:space-x-4" aria-label="Tabs">
                        <button @click="activeTab = 'warga'" 
                                :class="{ 'bg-blue-600 text-white shadow': activeTab === 'warga', 'text-gray-500 hover:text-gray-700 hover:bg-gray-100': activeTab !== 'warga' }" 
                                class="px-3 py-2 font-medium text-sm rounded-md transition-colors">
                            Data Warga
                        </button>
                        <button @click="activeTab = 'keluarga'" 
                                :class="{ 'bg-blue-600 text-white shadow': activeTab === 'keluarga', 'text-gray-500 hover:text-gray-700 hover:bg-gray-100': activeTab !== 'keluarga' }" 
                                class="px-3 py-2 font-medium text-sm rounded-md transition-colors">
                            Data Keluarga
                        </button>
                        <button @click="activeTab = 'tambah'" 
                                :class="{ 'bg-blue-600 text-white shadow': activeTab === 'tambah', 'text-gray-500 hover:text-gray-700 hover:bg-gray-100': activeTab !== 'tambah' }" 
                                class="px-3 py-2 font-medium text-sm rounded-md transition-colors">
                            + Tambah Keluarga
                        </button>
                    </nav>
                </div>

                <div class="p-6 text-gray-900">
                    <div x-show="activeTab === 'warga'" x-transition:enter.duration.300ms x-transition:leave.duration.200ms>
                        @include('manajemen.partials.data-warga')
                    </div>

                    <div x-show="activeTab === 'keluarga'" x-transition:enter.duration.300ms x-transition:leave.duration.200ms>
                        @include('manajemen.partials.data-keluarga')
                    </div>

                    <div x-show="activeTab === 'tambah'" x-transition:enter.duration.300ms x-transition:leave.duration.200ms>
                        @include('manajemen.partials.tambah-keluarga')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>