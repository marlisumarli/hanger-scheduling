@extends('Admin/Layout/main')
@section('content')
    <div class="mb-4">
        <h3>SCHEDULE</h3>
    </div>
    <div class="row">
        @foreach($hanger_types as $hanger_type)

            @php($dateNow = new DateTime('now', new DateTimeZone('Asia/Jakarta')))


            <div class="container col-lg-3 col-md-6 col-sm-6 mb-3">
                <div class="card rounded-3 shadow-lg">
                    <div class="card-header">
                        <h5 class="card-title"># {{strtoupper($hanger_type->getId())}}</h5>
                    </div>

                    @if($supply_schedule->findById(strtolower($dateNow->format('YF').'-'.$hanger_type->getId())) !== null)
                        @php($schedule = $supply_schedule->findById(strtolower($dateNow->format('YF').'-'.$hanger_type->getId()))->getMonth())
                        <div class="card-body d-flex text-center p-3">
                            <div class="mx-auto">
                                <span>Schedule saat ini</span><br>
                                <span class="badge text-bg-success">{{DateTime::createFromFormat('!m', $schedule)->format('F')}}</span>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <a class="small" href="/admin/schedule/{{$hanger_type->getId()}}/create">
                                Lihat Jadwal
                            </a>
                        </div>

                    @else
                        <div class="card-body d-flex text-center p-3">
                            <div class="mx-auto">

                                Bulan sekarang belum dibuat
                                <span class="badge text-bg-warning">{{$dateNow->format('F')}}</span>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <a class="small" href="/admin/schedule/{{$hanger_type->getId()}}/create">
                                Buat Jadwal
                            </a>
                        </div>

                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection