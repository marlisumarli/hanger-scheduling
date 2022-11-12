
<?php $__env->startSection('content'); ?>
    <?php if(isset($category['error'])): ?>
        <?php echo e($category['error']); ?>

    <?php endif; ?>

    <?php if(isset($listItem['success'])): ?>
        <script>
            document.location.href = '/admin/list-item/subjig/<?php echo e($listItem["type"]); ?>';
            alert('<?php echo e($listItem["success"]); ?>');
        </script>
    <?php endif; ?>
    <form method="post">
        <div><span>Edit Subjig <?php echo e($listItem["id"]); ?></span>
            <br>
            <label for="name">Nama Subjig</label>
            <input type="text" name="name" id="name" value="<?php echo e($listItem["name"]); ?>" required>
            <br>
            <label for="qty">Qty</label>
            <input type="number" name="qty" id="qty" min="1" value="<?php echo e($listItem["qty"]); ?>" required>
            <br>
            <button type="submit">submit</button>
            <a href="/admin/list-item/subjig/<?php echo e($listItem["type"]); ?>">kembali</a>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/ListItem/Subjig/update.blade.php ENDPATH**/ ?>