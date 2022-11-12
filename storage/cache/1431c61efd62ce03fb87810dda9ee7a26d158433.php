
<?php $__env->startSection('content'); ?>

    <?php if(isset($user['error'])): ?>
        <?php echo e($user['error']); ?>

    <?php endif; ?>
    
    <h1>Update password <?php echo e($user['username']); ?></h1>
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

    <?php if(isset($user['success'])): ?>
        <script>
            alert('<?php echo e($user['success']); ?>');
            document.location.href = '/admin/user-update?username=<?php echo e($user['username']); ?>';
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/User/update-password.blade.php ENDPATH**/ ?>