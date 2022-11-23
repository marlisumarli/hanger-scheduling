
<?php $__env->startSection('content'); ?>
    <?php $__currentLoopData = $model['allSupplyDate']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <h1 id="<?php echo e($value->getSupplyId()); ?>">Tanggal : <?php echo e($value->getSupplyDate()); ?></h1>
        <table border="1">
            <thead>
            <tr>
                <th scope="col">NO</th>
                <th scope="col">NAMA SUBJIG</th>
                <th scope="col">QTY</th>
                <th scope="col">TARGET</th>
                <th scope="col">LINE A</th>
                <th scope="col">LINE B</th>
                <th scope="col">LINE C</th>
                <th scope="col">TOTAL</th>
                <th scope="col">SET</th>
                <th scope="col">KETERANGAN</th>
            </tr>
            </thead>
            <tbody>
            <?php echo e($value->getTargetSet()); ?> Set

            <?php $__currentLoopData = $model['allSupplyLine'][$index]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($value2->getOrderId()); ?></th>
                    <th><?php echo e($value2->getSubjigName()); ?></th>
                    <th><?php echo e($value2->getSubjigQty()); ?></th>
                    <th><?php echo e(ceil($value2->getLineTarget()/$value2->getSubjigQty())); ?></th>
                    <th><?php echo e($value2->getJumlahLineA()); ?></th>
                    <th><?php echo e($value2->getJumlahLineB()); ?></th>
                    <th><?php echo e($value2->getJumlahLineC()); ?></th>
                    <th><?php echo e($value2->getTotal()); ?></th>
                    <th><?php echo e($value2->getTotal()*$value2->getSubjigQty()); ?></th>
                    <th>
                        <?php echo e((($value2->getTotal()*$value2->getSubjigQty()) < $value2->getLineTarget()) ? "OPEN" : "CLOSE"); ?>

                    </th>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <a href="/admin/supply/<?php echo e($value->getTypeId()); ?>/<?php echo e($value->getSupplyId()); ?>/update">Ubah</a>
        <a href="/admin/supply/<?php echo e($value->getTypeId()); ?>/<?php echo e($value->getSupplyId()); ?>/delete"
           onclick="return confirm('Ingin menghapus?');">Hapus</a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/Laporan/supply.blade.php ENDPATH**/ ?>