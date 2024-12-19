@extends('dashboard.templates.app')

@section('content')
    <div class="max-w-5xl mx-auto my-3">
        <div class="bg-white rounded-2xl shadow-xl p-8 space-y-8">
            <!-- Header Section -->
            @if (Session::get('success'))
                <div class="alert flex justify-between alert-success">
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="flex justify-between items-center">
                <div class="space-y-3">
                    <h1 class="text-2xl font-bold text-gray-800 tracking-tight">
                        {{ $reports->user->email }}
                    </h1>
                    <div class="text-gray-600 flex items-center gap-3 text-sm">
                        <span class="text-gray-700">
                            {{ \Carbon\Carbon::parse($reports->created_at)->locale('id')->translatedFormat('l, d F Y') }}
                        </span>
                        <span class="text-gray-400">•</span>
                        <div class="flex items-center gap-2">
                            <span class="font-medium">Status tanggapan:</span>
                            <span
                                class="bg-green-500 text-white px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wide">
                                {{ $reports->responses->response_status }}
                            </span>
                        </div>
                    </div>
                </div>
                <a href="{{ route('staff.report') }}"
                    class="no-underline bg-green-800 hover:bg-green-700 active:bg-green-900 transition-colors duration-200 text-white px-6 py-2.5 rounded-lg font-medium shadow-sm">
                    Kembali
                </a>
            </div>

            <!-- Report Content Section -->
            <div class="bg-gray-50 rounded-xl p-8 space-y-6">
                <h2 class="font-bold text-xl text-gray-800">
                    {{ implode(', ', [$reports->village, $reports->district, $reports->regency, $reports->province]) }}
                </h2>
                <p class="text-gray-700 leading-relaxed">
                    {{ $reports->description }}
                </p>
                <img src="{{ asset('images/' . $reports->image) }}"
                    alt="Aerial view of a construction site with green landscape in the background"
                    class="rounded-xl shadow-md object-cover w-1/2 hover:shadow-lg transition-shadow duration-300" />
            </div>

            <!-- Status Section -->
            @if ($progress->count() > 0)
                <div class="flex flex-col space-y-6">
                    @foreach ($progress as $progres)
                        @if($progres->response_id == $reports->responses->id)
                            <div class="flex items-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-4 h-4 bg-teal-800 rounded-full"></div>
                                    @if (!$loop->last)
                                        <div class="w-1 h-12 bg-teal-800"></div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <button
                                        onclick="showModalDelete('{{ $progres->id }}', 
                                                    '{{ \Carbon\Carbon::parse($progres->created_at)->locale('id')->translatedFormat('d F Y') }}')"
                                        class="text-yellow-600 underline">{{ \Carbon\Carbon::parse($progres->created_at)->locale('id')->translatedFormat('l, d F Y') }}</button>
                                    <span>: {{ $progres->history['history'] }}</span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 italic text-sm border-l-4 border-gray-200 pl-4">
                    Belum ada riwayat progress perbaikan/penyelesaian apapun
                </p>
            @endif

            <!-- Action Buttons -->
            <div class="flex justify-end items-center space-x-4">
                <form action="{{ route('staff.done.progress', $reports['id']) }}" method="POST" class="">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center px-6 py-2.5 rounded-lg
                               bg-green-600 hover:bg-green-700 active:bg-green-800
                               text-white font-medium shadow-sm
                               transition duration-200 ease-in-out
                               focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2
                               transform hover:scale-[1.02]">
                        <i class="fas fa-check-circle mr-2"></i>
                        Nyatakan Selesai
                    </button>
                </form>

                <form>
                    <button type="button"
                        class="inline-flex items-center px-6 py-2.5 rounded-lg
                               bg-gray-100 hover:bg-gray-200 active:bg-gray-300
                               text-gray-700 font-medium shadow-sm
                               transition duration-200 ease-in-out
                               focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2
                               transform hover:scale-[1.02]"
                        data-bs-toggle="modal" data-bs-target="#addProgressModal">
                        <i class="fas fa-plus-circle mr-2"></i>
                        Tambah Progres
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Progress -->
    <div class="modal fade" id="addProgressModal" tabindex="-1" aria-labelledby="addProgressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-white rounded-xl shadow-2xl border-0">
                <div class="modal-header bg-gray-50 flex items-center justify-between p-4 border-b">
                    <h1 class="modal-title text-xl font-bold text-gray-800" id="addProgressModalLabel">
                        <i class="fas fa-tasks mr-2 text-green-500"></i>
                        Tambah Progress Penanganan
                    </h1>
                    <button type="button" class="text-gray-400 hover:text-gray-600 transition-colors duration-200"
                        data-bs-dismiss="modal">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <div class="modal-body p-6">
                    <form action="{{ route('staff.addProgress') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="space-y-2">
                            <label class="block text-gray-700 font-semibold" for="progress">
                                Deskripsi Progress
                            </label>
                            <input type="hidden" name="report_id" value="{{ $reports->id }}">
                            <textarea id="progress" name="history" rows="5"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none transition-all duration-200 resize-none"
                                placeholder="Tuliskan detail progress penanganan..."></textarea>
                        </div>
                        <div class="flex justify-end space-x-3 pt-4">
                            <button type="button"
                                class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors duration-200"
                                data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors duration-200 flex items-center">
                                <i class="fas fa-save mr-2"></i>
                                Simpan Progress
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content rounded-xl shadow-2xl" method="POST" action="">
                @csrf
                @method('DELETE')

                <div class="modal-header border-b p-6">
                    <h1 class="modal-title text-xl font-bold text-gray-800">Hapus data progress</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-6">
                    <p class="text-gray-600">
                        Yakin ingin menghapus data progres pada tanggal <b id="nama_product">?</b>?
                    </p>
                </div>

                <div class="modal-footer border-t p-6 flex justify-end space-x-4">
                    <button type="button"
                        class="px-6 py-2 rounded-lg bg-gray-200 text-gray-700 transition-colors hover:bg-gray-300"
                        data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-2 rounded-lg bg-red-500 text-white transition-all duration-200 
                           hover:bg-red-600 ">
                        Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    function showModalDelete(id, name) {
        $('#nama_product').text(name);
        let url = "{{ route('staff.delete.progress', ':id') }}".replace(':id', id);
        $('form').attr('action', url);
        $('#exampleModal').modal('show');
    }

    // Alert auto-close
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 5000);
</script>
