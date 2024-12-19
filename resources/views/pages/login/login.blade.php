@extends('templates.app')

@section('content')
    <!-- Login Section -->
    <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8">
        <div class="w-full max-w-md bg-white shadow-2xl rounded-xl p-8">
            @if (Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <h2 class="text-3xl font-bold mb-6 text-center text-orange-500">Login</h2>
            
            <form action="{{ route('proses.login.success') }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label for="email" class="text-gray-700 font-semibold">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </span>
                        <input type="email" name="email" id="email" 
                            class="py-2 pl-10 w-full rounded-lg border-gray-300 focus:border-orange-500 outline-none focus:ring focus:ring-orange-200" 
                            placeholder="Enter your email" required>
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="password" class="text-gray-700 font-semibold">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-lock text-gray-400"></i>
                        </span>
                        <input type="password" name="password" id="password" 
                            class=" py-2 pl-10 w-full rounded-lg border-gray-300 focus:border-orange-500 outline-none focus:ring focus:ring-orange-200" 
                            placeholder="Enter your password" required>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-2">
                    <button type="submit" 
                        class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg transition duration-300 ease-in-out flex items-center space-x-2">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login</span>
                    </button>
                    <a href="{{ route('proses.register') }}" 
                        class="text-orange-500 hover:text-orange-600 hover:underline transition duration-300">
                        Create an account
                    </a>
                </div>
            </form>
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
