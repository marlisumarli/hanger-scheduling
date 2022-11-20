@if (isset($model['error']))
    <script>
        alert("! {{$model['error']}} !");
        document.location.href = "{{$model['direct']}}";
    </script>
@endif
@if (isset($model['success']))
    <script>
        alert('success');
        document.location.href = '{{$model["success"]}}';
    </script>
@endif