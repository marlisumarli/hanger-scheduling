@extends('Admin/Layout/main')
@section('content')
    <div class="mb-4">
        <h1>SUPPLY</h1>
    </div>
    <div class="row">
        @foreach($model['hanger_types'] as $hanger_type)
            <div class="col-md-3 mb-3">
                <div class="card rounded-3 shadow-lg">
                    <div class="card-header">
                        <h5 class="card-title"># {{$hanger_type->getId()}}</h5>
                    </div>
                    <div class="card-body d-flex text-center p-3">
                        <div class="mx-auto">
                            Schedule Supply
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a class="small" href="/admin/supply/{{$hanger_type->getId()}}">
                            Daftar Schedule
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection