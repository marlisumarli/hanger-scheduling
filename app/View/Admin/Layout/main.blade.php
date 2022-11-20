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

<script>
    //    Generate sequence number
    const generate = document.getElementById('generate');
    const id = document.querySelectorAll('.order');
    const makeArray = (count, content) => {
        const result = [];
        if (typeof content === "function") {
            for (let i = 0; i < count; i++) {
                result.push(content(i));
            }
        }
        return result;
    }
    generate.addEventListener('click', () => {
        makeArray(id.length, (i) => {
            return id[i].value = i + 1;
        });
    });
</script>
</body>
</html>
