@extends('Admin/Layout/main')
@section('content')

    @php($date = new DateTime())

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/supply">Supply</a></li>
            <li aria-current="page" class="breadcrumb-item active">Laporan {{$type}}</li>
        </ol>
    </nav>
    <div class="mb-4">
        <h1>Laporan Supply <u>{{strtoupper($type)}}</u> Bulan
            <u>{{DateTime::createFromFormat('!m', $schedule->getMonth())->format('F')}}</u>
        </h1>
    </div>

    @foreach($schedule_weeks as $scheduleWeek)

        @php($dateTime = new DateTime($scheduleWeek->getDate()))

        @if((INT)$scheduleWeek->getIsDone() != 0)
            @foreach($supplies->findScheduleWeekId($scheduleWeek->getId()) as $supply)

                <div class="card mb-2">
                    <div class="card-header d-flex">
                        <span class="card-title"># {{$dateTime->format('d F Y')}}</span>
                        <div class="ms-auto">
                            <span>Target #{{$supply->getTargetSet()}} set</span>
                        </div>
                    </div>


                    <div class="card-body overflow-scroll">
                        <table class="table table-borderless text-center table-subjig">
                            <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="border" colspan="3">Line</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr class="c-border border-bottom border-dark border-2">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">QTY</th>
                                <th scope="col">Type</th>
                                <th scope="col">Target</th>
                                <th scope="col">A</th>
                                <th scope="col">B</th>
                                <th scope="col">C</th>
                                <th scope="col">Total</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                            </thead>
                            <tbody class="border">
                            @foreach($hangers as $hanger)
                                <tr class="c-border">
                                    @foreach($supply_lines->findSupplyId($supply->getId()) as $supply_line)
                                        @if($supply_line->getHangerId() == $hanger->getId())
                                            @php($total = $supply_line->getTotal())
                                            <td>{{$hanger->getOrderNumber()}}</td>
                                            <td>{{$hanger->getName()}}</td>
                                            <td>{{$hanger->getQty()}}</td>
                                            <td>{{strtoupper($hanger->getHangerTypeId())}}</td>
                                            <td>{{ceil($supply->getTargetSet()/$hanger->getQty())}}</td>
                                            <td>{{$supply_line->getLineA()}}</td>
                                            <td>{{$supply_line->getLineB()}}</td>
                                            <td>{{$supply_line->getLineC()}}</td>
                                            <td>{{$total}}</td>
                                            <td>{{($total*$hanger->getQty()) <= $supply->getTargetSet() ? 'Open' : 'Close'}}</td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex">
                        <div class="ms-auto">
                            <a class="btn btn-warning btn-sm py-0" href="">
                                <i class="fa-solid fa-pen-to-square"></i>
                                <span>Ubah</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    @endforeach
@endsection