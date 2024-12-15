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

<body class="bg-gray-100">
    <header class="bg-white shadow-md p-4 flex justify-between items-center">
        <div class="flex items-center">
            <i class="fas fa-globe text-2xl">
            </i>
            <span class="ml-2 text-lg font-semibold">
                @if (auth()->user()->role == 'head_staff')
                    <a href="{{ route('head.staff.account') }}" class="no-underline text-gray-500 hover:text-black hover:underline font-bold">Kelola Akun</a>
                @else
                    Pengaduan
                @endif
            </span>
        </div>
        <form action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-gray-200 text-gray-800 px-4 py-2 rounded">
                Logout
            </button>
        </form>
    </header>
    @yield('content')

    @stack('script')
</body>

</html>
