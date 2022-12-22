@extends('Admin/Layout/main')
@section('content')

    @if (isset($success))
        <script>
            alert('success');
            document.location.href = '{{$success}}';
        </script>
        {{$success}}
    @endif

    @if($schedules->findById(strtolower($dateNow->format('YF').'-'.$type)) === null)

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/schedule">Schedule</a></li>
                <li aria-current="page" class="breadcrumb-item active">Buat</li>
            </ol>
        </nav>


        <div class="mb-4">
            <h1>BUAT SCHEDULE {{strtoupper($type)}}</h1>
        </div>

        <form class="row" method="post">
            <div class="col-lg-3 col-md-5 mb-3">
                <div class="card rounded-3 shadow-lg">
                    <div class="card-header p-0">
                        <h5 class="card-title m-2">Minggu #1</h5>
                    </div>
                    <div class="card-body p-3">
                        <div class="mx-auto text-center">
                            <div id="m1">
                            </div>
                            <button class="btn btn-sm btn-primary py-0 rounded-3"
                                    id="add-m1" type="button">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-5 mb-3">
                <div class="card rounded-3 shadow-lg">
                    <div class="card-header p-0">
                        <h5 class="card-title m-2">Minggu #2</h5>
                    </div>
                    <div class="card-body p-3">
                        <div class="mx-auto text-center">
                            <div id="m2">
                            </div>
                            <button class="btn btn-sm btn-primary py-0 rounded-3"
                                    id="add-m2" type="button">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-5 mb-3">
                <div class="card rounded-3 shadow-lg">
                    <div class="card-header p-0">
                        <h5 class="card-title m-2">Minggu #3</h5>
                    </div>
                    <div class="card-body p-3">
                        <div class="mx-auto text-center">
                            <div id="m3">
                            </div>
                            <button class="btn btn-sm btn-primary py-0 rounded-3"
                                    id="add-m3" type="button">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-5 mb-3">
                <div class="card rounded-3 shadow-lg">
                    <div class="card-header p-0">
                        <h5 class="card-title m-2">Minggu #4</h5>
                    </div>
                    <div class="card-body p-3">
                        <div class="mx-auto text-center">
                            <div id="m4">
                            </div>
                            <button class="btn btn-sm btn-primary py-0 rounded-3"
                                    id="add-m4" type="button">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-5 mb-3">
                <div class="card rounded-3 shadow-lg">
                    <div class="card-header p-0">
                        <h5 class="card-title m-2">Minggu #5</h5>
                    </div>
                    <div class="card-body p-3">
                        <div class="mx-auto text-center">
                            <div id="m5">
                            </div>
                            <button class="btn btn-sm btn-primary py-0 rounded-3"
                                    id="add-m5" type="button">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button class="btn btn-primary disabled" id="submit" type="submit" name="submit">Submit</button>
            </div>

        </form>

    @else
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/schedule">Schedule</a></li>
                <li aria-current="page" class="breadcrumb-item active">All Jadwal Supply</li>
            </ol>
        </nav>

    @endif


    <hr class="my-5">
    <div class="col-5 ms-auto">
        Search
        <input aria-label="Search" class="form-control" placeholder="Tahun&Bulan" type="search"
               id="searchData" onkeyup="search()">
    </div>
    <br>
    <div class="card text-center d-none" id="notFound">
        <div class="card-body">
            <h1>Data tidak ditemukan</h1>
        </div>
    </div>

    <div class="d-block" id="found">
        @foreach($periods as $period)
            <hr class="my-5">
            <div class="mb-4" id="{{$period->getId()}}">
                <h1>SCHEDULE {{strtoupper($type)}} {{$period->getId()}}</h1>
            </div>
            @foreach($schedules->findAll($type) as $schedule)
                @if($schedule->getPeriodId() == $period->getId())
                    <div class="data" id="{{$schedule->getId()}}">
                        @php
                            $result = ['m1' => [], 'm2' => [], 'm3' => [], 'm4' => [], 'm5' => []];

                               foreach($schedule_weeks->findScheduleSupplyId($schedule->getId()) as $sch_week){
                                   if ($sch_week->getMId() == 'M1'){
                                       $result['m1'][] = $sch_week->getMId();
                                   }elseif ($sch_week->getMId() == 'M2'){
                                       $result['m2'][] = $sch_week->getMId();
                                   }elseif ($sch_week->getMId() == 'M3'){
                                       $result['m3'][] = $sch_week->getMId();
                                   }elseif ($sch_week->getMId() == 'M4'){
                                       $result['m4'][] = $sch_week->getMId();
                                   }elseif ($sch_week->getMId() == 'M5'){
                                       $result['m5'][] = $sch_week->getMId();
                                   }
                               }
                        @endphp

                        <div class="card mb-2">
                            <div class="card-header d-flex">
                                <a class="card-title" href="/admin/supply-data/{{$type}}/{{$schedule->getId()}}">#
                                    <span class="month">{{DateTime::createFromFormat('!m', $schedule->getMonth())->format('F')}}</span>
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </a>
                            </div>
                            <div class="card-body overflow-scroll">
                                <table class="table table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th colspan="{{count($result['m1'])}}" scope="col">M1</th>
                                        <th colspan="{{count($result['m2'])}}" scope="col">M2</th>
                                        <th colspan="{{count($result['m3'])}}" scope="col">M3</th>
                                        <th colspan="{{count($result['m4'])}}" scope="col">M4</th>
                                        <th colspan="{{count($result['m5'])}}" scope="col">M5</th>
                                    </tr>
                                    </thead>

                                    <tbody class="table-group-divider">
                                    <tr>
                                        @foreach($schedule_weeks->findScheduleSupplyId($schedule->getId()) as $sch_week)
                                            @foreach($supplies->findScheduleWeekId($sch_week->getId()) as $supply)
                                                @php($date = new DateTime($sch_week->getDate()))
                                                <td>
                                                    <div class="card border-0">
                                                        <div class="card-body p-0">
                                                            <a class="btn-link position-relative"
                                                               href="/admin/supply/{{$type}}/{{$sch_week->getId()}}/{{$supply->getId()}}/view">{{$date->format('d/m/Y')}}</a>
                                                        </div>
                                                        <span class="position-absolute top-100 start-100 translate-middle rounded-circle">
                                                @if($dateNow->format('Y-m-d') >= $sch_week->getDate() && $sch_week->getIsDone() == null)
                                                                <i class="fa-solid fa-question text-warning"></i>
                                                            @elseif($dateNow->format('Y-m-d') <= $sch_week->getDate() && $sch_week->getIsDone() == null)
                                                                <i class="fa-regular fa-clock text-secondary"></i>
                                                            @else
                                                                <i class="fa-solid fa-check text-success"></i>
                                                            @endif
                                            </span>
                                                    </div>
                                                </td>
                                            @endforeach
                                        @endforeach
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer d-flex">
                                <a class="btn btn-danger btn-sm py-0 ms-auto {{$schedule->getIsDone() != null ? 'disabled' : ''}}"
                                   href="/admin/schedule/{{$schedule->getId()}}/delete"
                                   onclick="return confirm('Apakah ingin menghapus Data?')"><i
                                            class="fa-solid fa-trash"></i>
                                    <span>Hapus</span>
                                </a>
                            </div>
                        </div>
                    </div>

                @endif
            @endforeach
        @endforeach
    </div>
    <script src="/src/js/schedule.js"></script>
    <script src="/src/js/searching.js"></script>

@endsection
