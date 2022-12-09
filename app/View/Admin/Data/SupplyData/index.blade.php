@extends('Admin/Layout/main')
@section('content')
    <div class="px-lg-5 px-sm-3 mb-4">
        <h4>DATA SUPPLY</h4>
    </div>
    <div class="row">
        @foreach($hanger_types as $hanger_type)
            <div class="container col-md-3 mb-3">
                <div class="card rounded-3 shadow-lg">
                    <div class="card-header">
                        <h5 class="card-title"># {{strtoupper($hanger_type->getId())}}</h5>
                    </div>
                    <div class="card-body d-flex text-center p-3">
                        <div class="mx-auto">
                            Data Supply
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a class="small stretched-link" href="/admin/supply-data/{{$hanger_type->getId()}}">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection