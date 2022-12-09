@if(isset($success))
    <script>
        window.location.href = '{{$success}}';
    </script>
@endif