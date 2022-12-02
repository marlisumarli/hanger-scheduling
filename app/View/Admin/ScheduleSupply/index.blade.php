@extends('Admin/Layout/main')
@section('content')
    <div class="mb-4">
        <h1>SCHEDULE</h1>
    </div>
    <div class="row">
        @foreach($model['hanger_types'] as $hanger_type)
            <div class="container col-lg-3 col-md-6 col-sm-6 mb-3">
                <div class="card rounded-3 shadow-lg">
                    <div class="card-header">
                        <h5 class="card-title"># {{$hanger_type->getId()}}</h5>
                    </div>
                    <div class="card-body d-flex text-center p-3">
                        <div class="mx-auto">
                            Bulan sekarang belum dibuat
                            <span class="badge text-bg-warning">November</span>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a class="small" href="/admin/schedule/{{$hanger_type->getId()}}/create">
                            Buat Schedule
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection