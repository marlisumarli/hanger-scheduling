
<?php $__env->startSection('content'); ?>

    <?php if(isset($model['error'])): ?>
        <?php echo e($model['error']); ?>

    <?php endif; ?>

    <h1>Update password <?php echo e($model['username']); ?></h1>
    <form method="post">
        <label>Password
            <input type="password" required name="password">
        </label>
        <br>
        <label>Ulang password
            <input type="password" required name="repeatPassword">
        </label>
        <br>
        <button type="submit">submit</button>
        <br>
        <a href="/admin/user">Kembali</a>
    </form>

    <?php if(isset($model['success'])): ?>
        <script>
            alert('<?php echo e($model['success']); ?>');
            document.location.href = '/admin/user-update?username=<?php echo e($model['username']); ?>';
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/User/update-password.blade.php ENDPATH**/ ?>