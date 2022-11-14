
<?php $__env->startSection('content'); ?>
    <?php if(isset($model['error'])): ?>
        <?php echo e($model['error']); ?>

    <?php endif; ?>

    <form action="" method="post">

        <label for="date">Tanggal</label>
        <input type="date" name="date" id="date" value="">
        <br>
        <?php $__currentLoopData = $model['allK2f']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label for=""><?php echo e($value->getK2fName()); ?></label>
            <input type="number" name="k2fLnA[]" value="0">
            <input type="number" name="k2fLnB[]" value="0">
            <input type="number" name="k2fLnC[]" value="0">
            <br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <button type="submit">submit</button>
    </form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/Supply/Subjig/K2F/index.blade.php ENDPATH**/ ?>