@extends('templates.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-orange-500">
        <div class=" w-full h-full">
            <div class="absolute inset-0 flex">
                <div class="w-1/2 p-10 flex flex-col justify-center">
                    <h1 class="text-4xl font-bold text-white mb-4">
                        Pengaduan Masyarakat
                    </h1>
                    <p class="text-white mb-6">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eligendi perspiciatis aut pariatur
                        doloremque laborum quis in praesentium at, recusandae obcaecati dicta accusantium delectus
                        asperiores illum minima veritatis iure quidem amet rerum fugit quaerat illo!
                    </p>
                    <a href="{{ route('proses.login') }}"
                        class="no-underline hover:underline text-center bg-green-700 text-white py-2 px-4 rounded">
                        BERGABUNG!
                    </a>
                </div>
                <div class="w-1/2 relative">
                    <img alt="Aerial view of a city street with cars and trees" class="w-full h-full object-cover opacity-50"
                        height="600"
                        src="https://storage.googleapis.com/a1aa/image/skXnOaDgJjaqNF4LFgCdrTqP6XM9xoIpldFy9g2qfSwu9f5TA.jpg"
                        width="800" />
                    <div class="absolute inset-0 flex flex-col justify-center items-end space-y-4">
                        <a href="{{ route('report.you') }}" class="no-underline hover:underline bg-green-700 text-white p-4 rounded-full">
                            <i class="fas fa-user"></i> Dashboard saya
                        </a>
                        <a href="{{ route('welcome_article') }}" class="no-underline hover:underline bg-green-700 text-white p-4 rounded-full">
                            <i class="fas fa-exclamation"></i> Data pengaduan
                        </a>
                        <a href="{{ route('report.create') }}"
                            class="no-underline hover:underline bg-green-700 text-white p-4 rounded-full">
                            <i class="fas fa-pen"></i> Buat pengaduan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
