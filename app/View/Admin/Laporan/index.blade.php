@extends('Admin/Layout/main')
@section('content')
    <ul>
        @foreach($model['allType'] as $key => $value)
            <li>
                {{$value->getTypeId()}}
                <ul>
                    <li>
                        <a href="/admin/laporan/{{$value->getTypeId()}}/supply">Supply</a>
                    </li>
                </ul>
            </li>
        @endforeach
    </ul>
@endsection