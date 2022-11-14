@extends('Admin/Layout/login')
@section('content-login')
    @if (isset($model['error']))
        {{$model['error']}}
    @endif
    <form action="" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required autofocus>
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required autofocus>
        <br>
        <button type="submit">submit</button>
    </form>
@endsection
