@extends('Admin/Layout.main')
@section('content')

    @if(isset($user['error']))
        {{$user['error']}}
    @endif

    <form action="/admin/user-create" method="post">
        <label>Nama
            <input type="text" required name="name">
        </label>
        <br>
        <legend>Bagian:</legend>
        <div>
            <label for="roleId">Admin</label>
            <input type="radio" id="roleId" name="roleId"
                   value="1">
            <label for="roleId">Subjig</label>
            <input type="radio" id="roleId" name="roleId"
                   value="2"
                   checked>
        </div>
        <label>Username
            <input type="text" required name="username">
        </label>
        <br>
        <label>Password
            <input type="password" required name="password">
        </label>
        <br>
        <button type="submit">submit</button>
        <a href="/admin/user">kembali</a>
    </form>
  
    @if(isset($user['success']))
        <script>
            alert('{{$user['success']}}');
            document.location.href = '/admin/user-create';
        </script>
    @endif
@endsection

