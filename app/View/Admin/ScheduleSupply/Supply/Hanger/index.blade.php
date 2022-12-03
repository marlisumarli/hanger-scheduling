@extends('Admin/Layout/main')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/supply">Supply</a></li>
            <li aria-current="page" class="breadcrumb-item active">Schedule</li>
        </ol>
    </nav>

    <div class="mb-4">
        <h1>SCHEDULE SUPPLY {{strtoupper($model['type'])}}</h1>
    </div>
    <div class="row">
        @foreach($model['schedule_m_categories'] as $category)

            <div class="col-lg-4 col-md-6 col-sm-6 mb-3">
                <div class="card rounded-3 shadow-lg">
                    <div class="card-header p-0">
                        <h5 class="card-title m-2">Minggu #{{$category->getId()}}</h5>
                    </div>
                    <div class="card-body p-3">
                        <div class="row text-center">
                            @php
                                $dateNow = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
                            @endphp
                            @foreach($model['schedule_weeks']->findScheduleSupplyId((strtolower($dateNow->format('YF').'-'.$model['type']))) as $sch_week)

                                @foreach($model['supplies']->findScheduleWeekId($sch_week->getId()) as $supply)

                                    @php
                                        $date = new DateTime($sch_week->getDate());
                                    @endphp

                                    @if($sch_week->getMId() == $category->getId())
                                        <div class="col-5">
                                            <span class="small">{{$date->format('d/m/Y')}}</span>
                                        </div>

                                        @if($dateNow->format('Y-m-d') == $sch_week->getDate() && $sch_week->getIsDone() == null)
                                            <div class="col-6">
                                                <a href="/admin/supply/{{$model['type']}}/{{$sch_week->getId()}}/{{$supply->getId()}}/create">
                                                    <span class="small">Buat Laporan</span>
                                                </a>
                                            </div>

                                        @elseif($dateNow->format('Y-m-d') >= $sch_week->getDate() && $sch_week->getIsDone() == null)
                                            <div class="col-6">
                                                <svg class="bi bi-question-circle text-warning" fill="currentColor"
                                                     height="16"
                                                     viewBox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                                                </svg>
                                            </div>

                                        @elseif($dateNow->format('Y-m-d') <= $sch_week->getDate() && $sch_week->getIsDone() == null)
                                            <div class="col-6">
                                                <i class="fa-regular fa-clock text-secondary"></i>
                                            </div>

                                        @else
                                            <div class="col-6">
                                                <a class="link-primary"
                                                   href="/admin/supply/{{$model['type']}}/{{$sch_week->getId()}}/{{$supply->getId()}}/view">
                                                    <span class="small">Lihat</span>
                                                </a>
                                                <svg class="bi bi-check2-circle text-success" fill="currentColor"
                                                     height="16"
                                                     viewBox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                                    <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @foreach($model['periods'] as $period)
        @foreach($model['schedules'] as $schedule)
            @if($schedule->getPeriodId() == $period->getId())
                <hr class="my-5">
                <div class="mb-4">
                    <h1>SCHEDULE {{strtoupper($model['type'])}} {{$period->getId()}}</h1>
                </div>
                @php
                    $result = ['m1' => [], 'm2' => [], 'm3' => [], 'm4' => [], 'm5' => []];

                       foreach($model['schedule_weeks']->findScheduleSupplyId($schedule->getId()) as $sch_week){
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
                        <a class="card-title" href="/admin/supply/{{$model['type']}}/{{$schedule->getId()}}">#
                            <span>{{DateTime::createFromFormat('!m', $schedule->getMonth())->format('F')}}</span>
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

                            @php
                                $dateNow = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
                            @endphp

                            <tbody class="table-group-divider">
                            <tr>
                                @foreach($model['schedule_weeks']->findScheduleSupplyId($schedule->getId()) as $sch_week)
                                    @php
                                        $date = new DateTime($sch_week->getDate());
                                    @endphp
                                    <td>
                                        <div class="card border-0">
                                            <div class="card-body p-0">
                                                <a class="btn-link position-relative"
                                                   href="/admin/supply/{{$model['type']}}/{{$sch_week->getId()}}/{{$supply->getId()}}/view">{{$date->format('d/m/Y')}}</a>
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
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endforeach
    @endforeach
@endsection