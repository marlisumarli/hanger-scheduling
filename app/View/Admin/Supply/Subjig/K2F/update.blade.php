@extends('Admin/Layout/main')
@section('content')
    @if(isset($model['error']))
        {{$model['error']}}
    @endif
    <h1>Ubah laporan supply {{$model['idSupply']->supply_id}}</h1>
    <form action="" method="post">
        <label for="dateUpdate">Tanggal</label>
        <input type="date" name="dateUpdate" id="dateUpdate" value="{{$model['idSupply']->supply_date}}">
        <br>
        @foreach ($model['allSupply'] as $key => $value)
            <label for="">{{$value->getK2fName()}}</label>
            <input type="number" name="k2fLnA[]" value="{{$value->getJumlahLineA()}}" min="0">
            <input type="number" name="k2fLnB[]" value="{{$value->getJumlahLineB()}}" min="0">
            <input type="number" name="k2fLnC[]" value="{{$value->getJumlahLineC()}}" min="0">
            <br>
        @endforeach
        <button type="submit">submit</button>
    </form>
    @if (isset($model['success']))
        <script>
            alert('success');
            document.location.href = '{{$model["success"]}}';
        </script>
    @endif
@endsection