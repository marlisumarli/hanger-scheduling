@extends('Admin/Layout/main')
@section('content')
    @foreach($model['supplies'] as $key => $supply)
        <h1 id="{{$supply->getId()}}">Tanggal : 12</h1>
        <table>
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
            {{$supply->getTargetSet()}} Set

            @foreach($model['supply_lines'][$index] as $supply_line)
                <tr>
                    <th scope="row">{{$supply_line->getOrderId()}}</th>
                    <th>{{$supply_line->getSubjigName()}}</th>
                    <th>{{$supply_line->getSubjigQty()}}</th>
                    <th>{{ceil($supply_line->getLineTarget()/$supply_line->getSubjigQty())}}</th>
                    <th>{{$supply_line->getJumlahLineA()}}</th>
                    <th>{{$supply_line->getJumlahLineB()}}</th>
                    <th>{{$supply_line->getJumlahLineC()}}</th>
                    <th>{{$supply_line->getTotal()}}</th>
                    <th>{{$supply_line->getTotal()*$supply_line->getSubjigQty()}}</th>
                    <th>
                        {{(($supply_line->getTotal()*$supply_line->getSubjigQty()) < $supply_line->getLineTarget()) ? "OPEN" : "CLOSE"}}
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="/admin/supply/{{$model['type']}}/{{$supply->getId()}}/update">Ubah</a>
        <a href="/admin/supply/{{$model['type']}}/{{$supply->getId()}}/delete"
           onclick="return confirm('Ingin menghapus?');">Hapus</a>
    @endforeach
@endsection


