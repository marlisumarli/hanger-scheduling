@extends('Admin/Layout.main')
@section('content')

    @if(isset($model['error']))
        {{$model['error']}}
    @endif
    <h1>Edit {{$model['username']}}</h1>
    <form action="" method="post">
        <label>Nama
            <input type="text" required name="name" value="{{$model['fullName']}}">
        </label>
        <br>
        <legend>Bagian:</legend>
        <div>
            <input type="radio" id="roleId" name="roleId" value="1"
            @if($model['userRole'] === 1)
                {{'checked'}}
                    @endif>
            <label for="role">Admin</label>
            <input type="radio" id="roleId" name="roleId" value="2"
            @if($model['userRole'] === 2)
                {{'checked'}}
                    @endif>
            <label for="role">Subjig</label>
        </div>
        <label>Password
            <a href="/admin/user-update-password?username={{$model['username']}}">Password Update</a>
        </label>
        <br>
        <button type="submit">submit</button>
        <a href="/admin/user">kembali</a>
    </form>
    @if(isset($model['success']))

        <script>
            alert('{{$model['success']}}');
            document.location.href = '/admin/user-update?username={{$model['username']}}';
        </script>
    @endif

@endsection