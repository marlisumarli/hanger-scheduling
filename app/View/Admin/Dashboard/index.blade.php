@extends('Admin/Layout/main')
@section('content')
    Hallo
    {{$model['session']->getUsername()}} !
@endsection