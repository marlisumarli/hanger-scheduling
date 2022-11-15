@extends('Admin/Layout/main')
@section('content')
    <main>
        <h1>Hallo {{$model['fullName']}}</h1>
        <hr>
        <h1>Dashboard</h1>
        <ul>
            <li><a href="/admin/supply">Supply</a></li>
            <li><a href="/admin/laporan">Laporan</a></li>
            <li><a href="/admin/list-item">Daftar Subjig</a></li>
        </ul>
        <br>
        <ul>
            @if ($model['roleId'] === 1)
                <li><a href="/admin/user">User</a></li>
            @endif
            <li><a href="/admin/user/logout">Logout</a></li>
        </ul>
    </main>
@endsection