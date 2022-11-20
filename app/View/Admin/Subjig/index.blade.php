@extends('Admin/Layout/main')
@section('content')
    @if (isset($model['error']))
        {{$model['error']}}
    @endif

    <table border="1">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Type</th>
            <th scope="col">Qty</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($model['allSubjig'] as $key => $value)
            <tr>
                <th scope="row">{{$value->getOrderNumber()}}</th>
                <td>{{$value->getSubjigName()}}</td>
                <td>{{$value->getTypeId()}}</td>
                <td>{{$value->getSubjigQty()}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="/admin/subjig/{{$model['typeId']}}/list">Ubah</a>
@endsection


