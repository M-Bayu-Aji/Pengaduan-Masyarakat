@extends('layout')

@section('content')
    <div class="px-3 py-4">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>Berhasil! </strong>{{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="d-flex justify-content-between mb-4">
            <div></div>
            <div>
                <a href="{{route('admin.report_table')}}" class="btn btn-secondary mr-2">Kembali</a>
                <a href="{{route('admin.users.export')}}" target="_blank" class="btn btn-primary mr-2">Cetak Laporan</a>
                <a href="{{route('admin.register')}}" class="btn btn-success">Buat Akun</a>
            </div>
        </div>
        <table class="table table-bordered pt-4 mb-4 table-striped" id="myTable">
            <thead>
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Telp</th>
                    <th scope="col">Username</th>
                    <th scope="col">Level</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($data as $dt)
                <tr>
                    <th>{{$no++}}</th>
                    <td class="text-capitalize">{{$dt['name']}}</td>
                    <td>{{$dt['telp']}}</td>
                    <td>{{$dt['username']}}</td>
                    <td>{{$dt['level']}}</td>
                    <td>
                        <a href="{{route('admin.register.edit', $dt['id'])}}"><span class="badge badge-primary p-2 mt-1">Edit</span></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection