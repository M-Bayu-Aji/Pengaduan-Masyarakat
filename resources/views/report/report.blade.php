@extends('layout')

@section('content')
    <div class="reports px-3 py-4">
        <div class="event-list">
            @foreach ($data as $report)
                <div class="card flex-row w-100">
                    <img class="card-img-left img-fluid" src="{{asset('images/'.$report['nik'].'/'.$report['image'])}}" />
                    <div class="card-body">
                        <h4 class="card-title h5 h4-sm text-capitalize">
                            <i class="fas fa-caret-right" aria-hidden="true"></i>
                            <span>{{$report['citizen']['name']}}</span><i class="fas fa-caret-right" aria-hidden="true"></i><span>{{$report['date']}}</span> 
                        </h4>
                        <p class="card-text">{{$report['message']}}</p>
                        <a href="{{route('report.show', $report['id'])}}" class="text-dark">Selengkapnya <span>>></span></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection