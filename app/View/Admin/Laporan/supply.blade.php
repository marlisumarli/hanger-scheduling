@extends('Admin/Layout/main')
@section('content')
    @foreach($model['allSupplyDate'] as $index => $value)
        <h1 id="{{$value->getSupplyId()}}">Tanggal : {{$value->getSupplyDate()}}</h1>
        <table border="1">
            <thead>
            <tr>
                <th scope="col">NO</th>
                <th scope="col">NAMA SUBJIG</th>
                <th scope="col">QTY</th>
                <th scope="col">TARGET</th>
                <th scope="col">LINE A</th>
                <th scope="col">LINE B</th>
                <th scope="col">LINE C</th>
                <th scope="col">TOTAL</th>
                <th scope="col">SET</th>
                <th scope="col">KETERANGAN</th>
            </tr>
            </thead>
            <tbody>
            {{$value->getTargetSet()}} Set

            @foreach($model['allSupplyLine'][$index] as $key => $value2)
                <tr>
                    <th scope="row">{{$value2->getOrderId()}}</th>
                    <th>{{$value2->getSubjigName()}}</th>
                    <th>{{$value2->getSubjigQty()}}</th>
                    <th>{{ceil($value2->getLineTarget()/$value2->getSubjigQty())}}</th>
                    <th>{{$value2->getJumlahLineA()}}</th>
                    <th>{{$value2->getJumlahLineB()}}</th>
                    <th>{{$value2->getJumlahLineC()}}</th>
                    <th>{{$value2->getTotal()}}</th>
                    <th>{{$value2->getTotal()*$value2->getSubjigQty()}}</th>
                    <th>
                        {{(($value2->getTotal()*$value2->getSubjigQty()) < $value2->getLineTarget()) ? "OPEN" : "CLOSE"}}
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="/admin/supply/{{$value->getTypeId()}}/{{$value->getSupplyId()}}/update">Ubah</a>
        <a href="/admin/supply/{{$value->getTypeId()}}/{{$value->getSupplyId()}}/delete"
           onclick="return confirm('Ingin menghapus?');">Hapus</a>
    @endforeach
@endsection


