@if (isset($user['success']))
    <script>
        alert('success');
        document.location.href = '{{$user["success"]}} ';
    </script>
@endif