@extends('Admin/Layout/main')
@section('content')
    @if(isset($model['error']))
        {{$model['error']}}
    @endif
    @if (isset($model['success']))
        <script>
            alert('success');
            document.location.href = '{{$model["success"]}}';
        </script>
    @endif

    <form method="post">
        <label for="target">Update Target Supply</label>
        <input type="number" name="target" id="target" min="100" required="required">

        <br>
        @foreach ($model['allSubjig'] as $key => $value)
            <label for="">{{$value->getHangerName()}}</label>
            <input type="number" name="lnA[]" value="0" min="0">
            <input type="number" name="lnB[]" value="0" min="0">
            <input type="number" name="lnC[]" value="0" min="0">
            <br>
        @endforeach
        <button type="submit">submit</button>
    </form>
@endsection