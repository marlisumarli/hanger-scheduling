<div class="page">
    <div class="sidebar bg-light shadow">
        <div class="d-flex px-2 border-bottom align-items-center p-3">
            <div class="rounded-3 shadow-lg py-2 px-2 text-primary mx-2">
                <i class="fa-solid fa-house"></i>
            </div>
            <a class="text-decoration-none" href="/admin">
                <span class="brand-name fw-bold">
                    Hanger App
                </span>
            </a>
        </div>

        <div class="sidebar-body">
            <ul class="navigation-list">
                <li class="navigation-list-item <?php echo e($model['dashboard'] ?? ''); ?>">
                    <a href="/admin" class="navigation-link">
                        <div class="row p-1 px-3 mb-2">
                            <div class="col-2">
                                <i class="fa-solid fa-house"></i>
                            </div>
                            <div class="col-9 ">
                                Dashboard
                            </div>
                        </div>
                    </a>
                </li>
                <li class="navigation-list-item <?php echo e($model['supply'] ?? ''); ?>">
                    <a href="/admin/supply" class="navigation-link">
                        <div class="row p-1 px-3 mb-2">
                            <div class="col-2">
                                <i class="fa-solid fa-paperclip"></i>
                            </div>
                            <div class="col-9">
                                Supply
                            </div>
                        </div>
                    </a>
                </li>
                <li class="navigation-list-item">
                    <a href="/admin/laporan" class="navigation-link <?php echo e($model['laporan'] ?? ''); ?>">
                        <div class="row p-1 px-3 mb-2">
                            <div class="col-2">
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                            <div class="col-9">
                                Laporan
                            </div>
                        </div>
                    </a>
                </li>
                <li class="navigation-list-item">
                    <a href="/admin/item" class="navigation-link <?php echo e($model['listItem'] ?? ''); ?>">
                        <div class="row p-1 px-3 mb-2">
                            <div class="col-2">
                                <i class="fa-solid fa-list"></i>
                            </div>
                            <div class="col-9">
                                List Item
                            </div>
                        </div>
                    </a>
                </li>
                <li class="navigation-list-item">
                    <a href="/admin/schedule" class="navigation-link <?php echo e($model['listItem'] ?? ''); ?>">
                        <div class="row p-1 px-3 mb-2">
                            <div class="col-2">
                                <i class="fa-solid fa-list"></i>
                            </div>
                            <div class="col-9">
                                Schedule
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="content">
        <div class="d-flex bg-light align-items-center shadow-sm" style="height: 72px">
            <button class="hamburger hamburger--spin sidebarToggle" id="sidebarToggle"
                    type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
            </button>

            <header class="ms-auto">
                <div class="container-fluid d-grid gap-3 align-items-center">
                    <div class="d-flex align-items-center">
                        <form class="w-100 me-3" role="search">
                            <input aria-label="Search" class="form-control" placeholder="Search..." type="search">
                        </form>

                        <div class="flex-shrink-0 dropdown">
                            <a aria-expanded="false" class="d-block link-dark text-decoration-none dropdown-toggle"
                               data-bs-toggle="dropdown" href="#">
                                <div class="avatar"
                                     data-label="<?php echo e($model['fullName'] ?? 'HA'); ?>"></div>
                            </a>
                            <ul class="dropdown-menu p-2 text-small shadow">
                                <li><a class="dropdown-item" href="/admin/user">Users</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</div>
<script>
    const avatars = document.querySelectorAll(".avatar");
    avatars.forEach(a => {
        const charCodeRed = a.dataset.label.charCodeAt(0);
        const charCodeGreen = a.dataset.label.charCodeAt(1) || charCodeRed;

        const red = Math.pow(charCodeRed, 7) % 200;
        const green = Math.pow(charCodeGreen, 7) % 200;
        const blue = (red + green) % 200;

        a.style.background = `rgb(${red}, ${green}, ${blue})`;
    });
</script>
<?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/Layout/sidebar.blade.php ENDPATH**/ ?>