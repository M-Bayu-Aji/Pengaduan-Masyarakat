@extends('pages.templates_article.app')

@section('content')
    <div class="flex flex-col rounded w-full ">
        <div class="bg-white mb-2.5 rounded-lg p-4 w-full mx-auto">
            <img alt="A densely populated urban area with many small houses and buildings" class="rounded-lg"
                src="{{ asset('images/' . $report->image) }}" width="30%" />
            <div class="ml-4">
                <p class="text-gray-600">
                    {{ \Carbon\Carbon::parse($report->created_at)->locale('id')->translatedFormat('l, d F Y') }}
                </p>
                <p class="text-gray-800 mt-2">
                    {{ $report->description }}
                </p>
                <button class="mt-4 bg-yellow-500 text-white py-2 px-4 rounded">
                    {{ $report->type }}
                </button>
            </div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-md w-full">
            @foreach ($comments as $comment)
                @if ($comment->report_id == $report->id)
                    <p>{{ $comment->user->email }}</p>
                    <p>{{ \Carbon\Carbon::parse($comment->created_at)->locale('id')->translatedFormat('l, d F Y') }}</p>
                    <p>{{ $comment->comment }}</p>
                @endif
            @endforeach
            <form action="{{ route('report.comment_proses') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $report->id }}">
                <div class="flex items-start space-x-4">
                    <i class="fas fa-user text-xl mt-2"></i>
                    <textarea class="flex-1 border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4"
                        name="comment" placeholder="Komentar" required></textarea>
                </div>
                <div class="flex justify-between items-center mt-2">
                    <a href="{{ route('welcome_article') }}" class="bg-gray-100 text-blue-700 px-4 py-2 rounded-lg no-underline hover:underline hover:bg-gray-200">Kembali</a>
                    <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800">Buat
                        Komentar</button>
                </div>
            </form>

        </div>
    </div>
@endsection
