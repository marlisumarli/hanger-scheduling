
<?php $__env->startSection('content'); ?>
    <main>
        <h1>Hallo <?php echo e($model['fullName']); ?></h1>
        <hr>
        <h1>Dashboard</h1>
        <ul>
            <li><a href="/admin/supply">Supply</a></li>
            <li><a href="">Perbaikan</a></li>
            <li><a href="">Subjig Baru</a></li>
            <li><a href="/admin/laporan">Laporan</a></li>
            <li><a href="/admin/list-item">Daftar Subjig / Mainjig / Messboat</a></li>
        </ul>
        <br>
        <ul>
            <?php if($model['roleId'] === 1): ?>
                <li><a href="/admin/user">User</a></li>
            <?php endif; ?>
            <li><a href="/admin/user/logout">Logout</a></li>
        </ul>
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/Home/index.blade.php ENDPATH**/ ?>