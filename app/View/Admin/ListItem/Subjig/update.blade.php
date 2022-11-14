@extends('Admin/Layout/main')
@section('content')
    @if (isset($listItem['error']))
        {{$listItem['error']}}
    @endif
    <form action="" method="post">
        <div><span>Edit Subjig {{$listItem["id"]}}</span>
            <br>
            <label for="name">Nama Subjig</label>
            <input type="text" name="name" id="name" value="{{$listItem["name"]}}" required>
            <br>
            <label for="qty">Qty</label>
            <input type="number" name="qty" id="qty" min="1" value="{{$listItem["qty"]}}" required>
            <br>
            <button type="submit">submit</button>
            <a href="/admin/list-item/subjig/{{$listItem["type"]}}">kembali</a>
        </div>
    </form>
    @if (isset($listItem['success']))
        <script>
            document.location.href = '/admin/list-item/subjig/{{$listItem["type"]}}';
            alert('{{$listItem["success"]}}');
        </script>
    @endif
@endsection