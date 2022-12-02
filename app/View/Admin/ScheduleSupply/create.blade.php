@extends('Admin/Layout/main')
@section('content')
    @if (isset($model['error']))
        {{$model['error']}}
    @endif
    @if (isset($model['success']))
        <script>
            alert('success');
            document.location.href = '{{$model['success']}}';
        </script>
        {{$model['success']}}
    @endif

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/schedule">Schedule</a></li>
            <li aria-current="page" class="breadcrumb-item active">Buat</li>
        </ol>
    </nav>

    <div class="mb-4">
        <h1>BUAT SCHEDULE {{$model['type']}}</h1>
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
            <button class="btn btn-primary disabled" id="submit" type="submit">Submit</button>
        </div>
    </form>
    <hr class="my-5">
    <form class="col-3 ms-auto" role="search">
        <input aria-label="Search" class="form-control" placeholder="Search..." type="search">
    </form>

    @foreach($model['periods'] as $period)
        <hr class="my-5">
        <div class="mb-4">
            <h1>SCHEDULE {{$model['type']}} {{$period->getId()}}</h1>
        </div>

        @foreach($model['schedules'] as $data => $schedule)
            @if($schedule->getPeriodId() == $period->getId())
                @php
                    $result = ['m1' => [], 'm2' => [], 'm3' => [], 'm4' => [], 'm5' => []];
                        foreach($model['schedule_weeks'][$data] as $sch_week){
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
                        <span class="card-title"># {{DateTime::createFromFormat('!m', $schedule->getMonth())->format('F')}}</span>
                        <button class="btn btn-primary btn-sm py-0 ms-auto"><i class="fa-solid fa-download"></i>
                            <span>Download Excle</span>
                        </button>
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
                                $dateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
                            @endphp

                            <tbody class="table-group-divider">
                            <tr>
                                @foreach($model['schedule_weeks'][$data] as $sch_week)
                                    <td>
                                        <div class="card border-0">
                                            <div class="card-body p-0">
                                                <a class="btn-link position-relative"
                                                   href="{{$sch_week->getSupplyId()}}">{{$sch_week->getDate()}}</a>
                                            </div>
                                            <span class="position-absolute top-100 start-100 translate-middle rounded-circle">
                                                @if($dateTime->format('Y-m-d') >= $sch_week->getDate() && $sch_week->getIsImplemented() == null)
                                                    <i class="fa-solid fa-question text-warning"></i>
                                                @elseif($dateTime->format('Y-m-d') <= $sch_week->getDate() && $sch_week->getIsImplemented() == null)
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
                    <div class="card-footer d-flex">
                        <a class="btn btn-danger btn-sm py-0 ms-auto"
                           href="/admin/schedule/{{$schedule->getId()}}/delete"
                           onclick="return confirm('Apakah ingin menghapus data?')"><i class="fa-solid fa-trash"></i>
                            <span>Hapus</span>
                        </a>
                    </div>
                </div>
            @endif
        @endforeach
    @endforeach
    <script type="text/javascript">
        const addM1 = document.getElementById('add-m1');
        addM1.addEventListener('click', addMoreFields1);
        addM1.addEventListener('click', countFieldDate);

        function addMoreFields1() {
            const m1 = document.getElementById('m1');
            const input = document.createElement('input');
            const div = document.createElement('div');
            const buttonRemove = document.createElement('button');

            div.setAttribute('class', 'mt-3 mb-3 input-group');
            m1.appendChild(div);

            input.setAttribute('class', 'form-control');
            input.setAttribute('name', 'date-m1[]');
            input.setAttribute('type', 'date');
            input.setAttribute('required', 'required');
            div.appendChild(input);
            buttonRemove.setAttribute('class', 'btn btn-danger input-group-tex');
            buttonRemove.setAttribute('type', 'button');
            buttonRemove.innerHTML = '<i class="fa-solid fa-xmark"></i>';

            buttonRemove.addEventListener('click', function () {
                m1.removeChild(div);
                countFieldDate();
            });
            div.appendChild(buttonRemove);
        }

        const addM2 = document.getElementById('add-m2');
        addM2.addEventListener('click', addMoreFields2);
        addM2.addEventListener('click', countFieldDate);

        function addMoreFields2() {
            const m2 = document.getElementById('m2');
            const input = document.createElement('input');
            const div = document.createElement('div');
            const buttonRemove = document.createElement('button');

            div.setAttribute('class', 'mt-3 mb-3 input-group');
            m2.appendChild(div);

            input.setAttribute('class', 'form-control');
            input.setAttribute('name', 'date-m2[]');
            input.setAttribute('type', 'date')
            input.setAttribute('required', 'required');
            div.appendChild(input);
            buttonRemove.setAttribute('class', 'btn btn-danger input-group-tex');
            buttonRemove.setAttribute('type', 'button');
            buttonRemove.innerHTML = '<i class="fa-solid fa-xmark"></i>';

            buttonRemove.addEventListener('click', function () {
                m2.removeChild(div);
                countFieldDate();
            });
            div.appendChild(buttonRemove);
        }

        const addM3 = document.getElementById('add-m3');
        addM3.addEventListener('click', addMoreFields3);
        addM3.addEventListener('click', countFieldDate);

        function addMoreFields3() {
            const m3 = document.getElementById('m3');
            const input = document.createElement('input');
            const div = document.createElement('div');
            const buttonRemove = document.createElement('button');

            div.setAttribute('class', 'mt-3 mb-3 input-group');
            m3.appendChild(div);

            input.setAttribute('class', 'form-control');
            input.setAttribute('name', 'date-m3[]');
            input.setAttribute('type', 'date')
            input.setAttribute('required', 'required');
            div.appendChild(input);
            buttonRemove.setAttribute('class', 'btn btn-danger input-group-tex');
            buttonRemove.setAttribute('type', 'button');
            buttonRemove.innerHTML = '<i class="fa-solid fa-xmark"></i>';

            buttonRemove.addEventListener('click', function () {
                m3.removeChild(div);
                countFieldDate();
            });
            div.appendChild(buttonRemove);
        }

        const addM4 = document.getElementById('add-m4');
        addM4.addEventListener('click', addMoreFields4);
        addM4.addEventListener('click', countFieldDate);

        function addMoreFields4() {
            const m4 = document.getElementById('m4');
            const input = document.createElement('input');
            const div = document.createElement('div');
            const buttonRemove = document.createElement('button');

            div.setAttribute('class', 'mt-3 mb-3 input-group');
            m4.appendChild(div);

            input.setAttribute('class', 'form-control');
            input.setAttribute('name', 'date-m4[]');
            input.setAttribute('type', 'date')
            input.setAttribute('required', 'required');
            div.appendChild(input);
            buttonRemove.setAttribute('class', 'btn btn-danger input-group-tex');
            buttonRemove.setAttribute('type', 'button');
            buttonRemove.innerHTML = '<i class="fa-solid fa-xmark"></i>';

            buttonRemove.addEventListener('click', function () {
                m4.removeChild(div);
                countFieldDate();
            });
            div.appendChild(buttonRemove);
        }

        const addM5 = document.getElementById('add-m5');
        addM5.addEventListener('click', addMoreFields5);
        addM5.addEventListener('click', countFieldDate);

        function addMoreFields5() {
            const m5 = document.getElementById('m5');
            const input = document.createElement('input');
            const div = document.createElement('div');
            const buttonRemove = document.createElement('button');

            div.setAttribute('class', 'mt-3 mb-3 input-group');
            m5.appendChild(div);

            input.setAttribute('class', 'form-control');
            input.setAttribute('name', 'date-m5[]');
            input.setAttribute('type', 'date')
            input.setAttribute('required', 'required');
            div.appendChild(input);
            buttonRemove.setAttribute('class', 'btn btn-danger input-group-tex');
            buttonRemove.setAttribute('type', 'button');
            buttonRemove.innerHTML = '<i class="fa-solid fa-xmark"></i>';

            buttonRemove.addEventListener('click', function () {
                m5.removeChild(div);
                countFieldDate();
            });
            div.appendChild(buttonRemove);
        }

        function countFieldDate() {
            const buttonSubmit = document.getElementById('submit');
            const m1 = document.getElementById('m1');
            const m2 = document.getElementById('m2');
            const m3 = document.getElementById('m3');
            const m4 = document.getElementById('m4');
            const countM1 = m1.querySelectorAll('input').length;
            const countM2 = m2.querySelectorAll('input').length;
            const countM3 = m3.querySelectorAll('input').length;
            const countM4 = m4.querySelectorAll('input').length;
            if ((countM1 >= 1) && (countM2 >= 1) && (countM3 >= 1) && (countM4 >= 1)) {
                buttonSubmit.classList.remove('disabled');
            } else {
                buttonSubmit.classList.add('disabled');
            }
        }
    </script>

@endsection
