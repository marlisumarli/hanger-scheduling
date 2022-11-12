<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>{{$model['title'] ?? 'Subjig | Admin'}}</title>
</head>

<body>
@include('Admin/Partial/navlogin')
@yield('content-login')
<script src="/src/js/index.js"></script>
</body>
</html>
