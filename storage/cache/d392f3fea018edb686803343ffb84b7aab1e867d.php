<?php $__env->startSection('content'); ?>

<?php if (isset($model['error'])): ?>
    <?php echo e($model['error']); ?>

<?php endif; ?>
    <h1>Edit <?php echo e($model['username']); ?></h1>
    <form action="" method="post">
        <label>Nama
            <input type="text" required name="name" value="<?php echo e($model['fullName']); ?>">
        </label>
        <br>
        <legend>Bagian:</legend>
        <div>
            <input type="radio" id="roleId" name="roleId" value="1"
                <?php if ($model['userRole'] === 1): ?>
                    <?php echo e('checked'); ?>

                <?php endif; ?>>
            <label for="role">Admin</label>
            <input type="radio" id="roleId" name="roleId" value="2"
                <?php if ($model['userRole'] === 2): ?>
                    <?php echo e('checked'); ?>

                <?php endif; ?>>
            <label for="role">Subjig</label>
        </div>
        <label>Password
            <a href="/admin/user-update-password?username=<?php echo e($model['username']); ?>">Password Update</a>
        </label>
        <br>
        <button type="submit">submit</button>
        <a href="/admin/user">kembali</a>
    </form>
<?php if (isset($model['success'])): ?>

    <script>
        alert('<?php echo e($model['success']); ?>');
        document.location.href = '/admin/user-update?username=<?php echo e($model['username']); ?>';
    </script>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/User/update.blade.php ENDPATH**/ ?>