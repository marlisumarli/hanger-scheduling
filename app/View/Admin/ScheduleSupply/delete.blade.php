@if(isset($model['success']))
    <script>
        window.location.href = '{{$model['success']}}';
    </script>
@endif