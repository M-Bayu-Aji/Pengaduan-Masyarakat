@extends('templates.app')

@section('content')
    <div class="w-full md:w-2/3 p-4">
        <div class="bg-white shadow-2xl rounded-xl p-8">
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <strong class="font-bold">Terjadi kesalahan!</strong>
                    </div>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-orange-600">
                    <i class="fas fa-edit mr-2"></i>Buat Pengaduan
                </h1>
                <p class="text-gray-600">Silakan isi form pengaduan di bawah ini</p>
            </div>

            <form method="POST" action="{{ route('report.proses') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Location Selection Group -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-map-marker-alt text-orange-600 mr-1"></i> Provinsi
                        </label>
                        <select id="province" name="province" class="form-select">
                            <option value="" disabled hidden selected>Pilih Provinsi</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-city text-orange-600 mr-1"></i> Kota/Kabupaten
                        </label>
                        <select id="regency" name="regency" class="form-select" disabled>
                            <option value="" disabled hidden selected>Pilih Kota</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-building text-orange-600 mr-1"></i> Kecamatan
                        </label>
                        <select id="district" name="district" class="form-select" disabled>
                            <option value="" disabled hidden selected>Pilih Kecamatan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-home text-orange-600 mr-1"></i> Kelurahan
                        </label>
                        <select id="village" name="village" class="form-select" disabled>
                            <option value="" disabled hidden selected>Pilih Kelurahan</option>
                        </select>
                    </div>
                </div>

                <!-- Report Type -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-tags text-orange-600 mr-1"></i> Tipe Pengaduan
                    </label>
                    <select id="type" name="type" class="form-select">
                        <option value="" disabled hidden selected>Pilih Tipe</option>
                        <option value="kejahatan" {{ old('type') == 'kejahatan' ? 'selected' : '' }}>Kejahatan</option>
                        <option value="pembangunan" {{ old('type') == 'pembangunan' ? 'selected' : '' }}>Pembangunan
                        </option>
                        <option value="sosial" {{ old('type') == 'sosial' ? 'selected' : '' }}>Sosial</option>
                    </select>
                </div>

                <!-- Description -->
                <div class="flex flex-col">
                    <label class="form-label">
                        <i class="fas fa-comment-alt text-orange-600 mr-1"></i> Detail Keluhan :
                    </label>
                    <textarea id="description" name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                </div>

                <!-- Image Upload -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-image text-orange-600 mr-1"></i> Gambar Pendukung
                    </label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-3"></i>
                            <div class="flex text-sm text-gray-600">
                                <label for="image"
                                    class="relative cursor-pointer bg-white rounded-md font-medium text-orange-600 hover:text-orange-500">
                                    <span>Upload file</span>
                                    <input id="image" name="image" type="file" class="sr-only">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statement Checkbox -->
                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="statement" name="statement"
                        class="w-4 h-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500">
                    <label for="statement" class="text-sm text-gray-700">
                        Saya menyatakan bahwa laporan yang disampaikan sesuai dengan kebenaran
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="submit-button" disabled
                    class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 px-4 rounded-lg
                       flex items-center justify-center space-x-2 transition duration-300 ease-in-out
                       disabled:opacity-50 disabled:cursor-not-allowed">
                    <i class="fas fa-paper-plane"></i>
                    <span>Kirim Pengaduan</span>
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