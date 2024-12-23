<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <title>{{ $title }}</title>
</head>

<body class="bg-orange-500">
    <main class="flex flex-col md:flex-row items-center justify-center min-h-screen">
        <!-- Left Content Section -->
        @yield('content')

        <!-- Right Image Section -->
        @if (!Route::is('report.create'))
            <div class="w-full md:w-2/3 h-screen relative overflow-hidden bg-white shadow-2xl">
                <img class="w-full h-full object-cover opacity-50 transition-opacity duration-300 hover:opacity-40"
                    src="https://storage.googleapis.com/a1aa/image/skXnOaDgJjaqNF4LFgCdrTqP6XM9xoIpldFy9g2qfSwu9f5TA.jpg"
                    alt="Aerial view of a city street" />
        @endif
        @if (Route::is('proses.login'))
            <div class="absolute inset-0 flex items-center justify-center backdrop-blur-sm">
                <h1 class="text-4xl font-bold text-orange-500 bg-white/80 px-10 py-6 rounded-xl shadow-2xl">
                    Please Login First!
                </h1>
            </div>
        @elseif(Route::is('proses.register'))
            <div class="absolute inset-0 flex items-center justify-center backdrop-blur-sm">
                <h1 class="text-4xl font-bold text-orange-500 bg-white/80 px-10 py-6 rounded-xl shadow-2xl">
                    Form Register
                </h1>
            </div>
        @endif
        </div>
    </main>
    @stack('script')
</body>

</html>
