
<?php $__env->startSection('content'); ?>
    <?php if(isset($category['error'])): ?>
        <?php echo e($category['error']); ?>

    <?php endif; ?>

    <form action="/admin/categories-update-name-category?id=<?php echo e($category['id']); ?>" method="post">
        <div><span>Edit Category <?php echo e($category['id']); ?></span>
            <br>
            <label for="name">Nama Category</label>
            <input type="text" name="name" id="name" value="<?php echo e($category['name']); ?>" required>
            <button type="submit">submit</button>
        </div>
    </form>
    <br>
    <form action="/admin/categories-update-id-category?id=<?php echo e($category['id']); ?>" method="post">
        <div>
            <label for="newId">New ID</label>
            <input type="text" name="newId" id="newId" value="<?php echo e($category['id']); ?>" required>
            <button type="submit">submit</button>
            <br>
            <a href="/admin/categories">kembali</a>
        </div>
    </form>
    
    <?php if(isset($category['success'])): ?>
        <script>
            alert('<?php echo e($category["success"]); ?>');
            document.location.href = '/admin/categories';
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/Category/update.blade.php ENDPATH**/ ?>