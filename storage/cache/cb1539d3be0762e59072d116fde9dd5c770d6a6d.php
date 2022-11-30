
<?php $__env->startSection('content'); ?>
    <?php if(isset($model['error'])): ?>
        <?php echo e($model['error']); ?>

    <?php endif; ?>

    <table border="1">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Type</th>
            <th scope="col">Qty</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $model['allSubjig'];
        $__env->addLoop($__currentLoopData);
        foreach ($__currentLoopData as $key => $value): $__env->incrementLoopIndices();
            $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row"><?php echo e($value->getOrderNumber()); ?></th>
                <td><?php echo e($value->getSubjigName()); ?></td>
                <td><?php echo e($value->getTypeId()); ?></td>
                <td><?php echo e($value->getSubjigQty()); ?></td>
            </tr>
        <?php endforeach;
        $__env->popLoop();
        $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<a href="/admin/subjig/<?php echo e($model['typeId']); ?>/list">Ubah</a>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/Hanger/index.blade.php ENDPATH**/ ?>