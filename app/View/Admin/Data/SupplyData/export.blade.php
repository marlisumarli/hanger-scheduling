@extends('Admin/Layout/main')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li aria-current="page" class="breadcrumb-item active">Download</li>
        </ol>
    </nav>

    <button class="btn btn-success" id="download" type="button">
        Download
    </button>
    <div id="exporting">
        <div class=" mb-4">
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
    <script src="/src/js/export.js"></script>
@endsection