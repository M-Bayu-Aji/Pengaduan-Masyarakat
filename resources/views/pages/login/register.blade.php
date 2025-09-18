@extends('templates.app')

@section('content')
    <!-- Register Section -->
    <div class="flex flex-col items-center justify-center w-full p-8 lg:w-1/2">
        <div class="w-full max-w-md">
            <!-- Main Register Card -->
            <div class="overflow-hidden border shadow-2xl bg-white/95 backdrop-blur-lg rounded-3xl border-white/20">
                <!-- Header Section -->
                <div class="relative p-8 overflow-hidden text-center bg-gradient-to-r from-orange-500 to-orange-600">
                    <div class="absolute inset-0 bg-black/10"></div>
                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-16 h-16 mb-4 rounded-full bg-white/20 backdrop-blur-sm animate-pulse">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                        </div>
                        <h2 class="mb-2 text-3xl font-bold tracking-tight text-white">Create Account</h2>
                        <p class="text-sm font-medium text-orange-100">Join our community today</p>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="p-8 bg-gradient-to-b from-white to-orange-50/30">
                    @if (Session::get('success'))
                        <div class="p-4 mb-6 border border-green-200 alert alert-success alert-dismissible fade show bg-green-50 rounded-xl" role="alert">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-green-800">{{ Session::get('success') }}</span>
                            </div>
                            <button type="button" class="ml-auto btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('proses.register.success') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Email Input Group -->
                        <div class="space-y-3">
                            <label for="email" class="block text-sm font-semibold tracking-wide text-gray-700">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                    Email Address
                                </span>
                            </label>
                            <div class="relative group">
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    class="w-full px-4 py-3 text-sm text-gray-700 transition-all duration-200 ease-in-out border-2 border-gray-200 outline-none rounded-xl focus:border-orange-500 focus:ring-4 focus:ring-orange-100 hover:border-gray-300 bg-gray-50 focus:bg-white"
                                    placeholder="Enter your email address" required>
                                <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-orange-500 group-focus-within:w-full transition-all duration-300"></div>
                            </div>
                            @error('email')
                                <div class="flex items-center space-x-2 text-xs text-red-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- Password Input Group -->
                        <div class="space-y-3">
                            <label for="password" class="block text-sm font-semibold tracking-wide text-gray-700">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    Password
                                </span>
                            </label>
                            <div class="relative group">
                                <input type="password" name="password" id="password"
                                    class="w-full px-4 py-3 text-sm text-gray-700 transition-all duration-200 ease-in-out border-2 border-gray-200 outline-none rounded-xl focus:border-orange-500 focus:ring-4 focus:ring-orange-100 hover:border-gray-300 bg-gray-50 focus:bg-white"
                                    placeholder="Create a strong password" required>
                                <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-orange-500 group-focus-within:w-full transition-all duration-300"></div>
                            </div>
                            @error('password')
                                <div class="flex items-center space-x-2 text-xs text-red-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- Confirm Password Input Group -->
                        <div class="space-y-3">
                            <label for="password_confirmation" class="block text-sm font-semibold tracking-wide text-gray-700">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    Confirm Password
                                </span>
                            </label>
                            <div class="relative group">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="w-full px-4 py-3 text-sm text-gray-700 transition-all duration-200 ease-in-out border-2 border-gray-200 outline-none rounded-xl focus:border-orange-500 focus:ring-4 focus:ring-orange-100 hover:border-gray-300 bg-gray-50 focus:bg-white"
                                    placeholder="Confirm your password" required>
                                <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-orange-500 group-focus-within:w-full transition-all duration-300"></div>
                            </div>
                            @error('password_confirmation')
                                <div class="flex items-center space-x-2 text-xs text-red-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- Password Strength Indicator -->
                        <div class="hidden password-strength">
                            <div class="mb-2 text-xs text-gray-600">Password Strength:</div>
                            <div class="flex space-x-1">
                                <div class="flex-1 h-2 transition-all duration-300 bg-gray-200 rounded-full"></div>
                                <div class="flex-1 h-2 transition-all duration-300 bg-gray-200 rounded-full"></div>
                                <div class="flex-1 h-2 transition-all duration-300 bg-gray-200 rounded-full"></div>
                                <div class="flex-1 h-2 transition-all duration-300 bg-gray-200 rounded-full"></div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="pt-4 space-y-4">
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700
                                       text-white py-3 px-6 rounded-xl font-semibold text-sm
                                       transform hover:scale-[1.02] active:scale-[0.98]
                                       transition-all duration-200 ease-in-out
                                       shadow-lg hover:shadow-xl
                                       flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                <span>Create Account</span>
                            </button>

                            <div class="text-center">
                                <p class="text-sm text-gray-600">
                                    Already have an account?
                                    <a href="{{ route('proses.login') }}"
                                        class="inline-flex items-center text-sm font-medium text-orange-600 transition-all duration-200 hover:text-orange-700 hover:underline">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                        </svg>
                                        Sign In
                                    </a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Footer Text -->
            <div class="mt-8 text-center">
                <p class="text-sm font-medium text-white/80">
                    Join thousands of users on
                    <span class="font-bold text-orange-300">Pengaduan Masyarakat</span>
                </p>
            </div>
        </div>
    </div>

    <style>
        .backdrop-blur-lg {
            backdrop-filter: blur(16px);
        }
        .shadow-2xl {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .hover\:shadow-xl:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        .animate-shake {
            animation: shake 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        /* Custom scrollbar for webkit browsers */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(255, 165, 0, 0.5);
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 165, 0, 0.7);
        }
    </style>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        // Alert auto-close with animation
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 5000);

        // Password strength indicator
        $('#password').on('input', function() {
            const password = $(this).val();
            const strengthBars = $('.password-strength div');
            $('.password-strength').removeClass('hidden');

            let strength = 0;
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            strengthBars.each(function(index) {
                if (index < strength) {
                    $(this).removeClass('bg-gray-200 bg-red-400 bg-yellow-400 bg-blue-400').addClass(
                        strength <= 2 ? 'bg-red-400' :
                        strength <= 3 ? 'bg-yellow-400' :
                        strength <= 4 ? 'bg-blue-400' : 'bg-green-400'
                    );
                } else {
                    $(this).removeClass('bg-red-400 bg-yellow-400 bg-blue-400 bg-green-400').addClass('bg-gray-200');
                }
            });
        });

        // Enhanced form validation feedback
        $('input').on('blur', function() {
            const input = $(this);
            const value = input.val();

            if (value && input[0].checkValidity()) {
                input.addClass('border-green-500 focus:border-green-500 focus:ring-green-100');
                input.removeClass('border-red-500 focus:border-red-500 focus:ring-red-100');
            } else if (value && !input[0].checkValidity()) {
                input.addClass('border-red-500 focus:border-red-500 focus:ring-red-100');
                input.removeClass('border-green-500 focus:border-green-500 focus:ring-green-100');
            }
        });

        // Real-time password confirmation validation
        $('#password_confirmation').on('input', function() {
            const confirmPassword = $(this).val();
            const password = $('#password').val();

            if (confirmPassword && password) {
                if (confirmPassword === password) {
                    $(this).addClass('border-green-500 focus:border-green-500 focus:ring-green-100');
                    $(this).removeClass('border-red-500 focus:border-red-500 focus:ring-red-100');
                } else {
                    $(this).addClass('border-red-500 focus:border-red-500 focus:ring-red-100');
                    $(this).removeClass('border-green-500 focus:border-green-500 focus:ring-green-100');
                }
            }
        });

        // Smooth scroll for better UX
        $('a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            const target = $(this.getAttribute('href'));
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 500);
            }
        });

        // Add keyboard navigation enhancement
        $('input').on('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const inputs = $('input');
                const currentIndex = inputs.index(this);
                if (currentIndex < inputs.length - 1) {
                    inputs.eq(currentIndex + 1).focus();
                } else {
                    $('button[type="submit"]').focus();
                }
            }
        });
    </script>
@endpush
