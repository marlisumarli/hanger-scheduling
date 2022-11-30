@extends('Admin/Layout/main')
@section('content')
    <ul>
        @foreach($model['allType'] as $key => $value)
            <li>{{$value->getId()}}
                <ul>
                    <li><a href="/admin/supply/{{$value->getId()}}">buat laporan supply</a></li>
                </ul>
            </li>
        @endforeach
    </ul>
@endsection