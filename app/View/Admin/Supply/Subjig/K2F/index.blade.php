@extends('Admin/Layout/main')
@section('content')
    @if(isset($model['error']))
        {{$model['error']}}
    @endif

    <form method="post">
        <label for="date">Tanggal</label>
        <input type="date" name="date" id="date" value="">

        <label for="target">Update Target Supply</label>
        <input type="number" name="target" id="target" min="100" value="700" required="required">

        <br>
        @foreach ($model['allK2f'] as $key => $value)
            <label for="">{{$value->getK2fName()}}</label>
            <input type="number" name="k2fLnA[]" value="0" min="0">
            <input type="number" name="k2fLnB[]" value="0" min="0">
            <input type="number" name="k2fLnC[]" value="0" min="0">
            <br>
        @endforeach
        <button type="submit">submit</button>
    </form>
    @if (isset($model['success']))
        <script>
            alert('success');
            document.location.href = '{{$model["success"]}}';
        </script>
    @endif
@endsection