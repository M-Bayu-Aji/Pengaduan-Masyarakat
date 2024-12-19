@extends('templates.app')

@section('content')
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
@endsection
