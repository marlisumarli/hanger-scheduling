@extends('Admin/Layout/main')
@section('content')

    <form method="post">
        @foreach($model['allDate'] as $key => $value)
            <div id="m1">

            </div>
        @endforeach

        <div id="submit">
            <button type="submit" disabled>submit</button>
        </div>
    </form>
    <hr>

    <script type="text/javascript">
    </script>

@endsection
