@extends('Admin/Layout/main')
@section('content')
    @if (isset($model['error']))
        {{$model['error']}}
    @endif

    <span>Subjig K2F</span>
    <br>
    <button id="add">Tambah</button>
    <button id="rm">Hapus</button>

    <form action="/admin/list-item/subjig/k2f" method="post" id="forms">
        <div id="data">
            <div id="">
                <span>1.</span>
                <label for="id1">Id</label>
                <input type="text" name="id[]" id="id1" title="Tidak boleh mengandung angka atau spasi"
                       pattern="[a-zA-Z]{1,}"
                       required="required">
                <br>
                <label for="name1">Nama</label>
                <input type="text" name="name[]" id="name1" title="Tidak boleh mengandung angka"
                       pattern="[A-Za-z ]{1,}" required="required">
                <br>
                <label for="qty1">Quantity</label>
                <input type="number" name="qty[]" id="qty1" required="required">
                <hr>
            </div>
        </div>
        <button type="submit">submit</button>
    </form>


    <table border="1">
        <thead>
        <tr>
            <th scope="col"><a href="/admin/list-item/subjig/k2f-update-order">#</a></th>
            <th scope="col">Id</th>
            <th scope="col">Nama</th>
            <th scope="col">Quantity</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($model['allK2f'] as $key => $value)
            <tr>
                <th scope="row">{{$value->getId()}}</th>
                <td>{{$value->getK2fId()}}</td>
                <td>{{$value->getK2fName()}}</td>
                <td>{{$value->getK2fQty()}}</td>
                <td><a href="/admin/list-item/subjig/k2f-update?id={{$value->getK2fId()}}">Edit</a>
                    <a href="/admin/list-item/subjig/k2f-delete?id={{$value->getK2fId()}}"
                       onclick="return confirm('Ingin menghapus?');">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection


