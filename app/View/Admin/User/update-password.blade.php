@extends('Admin/Layout.main')
@section('content')

    @if(isset($user['error']))
        {{$user['error']}}
    @endif
    
    <h1>Update password {{$user['username']}}</h1>
    <form method="post">
        <label>Password
            <input type="password" required name="password">
        </label>
        <br>
        <label>Ulang password
            <input type="password" required name="repeatPassword">
        </label>
        <br>
        <button type="submit">submit</button>
        <br>
        <a href="/admin/user">Kembali</a>
    </form>

    @if(isset($user['success']))
        <script>
            alert('{{$user['success']}}');
            document.location.href = '/admin/user-update?username={{$user['username']}}';
        </script>
    @endif
@endsection