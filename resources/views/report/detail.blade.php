@extends('layout')

@section('content')
    <div class="px-3 py-4 detail-page">
            <div class="w-100 px-0">
                @if ($message = Session::get('success'))
                   <div class="alert alert-success">
                        <strong>Berhasil! </strong>{{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                   </div>
                @endif
                <div class="container-fluid rounded-0 border-0 mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            @if (auth()->user())
                            @if (auth()->user()->level === 'PETUGAS')
                            <div class="alert alert-warning">
                                <div class="mb-3 d-flex justify-content-between">
                                    <strong>Perbarui Status</strong>
                                    <a href="{{route('admin.report_table')}}" class="text-dark">kembali</a>
                                </div>
                                <form action="{{route('report.update', $data['id'])}}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <select class="form-control" name="status">
                                            <option value="0" {{ $data['status'] === 0 ? 'selected' : ''}}>Belum Terdapat Tindakan</option>
                                            <option value="Proses" {{ $data['status'] == 'Proses' ? 'selected' : ''}}>Proses</option>
                                            <option value="Selesai" {{ $data['status'] == 'Selesai' ? 'selected' : ''}}>Selesai</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-warning btn-block">Perbarui</button>
                                </form>
                            </div>
                            @endif
                            @endif
                            <div class="card rounded-0 border-0 card1">
                                <div class="row justify-content-center">
                                    <div class="col-md-12 col-10">
                                        <h2 class="title-card">feedback tidak</h2>
                                    </div>
                                    <div class="col-md-12 col-10">
                                        <h2 class="title-card-two">relevan?</h2>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-md-12 col-10">
                                        <h2 class="email-text">hubungi email kami</h2>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <p id="instore">aspirasi.kabbogor@gmail.com</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 bg-white">
                            <div class="card card-report p-3 w-100">
                                <div class="info d-flex justify-content-between align-items-center">
                                    <div class="group d-flex flex-column"> 
                                        <span class="font-weight-bold">{{$data['citizen']['name']}}</span> 
                                        <small>{{$data['date']}}</small> 
                                    </div>
                                </div>
                                <div class="card p-2 mt-3 card-message px-4 text-white py-4">
                                    <div class="info d-flex justify-content-between align-items-center">
                                        <div class="group d-flex flex-column">
                                            <span>{{$data['message']}}</span> 
                                            <img class="card-img img-fluid mt-3" src="{{asset('images/'.$data['nik'].'/'.$data['image'])}}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="info d-flex justify-content-between mt-3">
                                    <div class="group d-flex flex-column"> 
                                        <span class="font-weight-bold">Tindak Lanjut</span> 
                                        @if ($data['status'] == 0 && $data['status'] !== 'Proses' && $data['status'] !== 'Selesai')
                                            <span>Aspirasi atau pengaduan anda <b><u>belum dapat diproses</u><b></span> 
                                        @endif
                                        @if ($data['status'] == 'Proses')
                                            <span style="width: 90%">Aspirasi atau pengaduan anda <b><u>sedang kami proses dan pertimbangkan</u></b>. Terimakasih untuk saran yang telah anda berikan :)</span>
                                        @endif
                                        @if ($data['status'] == 'Selesai')
                                            <span style="width: 90%">Aspirasi atau pengaduan anda <b><u>telah kami terima dan telah kami realisasikan</u></b>. Terimakasih untuk saran yang telah anda berikan :)</span>
                                        @endif
                                    </div> 
                                    <small>{{$data['updated_at']}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection