@extends('Admin/Layout/main')
@section('content')
    @if (isset($category['error']))
        {{$category['error']}}
    @endif

    <form method="post">
        <div><span>Subjig K2F</span>
            <label for="id">Id</label>
            <input type="text" name="id" id="id" required>
            <br>
            <label for="name">Nama Subjig</label>
            <input type="text" name="name" id="name" required>
            <br>
            <label for="qty">Qty</label>
            <input type="number" name="qty" id="qty" min="1" required>
            <br>
            <hr>
            <button type="submit">submit</button>
        </div>
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