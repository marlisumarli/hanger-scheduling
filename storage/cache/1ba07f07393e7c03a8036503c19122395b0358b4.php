
<?php $__env->startSection('content'); ?>
    <?php $__currentLoopData = $model['allSupply']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <h1>Tanggal : <?php echo e($value->getSupplyDate()); ?></h1>
        <table border="1">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Nama</th>
                <th scope="col">Line A</th>
                <th scope="col">Line B</th>
                <th scope="col">Line C</th>
                <th scope="col">Total</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $model['joinSupply'][$index]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supply => $k2f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($k2f->getId()); ?></th>
                    <th><?php echo e($k2f->getK2fName()); ?></th>
                    <th><?php echo e($k2f->getJumlahLineA()); ?></th>
                    <th><?php echo e($k2f->getJumlahLineB()); ?></th>
                    <th><?php echo e($k2f->getJumlahLineC()); ?></th>
                    <th><?php echo e($k2f->getTotal()); ?></th>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/Laporan/2022/Subjig/k2f.blade.php ENDPATH**/ ?>