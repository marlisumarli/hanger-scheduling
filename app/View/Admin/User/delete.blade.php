@if (isset($success))
    <script>
        alert('success');
        document.location.href = '{{$success}}';
    </script>
@endif