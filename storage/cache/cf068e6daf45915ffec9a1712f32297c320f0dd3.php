<?php $__env->startSection('content'); ?>
<ul>
    <?php $__currentLoopData = $model['allType'];
    $__env->addLoop($__currentLoopData);
    foreach ($__currentLoopData as $key => $value): $__env->incrementLoopIndices();
        $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($value->getId()); ?>

            <ul>
                <li><a href="/admin/supply/<?php echo e($value->getId()); ?>">buat laporan supply</a></li>
            </ul>
        </li>
    <?php endforeach;
    $__env->popLoop();
    $loop = $__env->getLastLoop(); ?>
</ul>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/Supply/index.blade.php ENDPATH**/ ?>