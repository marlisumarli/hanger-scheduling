<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>{{$model['title'] ?? 'Hanger | Admin'}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/a09b11b4b2.js"></script>
    <style>
        .avatar {
            font-size: 14px;
            font-weight: 550;
            width: 2.5em;
            height: 2.5em;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .avatar::after {
            content: attr(data-label);
            color: white;
        }

        * {
            font-family: 'DM Sans', sans-serif;
        }

        body {
            background-color: #e6e6e6;
        }

        body.active .page .sidebar {
            left: 0;
        }

        body.active .page .content {
            margin-left: 200px;
        }

        .page .sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            width: 200px;
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
            transition: all ease .3s;
        }

        .page .content {
            margin-left: 0;
            transition: all ease .3s;
        }

        .sidebarToggle {
            color: #F59E0B;
            margin-left: 10px;
        }

        .sidebarToggle.active {
            margin-left: -5px;
        }

        .brand-name {
            color: #111827;
        }

        .navigation-list {
            list-style-type: none;
            padding: 0 10px;
            margin-top: 20px;
        }

        .navigation-list-item {
            margin: 5px 0;
            border-radius: 8px;
        }

        .navigation-list-item:hover {
            background: rgb(0, 0, 0, 0.05);
            cursor: pointer;
        }

        .navigation-list-item.active {
            background: #F59E0B;
        }

        .navigation-link {
            color: #111827;
            letter-spacing: 1px;
            text-decoration: none;
            font-size: 14px;
        }

        .navigation-link i {
            font-size: 14px;
        }

        .navigation-list-item:hover .navigation-link {
            color: #111827;
        }

        .navigation-list-item.active .navigation-link {
            color: #FFFFFF;
            font-weight: 540
        }

        .dropdown-item:hover {
            background: #F59E0B !important;
            color: #FFFFFF !important;
            border-radius: 8px;
        }

        .hamburger {
            padding: 5px 15px;
            display: inline-block;
            cursor: pointer;
            transition-property: opacity, filter;
            transition-duration: 0.15s;
            transition-timing-function: linear;
            font: inherit;
            color: inherit;
            text-transform: none;
            background-color: transparent;
            border: 0;
            margin: 0;
            overflow: visible;
        }

        .hamburger:hover {
            opacity: 0.7;
        }

        .hamburger.active:hover {
            opacity: 0.7;
        }

        .hamburger.active .hamburger-inner,
        .hamburger.active .hamburger-inner::before,
        .hamburger.active .hamburger-inner::after {
            background-color: #0d6efd;
        }

        .hamburger-box {
            width: 15px;
            height: 5px;
            display: inline-block;
            position: relative;
        }

        .hamburger-inner {
            display: block;
            top: 50%;
            margin-top: -2px;
        }

        .hamburger-inner, .hamburger-inner::before, .hamburger-inner::after {
            width: 15px;
            height: 2px;
            background-color: #F59E0B;
            border-radius: 4px;
            position: absolute;
            transition-property: transform;
            transition-duration: 0.15s;
            transition-timing-function: ease;
        }

        .hamburger-inner::before, .hamburger-inner::after {
            content: "";
            display: block;
        }

        .hamburger-inner::before {
            top: -5px;
        }

        .hamburger-inner::after {
            bottom: -5px;
        }

        .hamburger--spin .hamburger-inner {
            transition-duration: 0.22s;
            transition-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
        }

        .hamburger--spin .hamburger-inner::before {
            transition: top 0.1s 0.25s ease-in, opacity 0.1s ease-in;
        }

        .hamburger--spin .hamburger-inner::after {
            transition: bottom 0.1s 0.25s ease-in, transform 0.22s cubic-bezier(0.55, 0.055, 0.675, 0.19);
        }

        .hamburger--spin.active .hamburger-inner {
            transform: rotate(225deg);
            transition-delay: 0.12s;
            transition-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
        }

        .hamburger--spin.active .hamburger-inner::before {
            top: 0;
            opacity: 0;
            transition: top 0.1s ease-out, opacity 0.1s 0.12s ease-out;
        }

        .hamburger--spin.active .hamburger-inner::after {
            bottom: 0;
            transform: rotate(-90deg);
            transition: bottom 0.1s ease-out, transform 0.22s 0.12s cubic-bezier(0.215, 0.61, 0.355, 1);
        }
    </style>

</head>

<body>
@include('Admin/Layout/sidebar')
<script src="https://code.jquery.com/jquery-3.6.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"
        crossorigin="anonymous"></script>

<script>
    const active = "active";
    const lsKey = "sidebar";
    const body = document.querySelector("body");
    const toggleSidebar = document.querySelector("#sidebarToggle");
    if (localStorage.getItem(lsKey) === "true") {
        body.classList.add(active);
        toggleSidebar.classList.add(active);
    }
    toggleSidebar.addEventListener("click", () => {
        body.classList.toggle(active);
        toggleSidebar.classList.toggle(active);
        localStorage.setItem(lsKey, body.classList.contains(active));
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>

</body>
</html>
