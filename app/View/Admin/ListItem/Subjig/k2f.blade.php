@extends('Admin/Layout/main')
@section('content')
    @if (isset($category['error']))
        {{$category['error']}}
    @endif

    <span>Subjig K2F</span>
    <br>
    <button id="add">Tambah</button>
    <button id="rm">Hapus</button>

    <form action="" method="post">
        <div id="data">

        </div>
        <button type="submit">submit</button>
    </form>


    <table border="1">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Id</th>
            <th scope="col">Nama</th>
            <th scope="col">Quantity</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($listItem['allK2f'] as $key => $value)
            <tr>
                <th scope="row">{{$key + 1}}</th>
                <td>{{$value->getK2fId()}}</td>
                <td>{{$value->getK2fName()}}</td>
                <td>{{$value->getK2fQty() }}</td>
                <td><a href="/admin/list-item/subjig/k2f-update?id={{$value->getK2fId()}}">Edit</a>
                    <a href="/admin/list-item/subjig/k2f-delete?id={{$value->getK2fId()}}"
                       onclick="return confirm('Ingin menghapus?');">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection


