<?php $__env->startSection('content'); ?>
<?php $__currentLoopData = $model['allSupply'];
$__env->addLoop($__currentLoopData);
foreach ($__currentLoopData as $index => $value): $__env->incrementLoopIndices();
    $loop = $__env->getLastLoop(); ?>
    <h1>Tanggal : <?php echo e($value->getSupplyDate()); ?></h1>
    <table border="1">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Quantity</th>
            <th scope="col">Target</th>
            <th scope="col">Line A</th>
            <th scope="col">Line B</th>
            <th scope="col">Line C</th>
            <th scope="col">Total</th>
            <th scope="col">Set</th>
            <th scope="col">Keterangan</th>
        </tr>
        </thead>
        <tbody>
        <?php echo e($model['joinSupply'][ $index ][ $index ]->getTargetSet()); ?> Set

        <?php $__currentLoopData = $model['joinSupply'][ $index ];
        $__env->addLoop($__currentLoopData);
        foreach ($__currentLoopData as $supply => $k2f): $__env->incrementLoopIndices();
            $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row"><?php echo e($k2f->getK2fOrderid()); ?></th>
                <th><?php echo e($k2f->getK2fName()); ?></th>
                <th><?php echo e($k2f->getK2fQty()); ?></th>
                <th><?php echo e(ceil($k2f->getTargetSet() / $k2f->getK2fQty())); ?></th>
                <th><?php echo e($k2f->getJumlahLineA()); ?></th>
                <th><?php echo e($k2f->getJumlahLineB()); ?></th>
                <th><?php echo e($k2f->getJumlahLineC()); ?></th>
                <th><?php echo e($k2f->getTotal()); ?></th>
                <th><?php echo e($k2f->getTotal() * $k2f->getK2fQty()); ?></th>
                <th>open</th>
            </tr>
        <?php endforeach;
        $__env->popLoop();
        $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <a href="/admin/supply/subjig/k2f-update?id=<?php echo e($value->getSupplyId()); ?>">Ubah</a>
    <a href="/admin/supply/subjig/delete?id=<?php echo e($value->getSupplyId()); ?>"
       onclick="return confirm('Ingin menghapus?');">Hapus</a>
<?php endforeach;
$__env->popLoop();
$loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/DataReport/2022/Hanger/k2f.blade.php ENDPATH**/ ?>