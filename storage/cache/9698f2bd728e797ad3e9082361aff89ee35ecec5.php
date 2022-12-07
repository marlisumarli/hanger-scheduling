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
                    <a class="nav-link d-flex align-items-center text-dark rounded-2 mx-2 py-2 <?php echo e($model['Dashboard'] ?? ''); ?>"
                       data-bs-placement="left" data-bs-title="Dashboard" data-bs-toggle="tooltip"
                       href="/admin/dashboard">
                        <i class="fa-solid fa-house"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item py-1">
                    <a class="nav-link d-flex align-items-center text-dark rounded-2 mx-2 py-2 <?php echo e($model['Supply'] ?? ''); ?>"
                       data-bs-placement="left" data-bs-title="Supply" data-bs-toggle="tooltip"
                       href="/admin/supply">
                        <i class="fa-solid fa-check-double"></i>
                        <span>Supply</span>
                    </a>
                </li>
                <li class="nav-item py-1">
                    <a class="nav-link d-flex align-items-center text-dark rounded-2 mx-2 py-2 <?php echo e($model['List_Item'] ?? ''); ?>"
                       data-bs-placement="left" data-bs-title="List Item" data-bs-toggle="tooltip"
                       href="/admin/item">
                        <i class="fa-solid fa-list"></i>
                        <span>List Item</span>
                    </a>
                </li>
                <?php if($model['session']->getRoleId() == 1): ?>
                    <li class="nav-item py-1">
                        <a class="nav-link d-flex align-items-center text-dark rounded-2 mx-2 py-2 <?php echo e($model['Schedule'] ?? ''); ?>"
                           data-bs-placement="left" data-bs-title="Schedule" data-bs-toggle="tooltip"
                           href="/admin/schedule">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>Schedule</span>
                        </a>
                    </li>
                <?php endif; ?>

                <hr class="opacity-25 my-2 mx-2">
            </ul>
        </nav>
    </aside>

    <div class="content vw-100">
        <?php if(!isset($model['Users'])): ?>
            <header class="sticky-top d-flex bg-light align-items-center shadow-sm mb-3" id="header"
                    style="height: 51px">
                <?php endif; ?>
                <button class="btn btn-sm btn-outline-primary border-0 rounded-circle mx-2"
                        id="sidebarToggle-nav"
                        type="button">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <?php if(!isset($model['Users'])): ?>
                    <div class="ms-auto">
                        <div class="container-fluid d-grid gap-3 align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <a aria-expanded="false"
                                       class="d-block link-dark text-decoration-none dropdown-toggle"
                                       data-bs-toggle="dropdown" href="#">
                                        <div class="avatar"
                                             data-label="<?php echo e($model['full_name'] ?? 'HA'); ?>"></div>
                                    </a>
                                    <ul class="dropdown-menu p-2 text-small shadow">
                                        <?php if($model['session']->getRoleId() != 1): ?>
                                            <li><a class="dropdown-item" href="/admin/user/logout">Logout</a></li>

                                        <?php else: ?>
                                            <li><a class="dropdown-item" href="/admin/users">Users</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="/admin/user/logout">Logout</a></li>
                                        <?php endif; ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
            </header>
        <?php endif; ?>

        <main class="container-fluid px-3 py-3">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/Layout/navigation.blade.php ENDPATH**/ ?>