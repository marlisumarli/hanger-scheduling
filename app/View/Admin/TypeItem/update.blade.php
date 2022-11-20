@if (isset($model['error']))
    <script>
        alert({{$model['error']}});
    </script>
@endif
<script>
    alert('success');
    document.location.href = '{{$model["success"]}}';
</script>