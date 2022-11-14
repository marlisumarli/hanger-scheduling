<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>{{$model['title'] ?? 'Subjig | Admin'}}</title>
</head>

<body>
@include('Admin/Partial/navbar')
@yield('content')
<script src="https://code.jquery.com/jquery-3.6.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"
        crossorigin="anonymous"></script>

<script src="/js/app.js"></script>
</body>
</html>
