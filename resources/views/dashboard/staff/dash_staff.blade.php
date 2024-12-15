@extends('dashboard.templates.app')

@section('content')
    <div class="container mx-auto bg-white shadow-md rounded-lg overflow-hidden mt-2.5">
        <div class="flex justify-between items-center p-4">
            <h2 class="text-lg font-semibold">Table Example</h2>
            <button class="bg-green-700 text-white px-4 py-2 rounded-md flex items-center">
                Export (.xlsx)
                <i class="fas fa-caret-down ml-2"></i>
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="w-full bg-gray-100 border-b">
                        <th class="py-2 px-4 text-left">Gambar &amp; Pengirim</th>
                        <th class="py-2 px-4 text-left">Lokasi &amp; Tanggal</th>
                        <th class="py-2 px-4 text-left">Deskripsi</th>
                        <th class="py-2 px-4 text-left">
                            Jumlah Vote
                            <button onclick="sortTable('asc')">
                                <i class="fas fa-arrow-up"></i>
                            </button>
                            <button onclick="sortTable('desc')">
                                <i class="fas fa-arrow-down"></i>
                            </button>
                        </th>
                        <th class="py-2 px-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        @foreach ($reports as $report)
                            <td class="py-2 px-4 hover:bg-gray-100 flex items-center">
                                <button onclick="showModalDelete('{{ asset('images/' . $report->image) }}')">
                                    <img alt="Profile picture of the sender" class="rounded-full w-14 mr-2" height=""
                                        src="{{ asset('images/' . $report->image) }}" />
                                </button>
                                <span class="text-blue-400 underline">{{ $report->user->email }}</span>
                            </td>
                            <td class="py-2 px-4 hover:bg-gray-100">
                                <div></div>
                                <div class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($report->created_at)->locale('id')->translatedFormat('l, d F Y') }}
                                </div>
                            </td>
                            <td class="py-2 px-4 hover:bg-gray-100">{{ $report->description }}</td>
                            <td class="py-2 px-4 hover:bg-gray-100">{{ $report->voting }}</td>
                            <td class="py-2 px-4 hover:bg-gray-100">
                                <div class="relative">
                                    <button onclick="toggleActionMenu({{ $report->id }})"
                                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md flex items-center">
                                        Aksi
                                        <i class="fas fa-caret-down ml-2"></i>
                                    </button>
                                </div>
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div id="action-menu-{{ $report->id }}"
        class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg hidden">
        <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Tindak
            Lanjut</a>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="modal-content" method="POST" action="">
                    {{-- action kosong, diisi melalui js karena id dikirim ke js nya  --}}
                    @csrf
                    {{-- menimpa method="post" jadi delete sesuai web.php http method --}}
                    @method('DELETE')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 font-bold" id="exampleModalLabel">Detail Gambar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="font-medium modal-footer">
                        <img id="image" src="{{ asset('images/' . $report->image) }}" alt="Gambar pengaduan"
                            class="rounded-lg shadow-lg w-full max-w-md" />
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

        function toggleActionMenu(reportId) {
            const menu = document.getElementById(`action-menu-${reportId}`);
            menu.classList.toggle('hidden');
        }
    </script>
@endpush
