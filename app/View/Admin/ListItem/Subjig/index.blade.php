@extends('Admin/Layout/main')
@section('content')
    <form action="" method="post">
        <label for="id">Id</label>
        <input type="text" name="id" id="id" title="Huruf kapital"
               pattern="[A-Z0-9]{1,}"
               required="required">
        <br>
        <label for="qty">Quantity</label>
        <input type="number" name="qty" id="qty"
               min="1"
               required="required">
        <button type="submit">submit</button>
    </form>
    <hr>

    <ul>
        @foreach($model['allType'] as $key => $type)
            <li><a href="/admin/subjig/{{$type->getTypeId()}}">{{$type->getTypeId()}}</a>&emsp;{{$type->getTypeQty()}}
                Item <a href="">edit</a>
            </li>
        @endforeach
    </ul>
@endsection
