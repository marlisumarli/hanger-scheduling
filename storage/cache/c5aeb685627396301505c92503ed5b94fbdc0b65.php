<div class="d-flex hide" id="page">
    <div id="sidebarAssistance"></div>
    <aside class="position-fixed bg-light border shadow vh-100 hide" id="sidebar">
        <header class="border-bottom p-2 mb-3">
            <button class="btn btn-sm btn-outline-primary border-0 rounded-circle mx-2"
                    id="sidebarToggle"
                    type="button">
                <i class="fa-solid fa-bars" id="icon-toggle"></i>
            </button>
            <a class="text-decoration-none" href="">
                <span class="fw-bold">
                    Hanger App
                </span>
            </a>
        </header>

        <nav class="d-flex">
            <ul class="nav flex-column w-100">
                <li class="nav-item py-1">
                    <a class="nav-link d-flex align-items-center text-dark rounded-2 mx-2 py-2 <?php echo e($model['dashboard'] ?? ''); ?>"
                       href="/admin/dashboard">
                        <i class="fa-solid fa-house"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item py-1">
                    <a class="nav-link d-flex align-items-center text-dark rounded-2 mx-2 py-2 <?php echo e($model['supply'] ?? ''); ?>"
                       href="/admin/supply">
                        <i class="fa-solid fa-trailer"></i>
                        <span>Supply</span>
                    </a>
                </li>
                <li class="nav-item py-1">
                    <a class="nav-link d-flex align-items-center text-dark rounded-2 mx-2 py-2 <?php echo e($model['List Item'] ?? ''); ?>"
                       href="/admin/item">
                        <i class="fa-solid fa-list"></i>
                        <span>List Item</span>
                    </a>
                </li>
                <li class="nav-item py-1">
                    <a class="nav-link d-flex align-items-center text-dark rounded-2 mx-2 py-2 <?php echo e($model['Schedule'] ?? ''); ?>"
                       href="/admin/schedule">
                        <i class="fa-solid fa-list"></i>
                        <span>Schedule</span>
                    </a>
                </li>
                <hr class="opacity-25 my-2 mx-2">
            </ul>
        </nav>
    </aside>

    <div class="content vw-100">
        <header class="sticky-top d-flex bg-light align-items-center shadow-sm mb-3" id="header"
                style="height: 51px">
            <button class="btn btn-sm btn-outline-primary border-0 rounded-circle mx-2"
                    id="sidebarToggle-nav"
                    type="button">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="ms-auto">
                <div class="container-fluid d-grid gap-3 align-items-center">
                    <div class="d-flex align-items-center">
                        <form class="w-100 me-3" role="search">
                            <input aria-label="Search" class="form-control" placeholder="Search..." type="search">
                        </form>

                        <div class="flex-shrink-0">
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
                                <li><a class="dropdown-item" href="/admin/user/logout">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="container-fluid px-5 py-3">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/Layout/sidebar.blade.php ENDPATH**/ ?>