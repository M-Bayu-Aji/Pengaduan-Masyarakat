@extends('templates.app')

@section('content')
    <div class="flex items-center justify-center w-full min-h-screen px-4 py-12">
        <div class="w-full">
            <!-- Main Content Card -->
            <div class="p-12 border shadow-2xl bg-white/10 backdrop-blur-lg rounded-3xl border-white/20 md:p-16">
                <!-- Header Section -->
                <div class="mb-12 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 mb-6 bg-green-600 rounded-full shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h1 class="mb-4 text-5xl font-bold tracking-tight text-white md:text-6xl">
                        Pengaduan
                        <span class="block text-green-400">Masyarakat</span>
                    </h1>
                    <div class="w-24 h-1 mx-auto bg-green-500 rounded-full"></div>
                </div>

                <!-- Description Section -->
                <div class="mb-12">
                    <p class="max-w-3xl mx-auto text-xl leading-relaxed text-center md:text-2xl text-white/90">
                        Platform modern untuk melaporkan masalah lingkungan dan kejadian di sekitar Anda.
                        <span class="font-semibold text-green-300">Bersama kita ciptakan lingkungan yang lebih aman dan nyaman.</span>
                    </p>
                </div>

                <!-- Features Grid -->
                <div class="grid gap-8 mb-12 md:grid-cols-3">
                    <div class="text-center group">
                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 transition-transform duration-300 bg-green-600 shadow-lg rounded-2xl group-hover:scale-110">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-lg font-semibold text-white">Laporan Cepat</h3>
                        <p class="text-sm text-white/70">Kirim laporan dengan mudah dan cepat</p>
                    </div>

                    <div class="text-center group">
                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 transition-transform duration-300 bg-green-600 shadow-lg rounded-2xl group-hover:scale-110">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-lg font-semibold text-white">Bukti Visual</h3>
                        <p class="text-sm text-white/70">Lampirkan foto sebagai bukti laporan</p>
                    </div>

                    <div class="text-center group">
                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 transition-transform duration-300 bg-green-600 shadow-lg rounded-2xl group-hover:scale-110">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-lg font-semibold text-white">Respons Cepat</h3>
                        <p class="text-sm text-white/70">Tindak lanjut dari pihak berwenang</p>
                    </div>
                </div>

                <!-- CTA Button -->
                <div class="text-center">
                    <a href="{{ route('proses.login') }}"
                        class="inline-flex items-center px-8 py-4 text-lg font-semibold text-white transition-all duration-300 transform shadow-xl bg-gradient-to-r from-green-600 to-green-700 rounded-2xl hover:from-green-700 hover:to-green-800 hover:scale-105 hover:shadow-2xl">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        BERGABUNG SEKARANG
                    </a>
                    <p class="mt-4 text-sm text-white/60">Bergabunglah dengan ribuan warga yang peduli</p>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="grid grid-cols-2 gap-6 mt-12 md:grid-cols-4">
                <div class="text-center">
                    <div class="mb-2 text-3xl font-bold text-white">1000+</div>
                    <div class="text-sm text-white/70">Laporan Masuk</div>
                </div>
                <div class="text-center">
                    <div class="mb-2 text-3xl font-bold text-white">500+</div>
                    <div class="text-sm text-white/70">Masalah Terselesaikan</div>
                </div>
                <div class="text-center">
                    <div class="mb-2 text-3xl font-bold text-white">50+</div>
                    <div class="text-sm text-white/70">Staff Aktif</div>
                </div>
                <div class="text-center">
                    <div class="mb-2 text-3xl font-bold text-white">24/7</div>
                    <div class="text-sm text-white/70">Monitoring</div>
                </div>
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
        .hover\:shadow-2xl:hover {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
    </style>
@endsection
