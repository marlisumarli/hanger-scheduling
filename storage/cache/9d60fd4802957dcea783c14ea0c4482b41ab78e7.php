
<?php $__env->startSection('content'); ?>

    <?php if(isset($user['error'])): ?>
        <?php echo e($user['error']); ?>

    <?php endif; ?>

    <form action="/admin/user-create" method="post">
        <label>Nama
            <input type="text" required name="name">
        </label>
        <br>
        <legend>Bagian:</legend>
        <div>
            <label for="roleId">Admin</label>
            <input type="radio" id="roleId" name="roleId"
                   value="1">
            <label for="roleId">Subjig</label>
            <input type="radio" id="roleId" name="roleId"
                   value="2"
                   checked>
        </div>
        <label>Username
            <input type="text" required name="username">
        </label>
        <br>
        <label>Password
            <input type="password" required name="password">
        </label>
        <br>
        <button type="submit">submit</button>
        <a href="/admin/user">kembali</a>
    </form>
  
    <?php if(isset($user['success'])): ?>
        <script>
            alert('<?php echo e($user['success']); ?>');
            document.location.href = '/admin/user-create';
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('Admin/Layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/User/create.blade.php ENDPATH**/ ?>