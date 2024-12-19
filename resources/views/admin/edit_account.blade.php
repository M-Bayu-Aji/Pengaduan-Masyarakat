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
                    <form class="form" method="post" action="{{route('admin.register.update', $data['id'])}}">
                        @method('PATCH')
                        @csrf
                        <h2>Edit Akun</h2>
                        <div class="inputbox mt-3"> 
                            <span>Nama Lengkap</span> 
                            <input type="text" placeholder="Nama Lengkap" name="name" class="form-control" value="{{$data['name']}}"> 
                        </div>
                        <div class="inputbox mt-3"> 
                            <span>Username</span> 
                            <input type="text" placeholder="Username" name="username" class="form-control" value="{{$data['username']}}"> 
                        </div>
                        <div class="inputbox mt-3"> 
                            <span>No. Telp</span> 
                            <input type="text" placeholder="0858--------" name="telp" class="form-control" value="{{$data['telp']}}"> 
                        </div>
                        <div class="inputbox mt-3">
                            <span>Level</span> 
                            <select class="form-control" name="level">
                                <option value="ADMIN" {{ $data['level'] == 'ADMIN' ? 'selected' : ''}}>Admin</option>
                                <option value="PETUGAS" {{ $data['level'] == 'PETUGAS' ? 'selected' : ''}}>Petugas</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{route('admin.report_table')}}" class="btn btn-secondary back mt-1">Kembali</a>
                            <button class="btn btn-success register btn-block" type="submit">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection