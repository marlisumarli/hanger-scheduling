<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>{{$model['title'] ?? 'Hanger | Admin'}}</title>
</head>

<body>
@include('Admin/Layout/navlogin')
@yield('content-login')
</body>
</html>
