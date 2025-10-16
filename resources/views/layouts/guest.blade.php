<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">
            
            <div class="hidden lg:flex flex-col justify-center items-start p-12 bg-gradient-to-br from-gray-800 to-gray-900 text-white relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-full bg-cover opacity-10" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxNDQwIDMyMCI+PHBhdGggZmlsbD0iI2ZmZmZmZiIgZmlsbC1vcGFjaXR5PSIxIiBkPSJNMCAyMjRsNDggMTZjNDggMTYgMTQ0IDQ4IDI0MCA0OGM5NiAwIDE5Mi0zMiAyODgtNjRzMTkyLTY0IDI4OC02NGM5NiAwIDE5MiAzMiAyODggNjRzMTkyIDY0IDI0MCA4MGM0OCAxNiA5NiAxNiAxNDQgMTZsNDgtMTZMMTQ0MCAzMjBWMGgtNDhjLTE2IDAtOTYgMC0xNDQgMGMtNDggMC05NiAwLTE0NCAwcy05NiAwLTE0NCAwYy00OCAwLTk2IDAtMTQ0IDBzLTk2IDAtMTQ0IDBjLTQ4IDAtOTYgMC0xNDQgMHMtOTYgMC0xNDQgMGMtNDggMC05NiAwLTE0NCAwcy05NiAwLTE0NCAwYy00OCAwLTk2IDAtMTQ0IDBjLTQ4IDAtOTYgMC0xNDQgMHMtOTYgMC0xNDQgMGMtNDggMC05NiAwLTE0NCAwcy05NiAwLTE0NCAwYy00OCAwLTk2IDAtMTQ0IDBIMFYyMjR6Ij48L3BhdGg+PC9zdmc+');"></div>
                
                <div class="z-10">
                    <h1 class="text-5xl font-bold tracking-tight">
                        Sistem Informasi Warga
                    </h1>
                    <p class="text-2xl text-gray-300 mt-3">
                        RT.06 / RW.07 Villa Padurenan Indah 2
                    </p>
                    <p class="text-md text-gray-400 mt-6 max-w-lg">
                        Selamat datang kembali. Silakan masuk untuk mengelola data kependudukan, informasi keluarga, dan fitur administrasi lainnya secara efisien.
                    </p>
                </div>
            </div>

            <div class="min-h-screen flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-100">
                <div class="w-full max-w-md">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900">
                            Admin Login
                        </h2>
                        <p class="mt-2 text-md text-gray-600">
                            Silakan masuk untuk melanjutkan
                        </p>
                    </div>
                    
                    <div class="bg-white shadow-xl rounded-lg px-8 py-10">
                        {{ $slot }}
                    </div>

                    <div class="text-center mt-8">
                        <p class="text-sm text-gray-500">
                            &copy; {{ date('Y') }} RT.06 / RW.07 Villa Padurenan Indah 2
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>