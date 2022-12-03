<?php $__env->startSection('content'); ?>
<?php if (isset($model['error'])): ?>
    <?php echo e($model['error']); ?>

<?php endif; ?>

    <form action="/admin/categories-update-name-category?id=<?php echo e($model['id']); ?>" method="post">
        <div><span>Edit Category <?php echo e($model['id']); ?></span>
            <br>
            <label for="name">Nama Category</label>
            <input type="text" name="name" id="name" value="<?php echo e($model['name']); ?>" required>
            <button type="submit">submit</button>
        </div>
    </form>
    <br>
    <form action="/admin/categories-update-id-category?id=<?php echo e($model['id']); ?>" method="post">
        <div>
            <label for="newId">New ID</label>
            <input type="text" name="newId" id="newId" value="<?php echo e($model['id']); ?>" required>
            <button type="submit">submit</button>
            <br>
            <a href="/admin/categories">kembali</a>
        </div>
    </form>

<?php if (isset($model['success'])): ?>
    <script>
        alert('<?php echo e($model["success"]); ?>');
        document.location.href = '/admin/categories';
    </script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/Category/view.blade.php ENDPATH**/ ?>