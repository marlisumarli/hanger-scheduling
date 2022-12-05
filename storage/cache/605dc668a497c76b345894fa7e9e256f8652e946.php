
<?php $__env->startSection('content'); ?>
    Hallo
    <?php echo e($model['session']->getUsername()); ?> !
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/Dashboard/index.blade.php ENDPATH**/ ?>