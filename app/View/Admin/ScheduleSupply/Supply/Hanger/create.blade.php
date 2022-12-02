@extends('Admin/Layout/main')
@section('content')
    @if(isset($model['error']))
        {{$model['error']}}
    @endif
    @if (isset($model['success']))
        <script>
            alert('success');
            document.location.href = '{{$model["success"]}}';
        </script>
    @endif
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/supply">Supply</a></li>
            <li class="breadcrumb-item"><a href="/admin/supply/{{$model["type"]}}">Schedule</a></li>
            <li aria-current="page" class="breadcrumb-item active">Buat Laporan</li>
        </ol>
    </nav>
    <div class="mb-4">
        <h1>Buat Laporan Supply {{$model["type"]}}</h1>
    </div>

    <form class="d-flex justify-content-center" method="post">
        <div class="row">
            <div class="col-md-4 order-md-last mb-3">
                <div class="card rounded-3 shadow-lg">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span>Tanggal dibuat</span><span
                                    class="badge text-bg-warning">{{$model['schedule_week']->getDate()}}</span>
                        </div>
                        <label class="form-label card-title" for="targetSet">Target Set</label>
                        <input class="form-control" id="targetSet" min="100" name="target" required type="number">
                    </div>
                </div>
            </div>

            <div class="col-md">
                @foreach ($model['hangers'] as $hanger)
                    <div class="card shadow-lg rounded-3 mb-2">
                        <div class="card-header border-bottom-0">
                            <span class="card-title"># {{$hanger->getHangerName()}}</span>
                        </div>
                        <div class="card-body">
                            <div class="row g-1">
                                <div class="col-4">
                                    <label for="1">Line A</label>
                                    <input class="form-control" id="1" name="lnA" type="number">
                                </div>
                                <div class="col-4">
                                    <label for="2">Line B</label>
                                    <input class="form-control" id="2" name="lnB" type="number">
                                </div>
                                <div class="col-4">
                                    <label for="3">Line C</label>
                                    <input class="form-control" id="3" name="lnC" type="number">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary rounded-3 mt-3 px mx-2 shadow-lg" type="submit">Submit</button>
                    <a href="/admin/supply/{{$model["type"]}}" class="btn btn-secondary rounded-3 mt-3 shadow-lg">Kembali</a>
                </div>
            </div>
        </div>
    </form>
@endsection