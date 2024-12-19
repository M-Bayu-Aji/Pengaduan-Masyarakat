@extends('dashboard.templates.app')

@section('content')
    <main class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 p-8">
        <div class="max-w-6xl mx-auto space-y-8">
            {{-- Reports List --}}
            @if (Session::get('success'))
                <div class="alert flex justify-between alert-success">
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @foreach ($reports->where('user_id', auth()->id()) as $index => $report)
                <div class="transform transition-all duration-300 hover:scale-102">
                    <div
                        class="rounded-xl shadow overflow-hidden 
                    {{ $index % 2 === 0
                        ? 'bg-white text-gray-800 border border-gray-100'
                        : 'bg-gradient-to-r from-orange-500 to-orange-600 text-white' }}">

                        {{-- Report Header --}}
                        <div class="flex items-center justify-between p-6 border-b border-opacity-20">
                            <h6 class="text-lg font-semibold tracking-wide">
                                <i class="fas fa-file-alt mr-2"></i>
                                Pengaduan
                                {{ \Carbon\Carbon::parse($report->created_at)->locale('id')->translatedFormat('l, d F Y') }}
                            </h6>
                            <button onclick="toggleReportDetails({{ $report->id }})"
                                class="transition-all duration-200 hover:scale-110 focus:outline-none 
                                   transform hover:rotate-180">
                                <i class="fas fa-chevron-down"></i>
                            </button>
                        </div>

                        {{-- Report Content --}}
                        <div id="report-{{ $report->id }}" class="hidden">
                            {{-- Navigation Tabs --}}
                            <div class="px-6 pt-4">
                                <nav class="flex space-x-8 border-b border-opacity-20">
                                    @foreach (['data', 'gambar', 'status'] as $tab)
                                        <button onclick="showSection('{{ $tab }}', {{ $report->id }})"
                                            class="tab-button pb-3 text-sm font-medium capitalize transition-all 
                                               hover:text-opacity-75 relative">
                                            <span>{{ $tab }}</span>
                                            <div
                                                class="absolute bottom-0 left-0 w-full h-0.5 bg-current transform scale-x-0 
                                                    transition-transform origin-left hover:scale-x-100">
                                            </div>
                                        </button>
                                    @endforeach
                                </nav>
                            </div>

                            {{-- Content Sections --}}
                            <div class="p-6">
                                {{-- Data Section --}}
                                <div id="data-{{ $report->id }}" class="hidden space-y-4">
                                    <ul class="list-none space-y-3">
                                        <li class="flex items-start">
                                            <span class="font-semibold w-24">Tipe:</span>
                                            <span>{{ $report['type'] }}</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="font-semibold w-24">Lokasi:</span>
                                            <span>{{ implode(', ', [$report->village, $report->district, $report->regency, $report->province]) }}</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="font-semibold w-24">Deskripsi:</span>
                                            <span>{{ $report['description'] }}</span>
                                        </li>
                                    </ul>
                                </div>

                                {{-- Image Section --}}
                                <div id="gambar-{{ $report->id }}" class="hidden">
                                    <div class="flex justify-center">
                                        <img src="{{ asset('images/' . $report->image) }}" alt="Gambar pengaduan"
                                            class="max-w-2xl rounded-lg shadow-xl w-full transition-all duration-300 
                                                hover:scale-105 hover:shadow-2xl" />
                                    </div>
                                </div>

                                {{-- Status Section --}}
                                <div id="status-{{ $report->id }}" class="hidden">
                                    <div
                                        class="flex items-center gap-3 p-4 rounded-lg bg-opacity-10 backdrop-filter backdrop-blur-sm">
                                        @if ($report->responses()->exists())
                                            <div class="flex items-center space-x-4">
                                                <span class="text-sm font-medium">Pengaduan telah ditanggapi, Dengan status
                                                    Pengaduan :</span>
                                            </div>
                                            <span
                                                class="px-4 py-2 rounded-full text-sm font-semibold 
                                                {{ $index % 2 === 0 ? 'bg-orange-100 text-orange-600' : 'bg-white/20 text-white' }}
                                                shadow-sm transition-all duration-300 hover:shadow-md">
                                                {{ $report->responses->response_status }}
                                            </span>
                                        @else
                                            <div class="flex items-center space-x-2">
                                                <i class="fas fa-clock text-lg opacity-75"></i>
                                                <span class="text-sm font-medium">Pengaduan belum direspon petugas</span>
                                            </div>
                                            <button
                                                onclick="showModalDelete('{{ $report->id }}', 
                                                '{{ \Carbon\Carbon::parse($report->created_at)->locale('id')->translatedFormat('d F Y') }}')"
                                                class="group flex items-center px-4 py-2 rounded-lg bg-red-500 text-white
                                                    transition-all duration-300 hover:bg-red-600 transform hover:scale-105 hover:shadow">
                                                <i class="fas fa-trash-alt mr-2 group-hover:animate-bounce"></i>
                                                <span class="text-sm font-medium">Hapus</span>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Progress Timeline Section --}}
                        <div class="p-6 border-t border-opacity-20">
                            @foreach ($progress as $progres)
                                @if ($report->responses && $progres->response_id == $report->responses->id)
                                    <div class="flex items-start space-x-4 mb-4 last:mb-0">
                                        {{-- Timeline Indicator --}}
                                        <div class="flex flex-col items-center">
                                            <div class="w-4 h-4 rounded-full bg-teal-600 shadow-lg 
                                                        transform transition-all duration-300 hover:scale-125"></div>
                                            @if (!$loop->last)
                                                <div class="w-0.5 h-16 bg-gradient-to-b from-teal-600 to-teal-400 mt-1"></div>
                                            @endif
                                        </div>

                                        {{-- Progress Content --}}
                                        <div class="flex-1 bg-white/10 backdrop-blur-sm rounded-lg p-4 
                                                    shadow-lg transform transition-all duration-300 hover:shadow-xl">
                                            <button class="text-amber-400 hover:text-amber-300 font-medium mb-1 
                                                         transition-colors duration-200">
                                                {{ \Carbon\Carbon::parse($progres->created_at)->locale('id')->translatedFormat('l, d F Y') }}
                                            </button>
                                            <p class="text-sm leading-relaxed opacity-90">
                                                {{ $progres->history['history'] }}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Navigation Buttons --}}
            <nav class="flex justify-center space-x-6 pt-8">
                @foreach ([['route' => 'welcome_article', 'text' => 'Data Pengaduan', 'color' => 'blue'], ['route' => 'report.create', 'text' => 'Buat Pengaduan', 'color' => 'orange']] as $button)
                    <a href="{{ route($button['route']) }}"
                        class="rounded-lg bg-{{ $button['color'] }}-600 px-6 py-3 text-sm font-medium text-white 
                           shadow transition-all duration-200 hover:bg-{{ $button['color'] }}-700 
                           hover:shadow-xl transform hover:-translate-y-1">
                        {{ $button['text'] }}
                    </a>
                @endforeach
            </nav>
        </div>
    </main>

    {{-- Delete Modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content rounded-xl shadow-2xl" method="POST" action="">
                @csrf
                @method('DELETE')

                <div class="modal-header border-b p-6">
                    <h1 class="modal-title text-xl font-bold text-gray-800">Hapus data pengaduan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-6">
                    <p class="text-gray-600">
                        Yakin ingin menghapus data pengaduan pada tanggal <b id="nama_product">?</b>?
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
                           hover:bg-red-600 transform hover:scale-105">
                        Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        function showModalDelete(id, name) {
            $('#nama_product').text(name);
            let url = "{{ route('report.delete', ':id') }}".replace(':id', id);
            $('form').attr('action', url);
            $('#exampleModal').modal('show');
        }

        function toggleReportDetails(reportId) {
            $(`#report-${reportId}`).slideToggle(300);
        }

        function showSection(section, reportId) {
            ['data', 'gambar', 'status'].forEach(sec => {
                $(`#${sec}-${reportId}`).fadeOut(200);
            });
            setTimeout(() => {
                $(`#${section}-${reportId}`).fadeIn(200);
            }, 200);
        }

        $(document).ready(function() {
            @foreach ($reports->where('user_id', auth()->id()) as $report)
                $('.hidden#data-{{ $report->id }}').removeClass('hidden');
            @endforeach
        });

        // Alert auto-close
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 5000);
    </script>
@endpush
