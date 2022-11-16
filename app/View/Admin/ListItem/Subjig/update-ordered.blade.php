@extends('Admin/Layout/main')
@section('content')
    <form action="" method="post">
        <table border="1">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Id</th>
                <th scope="col">Quantity</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($model['allK2f'] as $key => $value)
                <tr>
                    <th scope="row">
                        <label for="order"></label>
                        <input type="number" name="order[]" id="order" value="{{$value->getK2fOrderId()}}" min="1"></th>
                    <td>{{$value->getK2fName()}}</td>
                    <td><input type="text" name="id[]" value="{{$value->getK2fId()}}"></td>
                    <td>{{$value->getK2fQty()}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <button type="submit">submit</button>
        <a href="/admin/list-item/subjig/k2f">kembali</a>
    </form>
@endsection