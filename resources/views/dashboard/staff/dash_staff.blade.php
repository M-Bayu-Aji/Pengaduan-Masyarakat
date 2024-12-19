@extends('dashboard.templates.app')

@section('content')
    <div class="container mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-4">
        {{-- Header Section --}}
        <div class="flex justify-between items-center p-6 border-b">
            <h2 class="text-2xl font-bold text-gray-800">Table Example</h2>
            <div class="flex flex-col">
                <button
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-lg flex items-center transition duration-300">
                    <span>Export (.xlsx)</span>
                    <i class="fas fa-caret-down ml-2"></i>
                </button>
                <div class="relative inline-block">
                    <div id="exportDropdown"
                        class="hidden absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-100 overflow-hidden">
                        <div class="py-2">
                            <form action="{{ route('staff.export') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition duration-150 no-underline">
                                    <i class="fas fa-file-export mr-2"></i>
                                    Seluruh Data
                                </button>
                            </form>
                            <button class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition duration-150"
                                data-bs-toggle="modal" data-bs-target="#fileModal">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                Berdasarkan Tanggal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="py-3 px-6 text-left text-sm font-semibold text-gray-700">Gambar &amp; Pengirim</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold text-gray-700">Lokasi &amp; Tanggal</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold text-gray-700">Deskripsi</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold text-gray-700">
                            <div class="flex items-center">
                                <span>Jumlah Vote</span>
                                <div class="ml-2 flex flex-col">
                                    <button onclick="sortTable('asc')" class="hover:text-green-600">
                                        <i class="fas fa-arrow-up text-xs"></i>
                                    </button>
                                    <button onclick="sortTable('desc')" class="hover:text-green-600">
                                        <i class="fas fa-arrow-down text-xs"></i>
                                    </button>
                                </div>
                            </div>
                        </th>
                        <th class="py-3 px-6 text-left text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($reports->where('province', auth()->user()->staffProvince->province) as $report)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <button onclick="showModalImage('{{ asset('images/' . $report->image) }}')"
                                        class="focus:outline-none">
                                        <img alt="Profile picture"
                                            class="h-14 rounded-full object-cover border-2 border-gray-200"
                                            src="{{ asset('images/' . $report->image) }}" />
                                    </button>
                                    <a href="mailto:{{ $report->user->email }}"
                                        class="ml-4 text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        {{ $report->user->email }}
                                    </a>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="text-gray-900 font-medium">{{ $report->province }}</div>
                                <div class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($report->created_at)->locale('id')->translatedFormat('l, d F Y') }}
                                </div>
                            </td>
                            <td class="py-4 px-6 text-gray-800">{{ $report->description }}</td>
                            <td class="py-4 px-6 text-gray-800">
                                {{ is_array(json_decode($report->voting)) ? count(json_decode($report->voting)) : 0 }}
                            </td>
                            <td class="py-4 px-6">
                                <div class="relative">
                                    <button onclick="toggleActionMenu({{ $report->id }})"
                                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg flex items-center transition duration-150">
                                        <span>Aksi</span>
                                        <i class="fas fa-caret-down ml-2"></i>
                                    </button>
                                    <div id="actionMenu{{ $report->id }}"
                                        class="hidden absolute right-0 mt-1 w-48 bg-white rounded-lg shadow border border-gray-100">
                                        <button
                                            onclick="showModalTindakLanjut('{{ $report->id }}', '{{ $report->description }}')"
                                            class="block relative px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition duration-150 no-underline">
                                            <i class="fas fa-check-circle mr-2"></i>
                                            Tindak Lanjut
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal --}}

    {{-- modal detail gambar --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-lg shadow-xl">
                <div class="modal-header flex justify-between border-b p-4">
                    <h1 class="modal-title text-xl font-bold" id="exampleModalLabel">Detail Gambar</h1>
                    <button type="button" class="text-gray-400 hover:text-gray-500" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body p-6">
                    <!-- Gambar di modal -->
                    <img id="modalImage" src="" alt="Gambar pengaduan"
                        class="rounded-lg shadow-md w-1/2 max-w-3xl mx-auto" />
                    <div class="flex justify-end mt-4">
                        <button type="button" data-bs-dismiss="modal" aria-label="Close"
                            class="bg-gray-200 text-gray-800 px-4 py-2 rounded">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tindak Lanjut --}}
    <div class="modal fade" id="modalResponses" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-lg shadow-xl">
                <form method="POST" action="">
                    @csrf
                    <div class="modal-header flex justify-between items-center p-4 border-b">
                        <h1 class="modal-title text-xl font-bold" id="exampleModalLabel">Tindak Lanjut Laporan</h1>
                        <button type="button" class="text-gray-400 hover:text-gray-600" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body p-6">
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2" for="responses">Status Tindak
                                Lanjut</label>
                            <select id="responses" name="responses" class="form-control">
                                <option value="" selected disabled>Pilih status</option>
                                <option value="REJECTED">Tolak</option>
                                <option value="ON_PROCESS">Proses Penyelesaian/Perbaikan</option>
                            </select>
                        </div>
                        <p class="text-sm text-gray-900 mb-4">Laporan : <span id="nama_product"
                                class="font-medium"></span></p>
                    </div>
                    <div class="modal-footer flex justify-end space-x-3 border-t">
                        <button type="button" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300"
                            data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal input with type file --}}
    <div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-white rounded-xl shadow-2xl border-0">
                <div class="modal-header bg-gray-50 flex items-center justify-between p-5 border-b">
                    <h1 class="modal-title text-xl font-bold text-gray-800" id="fileModalLabel">
                        <i class="fas fa-file-upload mr-2 text-blue-500"></i>
                        Export Berdasarkan Tanggal
                    </h1>
                    <button type="button" class="text-gray-400 hover:text-gray-600 transition-colors duration-200"
                        data-bs-dismiss="modal">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <div class="modal-body p-6">
                    <form action="{{ route('staff.export') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="space-y-2">
                            <label class="block text-gray-700 font-semibold" for="date_range">
                                Pilih Tanggal
                            </label>
                            <div class="grid grid-cols-1 gap-4">
                                <div class="relative">
                                    <input type="date" id="date" name="date"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition-all duration-200">
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-3 pt-4">
                            <button type="button"
                                class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors duration-200"
                                data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200 flex items-center">
                                <i class="fas fa-file-export mr-2"></i>
                                Export Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function showModalImage(imageUrl) {
            // Set src gambar di modal sesuai gambar yang diklik    
            document.getElementById('modalImage').src = imageUrl;

            // Tampilkan modal
            $('#exampleModal').modal('show');
        }

        function showModalTindakLanjut(id, name) {
            // memasukkan teks dari parameter ke html bagian id = 'nama_product'
            $('#nama_product').text(name);
            // memanggil route hapus
            let url = "{{ route('staff.response', ':id') }}";
            // isi path dinamis : id dari data parameter id
            url = url.replace(':id', id);
            // action="" di form diisi dengan url diatas
            $('form').attr('action', url);
            // memunculkan modal dengan id='exampleModal'
            $('#modalResponses').modal('show');
        }

        // showModalCalendar
        document.addEventListener('DOMContentLoaded', function() {
            // Tidak diperlukan konfigurasi tambahan; Bootstrap handle secara otomatis melalui atribut data-bs-*
            console.log("Modal siap digunakan.");
        });

        // button export
        document.querySelector('.bg-green-600').addEventListener('click', function() {
            document.getElementById('exportDropdown').classList.toggle('hidden');
        });

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.bg-green-600') && !e.target.closest('#exportDropdown')) {
                document.getElementById('exportDropdown').classList.add('hidden');
            }
        });

        function toggleActionMenu(reportId) {
            const menu = document.getElementById(`actionMenu${reportId}`);
            menu.classList.toggle('hidden');

            document.querySelectorAll('[id^="actionMenu"]').forEach(function(element) {
                if (element.id !== `actionMenu${reportId}` && !element.classList.contains('hidden')) {
                    element.classList.add('hidden');
                }
            });

            document.addEventListener('click', function(e) {
                if (!e.target.closest(`#actionMenu${reportId}`) && !e.target.closest('button')) {
                    menu.classList.add('hidden');
                }
            });
        }

        function sortTable(order) {
            let rows = Array.from(document.getElementsByTagName('tbody')[0].rows);
            let voteIndex = 3;

            rows.sort((a, b) => {
                let aValue = parseInt(a.cells[voteIndex].textContent.trim());
                let bValue = parseInt(b.cells[voteIndex].textContent.trim());
                return order === 'desc' ? aValue - bValue : bValue - aValue;
            });

            let tbody = document.getElementsByTagName('tbody')[0];
            rows.forEach(row => tbody.appendChild(row));
        }
    </script>
@endpush
