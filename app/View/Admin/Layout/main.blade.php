<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/a09b11b4b2.js"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400&display=swap"
          rel="stylesheet">
    <title>{{$model['Title'] ?? 'Hanger | Admin'}}</title>
    <style>
        :root {
            --sidebar-size: 250px;
            --sidebar-size-hide: 70px;
        }

        /** Custom Bootstrap
        */

        .bg-warning {
            background: #F59E0B !important;
        }

        /** Custom Bootstrap
         */

        ::-webkit-scrollbar {
            width: 0;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            display: none;
        }

        .avatar {
            font-size: 16px;
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
            background-color: rgb(243 244 246);
        }

        #sidebarToggle-nav {
            display: none;
        }

        #sidebar {
            width: var(--sidebar-size);
            transition: all ease .3s;
            z-index: 100;
        }


        #page.hide #sidebar {
            width: var(--sidebar-size-hide);
            transition: all ease .3s;
        }

        #page.hide .content {
            margin-left: var(--sidebar-size-hide);
            transition: all ease .3s;
        }

        .content {
            margin-left: var(--sidebar-size);
            transition: all ease .3s;
        }

        aside header i {
            font-size: 20px;
            margin-top: 3px;
        }

        aside header a span {
            margin-left: .3rem;
            color: #111827;
            font-size: 16px;
            transition: all ease .3s;
        }

        aside.hide header a span {
            margin-left: -300px;
            transition: all ease .3s;
        }

        aside nav ul li a span {
            margin-left: 1.5rem;
            transition: all ease .3s;
        }

        aside.hide nav ul li a span {
            margin-left: -300px;
            transition: all ease .3s;
        }

        nav ul li a.active span {
            color: #FFFFFF;
        }

        nav ul li a.active svg {
            color: #FFFFFF;
        }

        nav ul li a.active i {
            color: #FFFFFF;
        }

        .nav-link:hover {
            background: rgb(0, 0, 0, 0.05);
            cursor: pointer;
        }

        .nav-link {
            font-size: 14px;
        }

        .navbar-collapse i {
            font-size: small;
            margin-top: 5px;
            transition: all ease .2s;
        }

        .navbar-collapse.show i {
            font-size: small;
            margin-bottom: 5px;
            rotate: -180deg;
            transition: all ease .2s;
        }

        .dropdown-item:hover {
            background: #F59E0B !important;
            color: #FFFFFF !important;
            border-radius: 8px;
        }


        table.table-subjig thead tr.c-border th {
            border: 1px solid #dee2e6 !important;
        }

        table.table-subjig tbody tr.c-border td {
            border: 1px solid #dee2e6 !important;
        }

        #logout:hover {
            color: #0d6efd !important;
        }


        @media (max-width: 767px) {

            #header {
                z-index: 99;
            }

            aside header a {
                font-size: 23px;
            }

            #sidebar {
                width: 250px;
                left: 0;
                transition: all ease 0.3s;
            }

            #page.hide #sidebar {
                width: 250px;
                left: -300px;
                transition: all ease .3s;
            }

            #page.hide .content {
                margin-left: 0;
            }

            .content {
                margin-left: 0;
                transition: all ease .3s;
            }

            #sidebarToggle {
                display: none;
            }

            #sidebarToggle-nav {
                display: block;
                font-size: 18px;
            }

            #page.hide #sidebarAssistance {
                background: rgba(0, 0, 0, 0.2);
                margin-left: -900px;
                height: 100vh;
                transition: all ease .3s;
            }

            #sidebarAssistance {
                background: rgba(0, 0, 0, 0.2);
                margin-left: auto;
                width: 800px;
                position: fixed;
                height: 100vh;
                transition: all ease .3s;
                z-index: 100;
            }
        }
    </style>

</head>

<body>
@include('Admin/Layout/navigation')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
<script>

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    const avatars = document.querySelectorAll(".avatar");
    avatars.forEach(a => {
        const charCodeRed = a.dataset.label.charCodeAt(0);
        const charCodeGreen = a.dataset.label.charCodeAt(1) || charCodeRed;

        const red = Math.pow(charCodeRed, 7) % 200;
        const green = Math.pow(charCodeGreen, 7) % 200;
        const blue = (red + green) % 200;

        a.style.background = `rgb(${red}, ${green}, ${blue})`;
    });

    const sidebar = document.querySelector("#sidebar");
    const page = document.querySelector("#page");
    const toggleSidebar = document.querySelector("#sidebarToggle");
    const toggleSidebarNav = document.querySelector("#sidebarToggle-nav");
    const iconToggle = document.querySelector("#icon-toggle");
    const sidebarAssistance = document.querySelector("#sidebarAssistance");

    toggleSidebar.addEventListener("click", () => {
        page.classList.toggle('hide');
        sidebar.classList.toggle('hide');
        iconToggle.classList.toggle('fa-outdent');
    });

    toggleSidebarNav.addEventListener("click", () => {
        page.classList.toggle('hide');
        sidebar.classList.toggle('hide');
        iconToggle.classList.toggle('fa-outdent');
    });
    sidebarAssistance.addEventListener("click", () => {
        page.classList.toggle('hide');
        sidebar.classList.toggle('hide');
    });
</script>
</body>
</html>
