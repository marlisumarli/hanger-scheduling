@extends('Admin/Layout/main')
@section('content')
    @if (isset($success))
        <script>
            alert('success');
        </script>
    @endif
    @php
        if (isset($schedule_week)){
             $dateTime = new DateTime($schedule_week);
        }
    @endphp
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/supply">Supply</a></li>
            <li class="breadcrumb-item"><a href="/admin/supply/{{$type}}">Schedule</a></li>
            <li class="breadcrumb-item">
                <a href="/admin/supply/{{$type}}/{{$schedule}}/{{$supplyId}}/view">{{$dateTime->format('d/m/Y')}}</a>
            </li>
            <li aria-current="page" class="breadcrumb-item active">Ubah Laporan</li>
        </ol>
    </nav>
    <div class="mb-4">
        <h1>Update Laporan Supply {{strtoupper($type)}}</h1>
    </div>

    <form class="d-flex justify-content-center" method="post">
        <div class="row">
            <div class="col-md-4 order-md-last mb-3">
                <div class="card rounded-3 shadow-lg">
                    <div class="card-body">
                        <label class="form-label card-title" for="targetSet">Ubah Target Set</label>
                        <input class="form-control" id="targetSet" min="100" name="target" required type="number"
                               value="{{$supply->getTargetSet()}}">
                    </div>
                </div>
            </div>

            <div class="col-md">
                @foreach ($hangers as $hanger)
                    <div class="card shadow-lg rounded-3 mb-2">
                        <div class="card-header border-bottom-0">
                            <span class="card-title"># {{$hanger->getName()}}</span>
                        </div>
                        <div class="card-body">
                            <div class="row g-1">
                                @foreach($supply_lines as $supplyLine)

                                    @if($supplyLine->getHangerId() == $hanger->getId() && $supplyLine->getSupplyId() == $supply->getId())
                                        <div class="col-4">
                                            <label for="1">Line A</label>
                                            <input class="form-control" id="1" name="lnA_{{$supplyLine->getId()}}"
                                                   type="number" min="0"
                                                   value="{{$supplyLine->getLineA()}}">
                                        </div>
                                        <div class="col-4">
                                            <label for="2">Line B</label>
                                            <input class="form-control" id="2" name="lnB_{{$supplyLine->getId()}}"
                                                   type="number" min="0"
                                                   value="{{$supplyLine->getLineB()}}">
                                        </div>
                                        <div class="col-4">
                                            <label for="3">Line C</label>
                                            <input class="form-control" id="3" name="lnC_{{$supplyLine->getId()}}"
                                                   type="number" min="0"
                                                   value="{{$supplyLine->getLineC()}}">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary rounded-3 mt-3 px mx-2 shadow-lg" type="submit">Submit</button>
                    <a href="/admin/supply/{{$type}}/{{$schedule}}/{{$supplyId}}/view"
                       class="btn btn-secondary rounded-3 mt-3 shadow-lg">Kembali</a>
                </div>
            </div>
        </div>
    </form>
@endsection