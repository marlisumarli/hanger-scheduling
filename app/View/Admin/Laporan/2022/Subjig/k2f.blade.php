@extends('Admin/Layout/main')
@section('content')
    @foreach($model['allSupply'] as $index => $value)
        <h1>Tanggal : {{$value->getSupplyDate()}}</h1>
        <table border="1">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Quantity</th>
                <th scope="col">Target</th>
                <th scope="col">Line A</th>
                <th scope="col">Line B</th>
                <th scope="col">Line C</th>
                <th scope="col">Total</th>
                <th scope="col">Set</th>
                <th scope="col">Keterangan</th>
            </tr>
            </thead>
            <tbody>
            {{$model['joinSupply'][$index][$index]->getTargetSet()}} Set

            @foreach($model['joinSupply'][$index] as $supply => $k2f)
                <tr>
                    <th scope="row">{{$k2f->getK2fOrderid()}}</th>
                    <th>{{$k2f->getK2fName()}}</th>
                    <th>{{$k2f->getK2fQty()}}</th>
                    <th>{{ceil($k2f->getTargetSet()/$k2f->getK2fQty())}}</th>
                    <th>{{$k2f->getJumlahLineA()}}</th>
                    <th>{{$k2f->getJumlahLineB()}}</th>
                    <th>{{$k2f->getJumlahLineC()}}</th>
                    <th>{{$k2f->getTotal()}}</th>
                    <th>{{$k2f->getTotal()*$k2f->getK2fQty()}}</th>
                    <th>open</th>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="/admin/supply/subjig/k2f-update?id={{$value->getSupplyId()}}">Ubah</a>
        <a href="/admin/supply/subjig/delete?id={{$value->getSupplyId()}}"
           onclick="return confirm('Ingin menghapus?');">Hapus</a>
    @endforeach
@endsection


