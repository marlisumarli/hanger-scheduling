@isset($error)
    <script>
        alert('{{$error}}');
        document.location.href = '{{$direct}}';
    </script>
@endisset
<script>
    document.location.href = '{{$direct}}';
</script>