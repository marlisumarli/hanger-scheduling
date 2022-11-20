@extends('Admin/Layout/main')
@section('content')
    <ul>
        @foreach($model['allType'] as $key => $value)
            <li><a href="/admin/supply/{{$value->getTypeId()}}">{{$value->getTypeId()}}</a></li>
        @endforeach
    </ul>
@endsection