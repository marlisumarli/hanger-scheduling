<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Admin</title>

    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" rel="stylesheet">
    <style>
        .form-signin {
            max-width: 330px;
            padding: 15px;
        }

        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
<main class="text-center form-signin w-100 m-auto">
    <form method="post">
        <h1 class="h3 mb-3 fw-normal">Login Admin</h1>

        @if (isset($error))
            <div class="alert alert-danger py-1">
                <span>{{$error}}</span>
            </div>
        @endif

        <div class="form-floating">
            <input type="text"
                   class="form-control rounded-0 rounded-top mb-1 {{isset($error) ? 'is-invalid' : ''}}"
                   id="floatingInput" autofocus
                   placeholder="Username" required name="username">
            <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating">
            <input type="password"
                   class="form-control rounded-0 rounded-bottom {{isset($error) ? 'is-invalid' : ''}}"
                   id="floatingPassword"
                   placeholder="Password" required name="password">
            <label for="floatingPassword">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Login</button>
    </form>
</main>
</body>
</html>
