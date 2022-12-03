
<?php $__env->startSection('content'); ?>
    <?php $__currentLoopData = $model['supplies']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $supply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <h1 id="<?php echo e($supply->getId()); ?>">Tanggal : 12</h1>
        <table>
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
            <?php echo e($supply->getTargetSet()); ?> Set

            <?php $__currentLoopData = $model['supply_lines'][$index]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supply_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($supply_line->getOrderId()); ?></th>
                    <th><?php echo e($supply_line->getSubjigName()); ?></th>
                    <th><?php echo e($supply_line->getSubjigQty()); ?></th>
                    <th><?php echo e(ceil($supply_line->getLineTarget()/$supply_line->getSubjigQty())); ?></th>
                    <th><?php echo e($supply_line->getJumlahLineA()); ?></th>
                    <th><?php echo e($supply_line->getJumlahLineB()); ?></th>
                    <th><?php echo e($supply_line->getJumlahLineC()); ?></th>
                    <th><?php echo e($supply_line->getTotal()); ?></th>
                    <th><?php echo e($supply_line->getTotal()*$supply_line->getSubjigQty()); ?></th>
                    <th>
                        <?php echo e((($supply_line->getTotal()*$supply_line->getSubjigQty()) < $supply_line->getLineTarget()) ? "OPEN" : "CLOSE"); ?>

                    </th>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <a href="/admin/supply/<?php echo e($model['type']); ?>/<?php echo e($supply->getId()); ?>/update">Ubah</a>
        <a href="/admin/supply/<?php echo e($model['type']); ?>/<?php echo e($supply->getId()); ?>/delete"
           onclick="return confirm('Ingin menghapus?');">Hapus</a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/DataReport/supply.blade.php ENDPATH**/ ?>