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
            <div class="bg-gray-50 shadow rounded-lg p-4">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Informasi Pembuatan Pengaduan</h2>
                <ol class="list-decimal list-inside space-y-2 text-gray-600">
                    <li>Pengaduan bisa dibuat hanya jika Anda telah membuat akun sebelumnya.</li>
                    <li>Keseluruhan data pada pengaduan bernilai <strong>BENAR dan DAPAT DIPERTANGGUNG
                            JAWABKAN</strong>.
                    </li>
                    <li>Seluruh bagian data perlu diisi.</li>
                    <li>Pengaduan Anda akan ditanggapi dalam 2x24 Jam.</li>
                    <li>Periksa tanggapan Kami pada <strong>Dashboard</strong> setelah Anda <strong>Login</strong>.</li>
                    <li>Pembuatan pengaduan dapat dilakukan pada halaman berikut: <a href="#"
                            class="text-blue-500 hover:underline">Ikuti Tautan</a>.</li>
                </ol>

                <div class="mt-6 space-y-2">
                    <a href="{{ route('welcome') }}" class="block text-blue-500 hover:underline">Home</a>
                    <a href="{{ route('report.you') }}" class="block text-blue-500 hover:underline">Laporan Saya</a>
                    <a href="{{ route('logout') }}" class="block text-blue-500 hover:underline">Logout</a>
                    <a href="{{ route('report.create') }}" class="block text-blue-500 hover:underline">Create
                        Report</a>
                </div>
            </div>
        </div>
    </div>
    @stack('script')
</body>

</html>
