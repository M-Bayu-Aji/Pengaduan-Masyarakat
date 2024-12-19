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
        <div class="w-full md:w-2/3 h-full relative bg-white">
            <img class="object-cover opacity-50" 
                 src="https://storage.googleapis.com/a1aa/image/skXnOaDgJjaqNF4LFgCdrTqP6XM9xoIpldFy9g2qfSwu9f5TA.jpg" 
                 alt="Aerial view of a city street">
            
            <!-- Navigation Buttons -->
            <nav class="absolute inset-0 flex flex-col justify-center items-end space-y-4">
                <a href="{{ route('report.you') }}" 
                   class="nav-button bg-orange-500 hover:bg-orange-600 no-underline hover:underline text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300 ease-in-out flex items-center space-x-3 w-48">
                    <i class="fas fa-user"></i>
                    <span>Dashboard saya</span>
                </a>
                <a href="{{ route('welcome_article') }}" 
                   class="nav-button bg-orange-500 hover:bg-orange-600 no-underline hover:underline text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300 ease-in-out flex items-center space-x-3 w-48">
                    <i class="fas fa-exclamation"></i>
                    <span>Data pengaduan</span>
                </a>
                <a href="{{ route('report.create') }}" 
                   class="nav-button bg-orange-500 hover:bg-orange-600 no-underline hover:underline text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300 ease-in-out flex items-center space-x-3 w-48">
                    <i class="fas fa-pen"></i>
                    <span>Buat pengaduan</span>
                </a>
            </nav>
        </div>
    </main>
    @stack('script')
</body>
</html>
