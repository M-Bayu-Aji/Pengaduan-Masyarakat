@extends('pages.templates_article.app')

@section('content')
    <div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Search Section -->
        <div class="p-6 mb-8 bg-white rounded-lg shadow-sm">
            <div class="max-w-3xl mx-auto">
                <form action="{{ route('reports.search') }}" method="GET" id="search-form" class="flex gap-4">
                    <select id="province-select" name="province"
                        class="flex-1 px-4 py-2 transition-all border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Provinsi</option>
                    </select>
                    <button type="submit"
                        class="flex items-center gap-2 px-6 py-2 text-white transition-all duration-300 bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                        <i class="fas fa-search"></i>
                        Cari
                    </button>
                </form>
            </div>
        </div>

        <!-- Complaint List -->
        <div id="complaint-list" class="space-y-6">
            @foreach ($reports as $report)
                <div class="p-6 transition-all duration-300 bg-white shadow-sm rounded-xl hover:shadow-md">
                    <div class="flex items-start gap-6">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('images/' . $report->image) }}" alt="Complaint Image"
                                class="object-cover w-32 h-32 rounded-lg shadow-sm">
                        </div>
                        <div class="flex-1">
                            <a href="{{ route('viewer', $report['id']) }}"
                                class="block mb-2 text-xl font-semibold text-gray-800 transition-colors duration-300 hover:text-blue-600">
                                {{ strlen($report['description']) > 50 ? substr($report['description'], 0, 50) . '...' : $report['description'] }}
                            </a>
                            <div class="flex items-center gap-3 mb-3 text-sm text-gray-500">
                                <span class="flex items-center gap-2">
                                    <i class="text-gray-400 fas fa-eye"></i>
                                    {{ number_format($report['viewers']) }} viewers
                                </span>
                                    <div><i class="fas fa-heart"></i> {{ is_array(json_decode($report->voting)) ? count(json_decode($report->voting)) : 0 }}</div>
                                    <div><i class="fas fa-comment"></i> {{ count($report->comments) }}</div>
                            </div>
                            <div class="space-y-1">
                                <p class="flex items-center gap-2 text-sm text-gray-600">
                                    <i class="text-gray-400 fas fa-user"></i>
                                    {{ $report->user->email }}
                                </p>
                                <p class="flex items-center gap-2 text-xs text-gray-400">
                                    <i class="fas fa-clock"></i>
                                    {{ \Carbon\Carbon::parse($report->created_at)->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <a class="btn btn-light btn-sm float-end" href="{{ route('report.vote', $report->id) }}">
                                <i class="fas fa-heart"></i> <br>Vote
                            </a>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            let provinces = [];

            $.ajax({
                url: "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json",
                method: "GET",
                dataType: "json",
                success: function(data) {
                    provinces = data;
                    let select = $('#province-select');
                    data.forEach(function(province) {
                        select.append(new Option(province.name, province.name));
                    });
                },
                error: function() {
                    console.error("Gagal memuat data provinsi");
                }
            });

            setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 5000);
        });
    </script>
@endpush
