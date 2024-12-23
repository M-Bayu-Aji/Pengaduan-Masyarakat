<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    {{-- bootstrao --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    {{-- end bootstrap --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <title>{{ $title }}</title>
</head>

<body class="bg-orange-500">
    <div class="p-4">
        <!-- Main Content -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Complaint List Section -->
            <div class="col-span-2">
                @if (Session::get('success'))
                    <div class="alert mt-2 alert-success flex justify-between">
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @yield('content')
            </div>

            <!-- Sidebar Section -->
            <div class="bg-white shadow-lg rounded-lg p-6 transition-all duration-300 hover:shadow-xl">
                <h2 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2">Informasi Pembuatan Pengaduan</h2>

                <!-- Information List -->
                <ol class="list-decimal list-inside space-y-4 text-gray-700">
                    <li class="transition-colors duration-200 hover:text-gray-900">
                        Pengaduan bisa dibuat hanya jika Anda telah membuat akun sebelumnya.
                    </li>
                    <li class="transition-colors duration-200 hover:text-gray-900">
                        Keseluruhan data pada pengaduan bernilai
                        <strong class="text-red-600">BENAR dan DAPAT DIPERTANGGUNG JAWABKAN</strong>.
                    </li>
                    <li class="transition-colors duration-200 hover:text-gray-900">
                        Seluruh bagian data perlu diisi.
                    </li>
                    <li class="transition-colors duration-200 hover:text-gray-900">
                        Pengaduan Anda akan ditanggapi dalam 2x24 Jam.
                    </li>
                    <li class="transition-colors duration-200 hover:text-gray-900">
                        Periksa tanggapan Kami pada <strong class="text-blue-600">Dashboard</strong> setelah Anda
                        <strong class="text-blue-600">Login</strong>.
                    </li>
                    <li class="transition-colors duration-200 hover:text-gray-900">
                        Pembuatan pengaduan dapat dilakukan pada halaman berikut:
                        <a href="#" class="text-blue-500 hover:text-blue-700 hover:underline">Ikuti
                            Tautan</a>.
                    </li>
                </ol>

                <!-- Navigation Links -->
                <div class="mt-8 space-y-3 border-t pt-4">
                    <a href="{{ route('welcome') }}"
                        class="block px-4 py-2 text-gray-700 rounded-md hover:bg-blue-50 hover:text-blue-600 transition-all duration-200">
                        <i class="fas fa-home mr-2"></i>Home
                    </a>
                    <a href="{{ route('report.you') }}"
                        class="block px-4 py-2 text-gray-700 rounded-md hover:bg-blue-50 hover:text-blue-600 transition-all duration-200">
                        <i class="fas fa-file-alt mr-2"></i>Laporan Saya
                    </a>
                    <a href="{{ route('report.create') }}"
                        class="block px-4 py-2 text-gray-700 rounded-md hover:bg-blue-50 hover:text-blue-600 transition-all duration-200">
                        <i class="fas fa-plus-circle mr-2"></i>Create Report
                    </a>
                    @auth
                        <a href="{{ route('logout') }}"
                            class="block px-4 py-2 text-gray-700 rounded-md hover:bg-red-50 hover:text-red-600 transition-all duration-200">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
    @stack('script')
</body>

</html>
