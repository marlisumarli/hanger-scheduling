@extends('Admin/Layout/main')
@section('content')
    @foreach($model['allSupply'] as $index => $value)
        <h1>Tanggal : {{$value->getSupplyDate()}}</h1>
        <table border="1">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Nama</th>
                <th scope="col">Line A</th>
                <th scope="col">Line B</th>
                <th scope="col">Line C</th>
                <th scope="col">Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($model['joinSupply'][$index] as $supply => $k2f)
                <tr>
                    <th scope="row">{{$k2f->getId()}}</th>
                    <th>{{$k2f->getK2fName()}}</th>
                    <th>{{$k2f->getJumlahLineA()}}</th>
                    <th>{{$k2f->getJumlahLineB()}}</th>
                    <th>{{$k2f->getJumlahLineC()}}</th>
                    <th>{{$k2f->getTotal()}}</th>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endforeach
@endsection


