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
    @if($model['idSupply'] !== null)
        <h1>Ubah laporan supply {{$model['idSupply']->getSupplyId()}}</h1>
        <form method="post">
            <label for="dateUpdate">Tanggal</label>
            <input type="date" name="dateUpdate" id="dateUpdate" value="{{$model['idSupply']->getSupplyDate()}}">
            <label for="target">Update Target Supply</label>
            <input type="number" name="target" id="target" min="100" value="{{$model['idSupply']->getTargetSet()}}"
                   required="required">
            <br>
            @foreach ($model['allSupply'] as $key => $value)
                <label for="">{{$value->getSubjigName()}}</label>
                <input type="number" name="lnA[]" value="{{$value->getJumlahLineA()}}" min="0">
                <input type="number" name="lnB[]" value="{{$value->getJumlahLineB()}}" min="0">
                <input type="number" name="lnC[]" value="{{$value->getJumlahLineC()}}" min="0">
                <br>
            @endforeach
            <button type="submit">submit</button>
        </form>
        <a href="/admin/laporan/{{$model['back']}}/supply">Kembali</a>

    @endif
@endsection