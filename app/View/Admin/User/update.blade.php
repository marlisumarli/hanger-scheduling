@extends('Admin/Layout.main')
@section('content')

    @if(isset($user['error']))
        {{$user['error']}}
    @endif
    <h1>Edit {{$user['username']}}</h1>
    <form action="" method="post">
        <label>Nama
            <input type="text" required name="name" value="{{$user['fullName']}}">
        </label>
        <br>
        <legend>Bagian:</legend>
        <div>
            <input type="radio" id="roleId" name="roleId" value="1"
            @if($user['userRole'] === 1)
                {{'checked'}}
                    @endif>
            <label for="role">Admin</label>
            <input type="radio" id="roleId" name="roleId" value="2"
            @if($user['userRole'] === 2)
                {{'checked'}}
                    @endif>
            <label for="role">Subjig</label>
        </div>
        <label>Password
            <a href="/admin/user-update-password?username={{$user['username']}}">Password Update</a>
        </label>
        <br>
        <button type="submit">submit</button>
        <a href="/admin/user">kembali</a>
    </form>
    @if(isset($user['success']))

        <script>
            alert('{{$user['success']}}');
            document.location.href = '/admin/user-update?username={{$user['username']}}';
        </script>
    @endif

@endsection