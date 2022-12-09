@extends('Admin/Layout/main')
@section('content')
    <nav aria-label="breadcrumb">

        @if($session->getRoleId() == 1)
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/schedule">Schedule</a></li>
                <li class="breadcrumb-item"><a href="/admin/schedule/{{$type}}/create">Buat</a></li>
                <li aria-current="page" class="breadcrumb-item active">Data Supply {{$schedule->getMonth()}}</li>
            </ol>
        @elseif($session->getRoleId() == 3)
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/supply">Supply</a></li>
                <li class="breadcrumb-item"><a href="/admin/supply/{{$type}}">Schedule</a></li>
                <li aria-current="page" class="breadcrumb-item active">Data Supply {{$schedule->getMonth()}}</li>
            </ol>
        @else
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/supply-data/{{$type}}">{{strtoupper($type)}}</a></li>
            </ol>
        @endif

    </nav>
    <div class="mb-4">
        <h1>Laporan Supply <u>{{strtoupper($type)}}</u> Bulan
            <u>{{DateTime::createFromFormat('!m', $schedule->getMonth())->format('F')}}</u>
        </h1>

        <button class="btn btn-success btn-sm py-0 ms-auto"
                data-bs-target="#export"
                data-bs-toggle="modal">
            <i class="fa-solid fa-file-export"></i>
            <span>Export To Excle</span>
        </button>
    </div>


    @if($schedule->getId() !== null)

        @foreach($schedule_weeks as $scheduleWeek)
            @php($dateTime = new DateTime($scheduleWeek->getDate()))
            @foreach($supplies->findScheduleWeekId($scheduleWeek->getId()) as $supply)
                <div class="card mb-3">
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
                                @foreach($supply_lines->findSupplyId($supply->getId()) as $supply_line)
                                    @if($supply_line->getHangerId() == $hanger->getId())
                                        <tr class="c-border">
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
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        @endforeach

        <div aria-hidden="true" aria-labelledby="exportLabel" class="modal fade"
             id="export"
             tabindex="-1">
            <div class="modal-dialog modal-dialog-scrollable modal-xl modal-sm modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exportLabel">Download Laporan</h1>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"
                                type="button"></button>
                    </div>
                    <div class="modal-body" id="exporting">
                        <div class="mb-4">
                            <h2>Total Supply {{strtoupper($schedule->getId())}}</h2>
                        </div>
                        @foreach($schedule_weeks as $sch_week)
                            @php($dateTime = new DateTime($sch_week->getDate()))
                            @foreach($supplies->findScheduleWeekId($sch_week->getId()) as $supply)
                                <div class="container overflow-scroll mb-3">
                                    <span><i>Periode Tanggal : {{$dateTime->format('d/m/Y')}}</i></span>
                                    <br>
                                    <span>Target : {{$supply->getTargetSet()}} set</span>

                                    <table class="text-center table-bordered" border="1">
                                        <thead>
                                        <tr>
                                            <th rowspan="2">NO</th>
                                            <th rowspan="2">NAMA SUBJIG</th>
                                            <th rowspan="2">QTY</th>
                                            <th rowspan="2">TYPE</th>
                                            <th>TARGET</th>
                                            <th colspan="4">LINE</th>
                                            <th rowspan="2">KETERANGAN</th>
                                        </tr>
                                        <tr>
                                            <th>JIG</th>
                                            <th>A</th>
                                            <th>B
                                            </th>
                                            <th>C</th>
                                            <th>TOTAL</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($hangers as $hanger)
                                            @foreach($supply_lines->findSupplyId($supply->getId()) as $supply_line)
                                                @if($supply_line->getHangerId() == $hanger->getId())
                                                    <tr>
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
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                        <button class="btn btn-success" id="download" type="button">
                            Download
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <script src="/src/js/export.js"></script>
    @endif
@endsection