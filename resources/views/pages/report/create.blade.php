@extends('templates.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white shadow-lg rounded-lg w-full max-w-xl p-6">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Terjadi kesalahan!</strong>
                    <span class="block sm:inline">Silakan periksa kembali inputan Anda.</span>
                    <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h1 class="text-2xl font-bold text-orange-600 mb-4">Keluhan</h1>
            <form method="POST" action="{{ route('report.proses') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="province" class="block text-sm font-medium text-gray-700">Provinsi*</label>
                    <select id="province" name="province" class="form-control">
                        <option value="" disabled hidden selected>Pilih</option>
                    </select>
                </div>

                <div>
                    <label for="regency" class="block text-sm font-medium text-gray-700">Kota/Kabupaten*</label>
                    <select id="regency" name="regency" class="form-control" disabled>
                        <option value="" disabled hidden selected>Pilih</option>
                    </select>
                </div>

                <div>
                    <label for="district" class="block text-sm font-medium text-gray-700">Kecamatan*</label>
                    <select id="district" name="district" class="form-control" disabled>
                        <option value="" disabled hidden selected>Pilih</option>
                    </select>
                </div>

                <div>
                    <label for="village" class="block text-sm font-medium text-gray-700">Kelurahan*</label>
                    <select id="village" name="village" class="form-control" disabled>
                        <option value="" disabled hidden selected>Pilih</option>
                    </select>
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Tipe*</label>
                    <select id="type" name="type" class="form-control">
                        <option value="" disabled hidden selected>Pilih</option>
                        <option value="kejahatan" {{ old('type') == 'kejahatan' ? 'selected' : '' }}>Kejahatan</option>
                        <option value="pembangunan" {{ old('type') == 'pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                        <option value="sosial" {{ old('type') == 'sosial' ? 'selected' : '' }}>Sosial</option>
                    </select>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Detail Keluhan*</label>
                    <textarea id="description" name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Gambar Pendukung*</label>
                    <input type="file" id="image" name="image" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer focus:outline-none">
                </div>

                <div class="flex items-start">
                    <input id="statement" name="statement" type="checkbox" class="h-4 w-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500">
                    <label for="statement" class="ml-2 text-sm text-gray-700">
                        Laporan yang disampaikan sesuai dengan kebenaran.
                    </label>
                </div>

                <button type="submit" id="submit-button" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-no-drop" disabled>
                    Kirim
                </button>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Load provinces
            $.ajax({
                url: 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json',
                method: 'GET',
                success: function(data) {
                    data.forEach(function(province) {
                        $('#province').append(
                            `<option value="${province.id}">${province.name}</option>`);
                    });
                }
            });

            // Load regencies when province changes
            $('#province').change(function() {
                const provinceId = $(this).val();
                $('#regency').empty().append('<option value="">Pilih</option>').prop('disabled', true);
                $('#district').empty().append('<option value="">Pilih</option>').prop('disabled', true);
                $('#village').empty().append('<option value="">Pilih</option>').prop('disabled', true);

                if (provinceId) {
                    $.ajax({
                        url: `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`,
                        method: 'GET',
                        success: function(data) {
                            data.forEach(function(regency) {
                                $('#regency').append(
                                    `<option value="${regency.id}">${regency.name}</option>`
                                );
                            });
                            $('#regency').prop('disabled', false);
                        }
                    });
                }
            });

            // Load districts when regency changes
            $('#regency').change(function() {
                const regencyId = $(this).val();
                $('#district').empty().append('<option value="">Pilih</option>').prop('disabled', true);
                $('#village').empty().append('<option value="">Pilih</option>').prop('disabled', true);

                if (regencyId) {
                    $.ajax({
                        url: `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${regencyId}.json`,
                        method: 'GET',
                        success: function(data) {
                            data.forEach(function(district) {
                                $('#district').append(
                                    `<option value="${district.id}">${district.name}</option>`
                                );
                            });
                            $('#district').prop('disabled', false);
                        }
                    });
                }
            });

            // Load villages when district changes
            $('#district').change(function() {
                const districtId = $(this).val();
                $('#village').empty().append('<option value="">Pilih</option>').prop('disabled', true);

                if (districtId) {
                    $.ajax({
                        url: `https://www.emsifa.com/api-wilayah-indonesia/api/villages/${districtId}.json`,
                        method: 'GET',
                        success: function(data) {
                            data.forEach(function(village) {
                                $('#village').append(
                                    `<option value="${village.id}">${village.name}</option>`
                                );
                            });
                            $('#village').prop('disabled', false);
                        }
                    });
                }
            });

            // Enable/disable submit button based on checkbox
            $('#statement').change(function() {
                $('#submit-button').prop('disabled', !this.checked);
            });
        });
    </script>
@endpush