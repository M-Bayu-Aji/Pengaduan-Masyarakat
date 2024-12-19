@extends('layout')

@section('content')
    <div class="px-3 py-4">
        @if (auth()->user()->level === 'ADMIN')
        <div class="d-flex justify-content-between mb-4">
            <div></div>
            <div>
                <a href="{{route('admin.reports.export')}}" target="_blank" class="btn btn-primary">Cetak Laporan</a>
                <a href="{{route('admin.accounts')}}" class="btn btn-success">Lihat Seluruh Akun</a>
            </div>
        </div>
        @endif
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>Berhasil! </strong>{{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
           </div>
        @endif
        <table class="table table-bordered pt-4 mb-4 table-striped text-capitalize" id="myTable">
            <thead>
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">NIK</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Pengaduan</th>
                    <th scope="col">Status</th>
                    @if (auth()->user()->level === 'PETUGAS')
                    <th scope="col">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($data as $dt)
                <tr>
                    <th>{{$no++}}</th>
                    <td>{{$dt['nik']}}</td>
                    <td>{{$dt['citizen']['name']}}</td>
                    <td class="text-left">{{$dt['message']}}</td>
                    <td>
                    @if ($dt['status'] === 0)
                        <span class="text-danger">Belum Terdapat Tindakan</span>
                    @else
                        <b>{{$dt['status']}}</b>
                    @endif    
                    </td>
                    @if (auth()->user()->level === 'PETUGAS')
                    <td>
                        <form action="{{ route('report.destroy',$dt['id']) }}" method="POST">
                            <a href="{{route('report.show', $dt['id'])}}"><span class="badge badge-primary p-2 mt-1">Perbarui Status</span></a>

                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger ml-2 p-1 mt-2" onclick="return confirm(`Hapus Data Pengaduan Dari <?php echo  $dt['citizen']['name'] ?> ?`)">Hapus</button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection