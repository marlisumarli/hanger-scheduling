@if (isset($category['success']))
    <script>
        alert('success');
        document.location.href = '{{$category["success"]}}';
    </script>
@endif