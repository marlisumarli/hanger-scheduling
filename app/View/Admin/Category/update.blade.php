@extends('Admin/Layout/main')
@section('content')
    @if (isset($category['error']))
        {{$category['error']}}
    @endif

    <form action="/admin/categories-update-name-category?id={{$category['id']}}" method="post">
        <div><span>Edit Category {{$category['id']}}</span>
            <br>
            <label for="name">Nama Category</label>
            <input type="text" name="name" id="name" value="{{$category['name']}}" required>
            <button type="submit">submit</button>
        </div>
    </form>
    <br>
    <form action="/admin/categories-update-id-category?id={{$category['id']}}" method="post">
        <div>
            <label for="newId">New ID</label>
            <input type="text" name="newId" id="newId" value="{{$category['id']}}" required>
            <button type="submit">submit</button>
            <br>
            <a href="/admin/categories">kembali</a>
        </div>
    </form>
    
    @if (isset($category['success']))
        <script>
            alert('{{ $category["success"] }}');
            document.location.href = '/admin/categories';
        </script>
    @endif
@endsection