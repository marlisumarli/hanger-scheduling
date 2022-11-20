@extends('Admin/Layout/main')
@section('content')
    @if (isset($model['error']))
        {{$model['error']}}
    @endif
    <form action="/admin/list-item/subjig" method="post">
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
                Item
                <form action="/admin/list-item/subjig-update?id={{$type->getTypeId()}}" method="post">
                    <label for="id">Id</label>
                    <input type="text" name="newId" id="id" title="Huruf kapital"
                           pattern="[A-Z0-9]{1,}"
                           required="required"
                           value="{{$type->getTypeId()}}">
                    <button name="updateId" type="submit">update id</button>
                </form>
                <form action="/admin/list-item/subjig-update?id={{$type->getTypeId()}}" method="post">
                    <label for="qty">Quantity</label>
                    <input type="number" name="qty" id="qty"
                           min="1"
                           required="required" value="{{$type->getTypeQty()}}">
                    <button name="updateQty" type="submit">update qty</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
