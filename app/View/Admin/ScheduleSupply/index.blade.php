{{--TODO BULAN SEKARANG BELUM DIBUAT--}}
{{--TODO HAPUS DISABLE--}}
@extends('Admin/Layout/main')
@section('content')
    <div class="mb-4">
        <h1>SCHEDULE</h1>
    </div>
    <div class="row">
        @foreach($model['hanger_types'] as $hanger_type)
            @php($dateNow = new DateTime('now', new DateTimeZone('Asia/Jakarta')))

            <div class="container col-lg-3 col-md-6 col-sm-6 mb-3">
                <div class="card rounded-3 shadow-lg">
                    <div class="card-header">
                        <h5 class="card-title"># {{strtoupper($hanger_type->getId())}}</h5>
                    </div>
                    <div class="card-body d-flex text-center p-3">
                        <div class="mx-auto">
                            @php($schedule = $model['supply_schedule']->findById(strtolower($dateNow->format('YF').'-'.$hanger_type->getId()))->getMonth())
                            @if($schedule != $dateNow->format('m'))
                                Bulan sekarang belum dibuat
                                <span class="badge text-bg-warning">{{$dateNow->format('F')}}</span>
                            @else
                                <span>Schedule saat ini</span><br>
                                <span class="badge text-bg-success">{{DateTime::createFromFormat('!m', $schedule)->format('F')}}</span>
                            @endif
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