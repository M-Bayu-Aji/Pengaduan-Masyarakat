@extends('templates.app')

@section('content')
    <div class="h-screen flex flex-col lg:flex-row bg-orange-500">
        <!-- Login Section -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center bg-white p-8 rounded-lg shadow-lg m-4">
            <div class="w-full max-w-sm shadow p-5">
                @if (Session::get('success'))
                    <div class="alert mt-2 alert-success flex justify-between">
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Login</h2>
                <form action="{{ route('proses.login.success') }}" method="POST" class="w-full max-w-sm">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium">Email :</label>
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="Enter your email" required>
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 font-medium">Password :</label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Enter your password" required>
                    </div>
                    <div class="flex justify-between items-center">
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">
                            Login
                        </button>
                        <a href="{{ route('proses.register') }}" class="text-blue-500 hover:underline">
                            Create an account
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Image Section -->
        <div class="w-full lg:w-1/2 relative overflow-hidden shadow-lg">
            <img src="https://storage.googleapis.com/a1aa/image/skXnOaDgJjaqNF4LFgCdrTqP6XM9xoIpldFy9g2qfSwu9f5TA.jpg"
                alt="Aerial view of a city street with cars and trees" class="w-full h-full object-cover opacity-50">
            <div class="absolute inset-0 flex flex-col justify-center items-end space-y-4">
                <button class="bg-green-700 text-white p-4 rounded-full shadow hover:bg-green-800 transition duration-300">
                    <i class="fas fa-home"></i>
                </button>
                <button class="bg-green-700 text-white p-4 rounded-full shadow hover:bg-green-800 transition duration-300">
                    <i class="fas fa-exclamation"></i>
                </button>
                <a href="{{ route('report.create') }}"
                    class="no-underline hover:underline bg-green-700 text-white p-4 rounded-full">
                    <i class="fas fa-pen"></i> Buat pengaduan
                </a>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        // Alert auto-close
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 5000);
    </script>
@endpush
