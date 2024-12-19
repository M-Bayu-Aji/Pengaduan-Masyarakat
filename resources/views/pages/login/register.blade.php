@extends('templates.app')

@section('content')
    <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-4">
        <div class="w-full bg-white rounded-lg shadow-xl p-8">
            <h2 class="text-3xl font-bold mb-6 text-center text-orange-500">Register</h2>
            <form action="{{ route('proses.register.success') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="email" class="block text-gray-700 font-medium mb-2">
                        <i class="fas fa-envelope text-orange-500 mr-2"></i>Email
                    </label>
                    <input type="email" name="email" id="email"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200"
                        required placeholder="Enter your email">
                </div>
                <div class="mb-5">
                    <label for="password" class="block text-gray-700 font-medium mb-2">
                        <i class="fas fa-lock text-orange-500 mr-2"></i>Password
                    </label>
                    <input type="password" name="password" id="password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200"
                        required placeholder="Enter your password">
                </div>
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">
                        <i class="fas fa-shield-alt text-orange-500 mr-2"></i>Confirm Password
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-200"
                        required placeholder="Confirm your password">
                </div>
                <button type="submit"
                    class="w-full bg-orange-500 text-white py-3 rounded-lg hover:bg-orange-600 transition duration-300 ease-in-out font-semibold flex items-center justify-center">
                    <i class="fas fa-user-plus mr-2"></i>
                    Register
                </button>
            </form>
            <p class="mt-6 text-center text-gray-600">
                Already have an account?
                <a href="{{ route('proses.login') }}"
                    class="text-orange-500 hover:text-orange-600 font-medium hover:underline transition duration-200">
                    Login
                </a>
            </p>
        </div>
    </div>
@endsection
