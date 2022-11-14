
<?php $__env->startSection('content'); ?>
    <?php if(isset($model['error'])): ?>
        <?php echo e($model['error']); ?>

    <?php endif; ?>

    <form method="post">
        <div><span>Categories</span>
            <br>
            <label for="id">Id</label>
            <input type="text" name="categoryId" id="id" required>
            <br>
            <label for="categoryName">Nama Category</label>
            <input type="text" name="categoryName" id="categoryName" required>
            <br>
            <button type="submit">submit</button>
            <a href="/admin">kembali</a>
        </div>
    </form>

    <?php $__currentLoopData = $model['allCategory']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div>
        <span>
        <?php echo e($key + 1); ?>

        </span>
            <h1><?php echo e($value->getCategoryId()); ?></h1>
            <h2><?php echo e($value->getCategoryName()); ?> </h2>
            <h2><?php echo e($value->getCreatedAt()); ?></h2>
            <h2><?php echo e($value->getupdatedAt()); ?></h2>
            <a href="/admin/categories-update?id=<?php echo e($value->getCategoryId()); ?>">Edit</a>
            <a href="/admin/categories-delete?id=<?php echo e($value->getCategoryId()); ?>"
               onclick="return confirm('Ingin menghapus?');">Delete</a>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/Category/index.blade.php ENDPATH**/ ?>