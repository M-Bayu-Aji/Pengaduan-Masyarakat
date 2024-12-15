@extends('dashboard.templates.app')

@section('content')
    <main class="p-6 bg-gray-50 min-h-screen">
        <div class="space-y-6">
            @foreach ($reports as $index => $report)
                <div
                    class="bg-{{ $index % 2 === 0 ? 'white' : 'orange-500' }} text-{{ $index % 2 === 0 ? 'black' : 'white' }} p-6 rounded-lg shadow-md transition-transform transform hover:scale-102">
                    <div class="flex justify-between items-center mb-4">
                        <h6 class="font-semibold">
                            Pengaduan
                            {{ \Carbon\Carbon::parse($report->created_at)->locale('id')->translatedFormat('l, d F Y') }}
                        </h6>
                        <button onclick="toggleReportDetails({{ $report->id }})" class="focus:outline-none">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                    <div id="report-{{ $report->id }}" class="hidden space-y-6">
                        <nav class="flex space-x-4">
                            <button onclick="showSection('data', {{ $report->id }})"
                                class="text-sm font-medium hover:underline focus:outline-none">Data</button>
                            <button onclick="showSection('gambar', {{ $report->id }})"
                                class="text-sm font-medium hover:underline focus:outline-none">Gambar</button>
                            <button onclick="showSection('status', {{ $report->id }})"
                                class="text-sm font-medium hover:underline focus:outline-none">Status</button>
                        </nav>
                        <div id="data-{{ $report->id }}" class="hidden space-y-2">
                            <ul class="list-disc pl-6">
                                <li><strong>Tipe:</strong> {{ $report['type'] }}</li>
                                <li><strong>Lokasi:</strong> {{ $report->village }}, {{ $report->district }},
                                    {{ $report->regency }}, {{ $report->province }}</li>
                                <li><strong>Deskripsi:</strong> {{ $report['description'] }}</li>
                            </ul>
                        </div>
                        <div id="gambar-{{ $report->id }}" class="hidden flex justify-center">
                            <img src="{{ asset('images/' . $report->image) }}" alt="Gambar pengaduan"
                                class="rounded-lg shadow-lg w-full max-w-md" />
                        </div>
                        <div id="status-{{ $report->id }}" class="hidden">
                            <p>Pengaduan belum direspon petugas. Ingin menghapus pengaduan?
                                <button
                                    onclick="showModalDelete('{{ $report->id }}', '{{ \Carbon\Carbon::parse($report->created_at)->locale('id')->translatedFormat('d F Y') }}')"
                                    class="btn btn-success">Hapus</button>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

            <nav class="flex justify-center space-x-4">
                <a href="{{ route('report.you') }}"
                    class="bg-green-600 text-white px-6 py-3 rounded-lg text-sm font-medium shadow-md hover:bg-green-700">Dashboard
                    Saya</a>
                <a href="{{ route('welcome_article') }}"
                    class="bg-blue-600 text-white px-6 py-3 rounded-lg text-sm font-medium shadow-md hover:bg-blue-700">Data
                    Pengaduan</a>
                <a href="{{ route('report.create') }}"
                    class="bg-indigo-600 text-white px-6 py-3 rounded-lg text-sm font-medium shadow-md hover:bg-indigo-700">Buat
                    Pengaduan</a>
            </nav>
        </div>
    </main>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="modal-content" method="POST" action="">
                    {{-- action kosong, diisi melalui js karena id dikirim ke js nya  --}}
                    @csrf
                    {{-- menimpa method="post" jadi delete sesuai web.php http method --}}
                    @method('DELETE')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 font-bold" id="exampleModalLabel">Hapus data pengaduan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="font-medium modal-body">
                        {{-- konten dinamis pada teks ini bagian nama obat, sehingga nama obatnya disediakan tempat penyimpanan (tag b) --}}
                        <span class="font-thin font-serif">Yakin ingin menghapus data pengaduan pada tanggal</span> <b
                            id="nama_product">?</b>?
                    </div>
                    <div class="font-medium modal-footer">
                        <button type="button" class="w-1/4 bg-gray-200 text-gray-700 py-2 rounded"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit"
                            class="w-1/4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 py-2">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function showModalDelete(id, name) {
            // memasukkan teks dari parameter ke html bagian id = 'nama_product'
            $('#nama_product').text(name);
            // memanggil route hapus
            let url = "{{ route('report.delete', ':id') }}";
            // isi path dinamis : id dari data parameter id
            url = url.replace(':id', id);
            // action="" di form diisi dengan url diatas
            $('form').attr('action', url);
            // memunculkan modal dengan id='exampleModal'
            $('#exampleModal').modal('show');
        }

        function toggleReportDetails(reportId) {
            const reportElement = document.getElementById(`report-${reportId}`);
            reportElement.classList.toggle('hidden');
        }

        function showSection(section, reportId) {
            const sections = ['data', 'gambar', 'status'];
            sections.forEach(sec => {
                document.getElementById(`${sec}-${reportId}`).classList.add('hidden');
            });
            document.getElementById(`${section}-${reportId}`).classList.remove('hidden');
        }
    </script>
@endpush
