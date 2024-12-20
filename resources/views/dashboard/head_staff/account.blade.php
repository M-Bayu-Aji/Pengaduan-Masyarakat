@extends('dashboard.templates.app')

@section('content')
    <div class="container mx-auto bg-white mt-2.5 p-4">
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Left Section -->
            <div class="w-full lg:w-1/2">
                <h1 class="text-xl font-bold mb-4">Akun Staff Daerah {{ $province }}</h1>
                @if (Session::get('success'))
                    <div class="alert flex justify-between alert-success">
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <table class="min-w-full bg-white border rounded">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">#</th>
                            <th class="py-2 px-4 border-b">Email</th>
                            <th class="py-2 px-4 border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($accounts->where('staffProvince.province', auth()->user()->staffProvince->province) as $account)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
                                <td class="py-2 px-4 border-b">{{ $account['email'] }}</td>
                                <td class="py-2 px-4 border-b">
                                    <div class="flex space-x-2">
                                        <form action="{{ route('head.staff.reset', $account['id']) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                    class="transition-all duration-300 ease-in-out bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                                <i class="fas fa-redo-alt mr-1"></i> Reset
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('head.staff.delete', $account['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="transition-all duration-300 ease-in-out bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">
                                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Right Section -->
            <div class="w-full lg:w-1/2">
                <h1 class="text-xl font-bold mb-4">Buat Akun Staff</h1>
                <form action="{{ route('head.staff.create.acc') }}" method="POST" class="bg-white p-6 rounded shadow-md">
                    @csrf
                    <input type="hidden" name="role" value="staff">
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">Email</label>
                        <input type="email" id="email"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                            name="email" placeholder="Email">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700">Sandi</label>
                        <input type="password" id="password"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                            placeholder="Sandi" name="password">
                    </div>
                    <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded">Buat</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        // Alert auto-close
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 5000);
    </script>
@endpush
