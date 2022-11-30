<?php $__env->startSection('content'); ?>
<?php if (isset($model['error'])): ?>
    <?php echo e($model['error']); ?>

<?php endif; ?>
    <form action="" method="post">
        <div><span>Edit Subjig <?php echo e($model["id"]); ?></span>
            <br>
            <label for="name">Nama Subjig</label>
            <input type="text" name="name" id="name" value="<?php echo e($model["name"]); ?>" required>
            <br>
            <label for="qty">Qty</label>
            <input type="number" name="qty" id="qty" min="1" value="<?php echo e($model["qty"]); ?>" required>
            <br>
            <button type="submit">submit</button>
            <a href="/admin/list-item/subjig/<?php echo e($model["type"]); ?>">kembali</a>
        </div>
    </form>
<?php if (isset($model['success'])): ?>
    <script>
        document.location.href = '/admin/list-item/subjig/<?php echo e($model["type"]); ?>';
        alert('<?php echo e($model["success"]); ?>');
    </script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/Item/Hanger/update.blade.php ENDPATH**/ ?>