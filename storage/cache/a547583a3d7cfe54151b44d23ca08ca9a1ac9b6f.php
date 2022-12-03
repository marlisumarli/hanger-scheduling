
<?php $__env->startSection('content-login'); ?>
    <?php if(isset($model['error'])): ?>
        <?php echo e($model['error']); ?>

    <?php endif; ?>
    <form action="" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required autofocus>
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required autofocus>
        <br>
        <button type="submit">submit</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin/Layout/login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/User/login.blade.php ENDPATH**/ ?>