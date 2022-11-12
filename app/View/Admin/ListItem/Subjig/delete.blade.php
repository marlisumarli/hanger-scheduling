@if (isset($listItem['success']))
    <script>
        alert('success');
        document.location.href = '{{$listItem["success"]}}';
    </script>
@endif