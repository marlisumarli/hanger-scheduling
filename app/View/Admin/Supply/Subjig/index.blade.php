@extends('Admin/Layout/main')
@section('content')
    @if(isset($model['error']))
        {{$model['error']}}
    @endif

    <form method="post">
        <label for="date">Tanggal</label>
        <input type="date" name="date" id="date" value="">
        <script>
            document.getElementById("date").valueAsDate = new Date()
        </script>
        <label for="target">Update Target Supply</label>
        <input type="number" name="target" id="target" min="100" value="300" required="required">

        <br>
        @foreach ($model['allSubjig'] as $key => $value)
            <label for="">{{$value->getSubjigName()}}</label>
            <input type="number" name="lnA[]" value="0" min="0">
            <input type="number" name="lnB[]" value="0" min="0">
            <input type="number" name="lnC[]" value="0" min="0">
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