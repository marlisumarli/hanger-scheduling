@extends('Admin/Layout/main')
@section('content')
    @if (isset($model['error']))
        {{$model['error']}}
    @endif
    <form action="" method="post">
        <div><span>Edit Subjig {{$model["id"]}}</span>
            <br>
            <label for="name">Nama Subjig</label>
            <input type="text" name="name" id="name" value="{{$model["name"]}}" required>
            <br>
            <label for="qty">Qty</label>
            <input type="number" name="qty" id="qty" min="1" value="{{$model["qty"]}}" required>
            <br>
            <button type="submit">submit</button>
            <a href="/admin/list-item/subjig/{{$model["type"]}}">kembali</a>
        </div>
    </form>
    @if (isset($model['success']))
        <script>
            document.location.href = '/admin/list-item/subjig/{{$model["type"]}}';
            alert('{{$model["success"]}}');
        </script>
    @endif
@endsection