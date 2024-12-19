@extends('layout')

@section('content')
    <div class="card-register">
    <div class="d-flex justify-content-center align-items-center">
        <div class="card">
            <div class="row">
                <div class="col-md-6">
                    <div class="text-center mt-5"> <img src="{{asset('assets/bogor.png')}}" width="300"> </div>
                </div>
                <div class="col-md-6">
                    <form class="form" method="POST" action="{{route('admin.register.create')}}">
                        @csrf
                        <h2>Buat Akun</h2>
                        @if ($message = Session::get('failed'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Gagal! </strong>{{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="inputbox mt-3"> 
                            <span>Nama Lengkap</span> 
                            <input type="text" placeholder="Nama Lengkap" name="name" class="form-control" value="{{old('name')}}"> 
                        </div>
                        <div class="inputbox mt-3"> 
                            <span>Username</span> 
                            <input type="text" placeholder="Username" name="username" class="form-control" value="{{old('username')}}"> 
                        </div>
                        <div class="inputbox mt-3"> 
                            <span>No. Telp</span> 
                            <input type="text" placeholder="0858--------" name="telp" class="form-control" value="{{old('telp')}}"> 
                        </div>
                        <div class="inputbox mt-3">
                            <span>Level</span> 
                            <select class="form-control" name="level">
                                <option value="ADMIN">Admin</option>
                                <option value="PETUGAS">Petugas</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{route('admin.report_table')}}" class="btn btn-secondary back mt-1">Kembali</a>
                            <button class="btn btn-success register btn-block" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection