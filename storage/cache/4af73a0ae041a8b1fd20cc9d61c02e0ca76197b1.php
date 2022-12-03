
<?php $__env->startSection('content'); ?>
    <form action="" method="post">
        <label for="id">Id</label>
        <input type="text" name="id" id="id" title="Huruf kapital" pattern="[A-Z0-9]{1,}" required="required">
        <br>
        <label for="qty">Quantity</label>
        <input type="number" name="qty" id="qty" min="1" required="required">
        <button name="generateQty" type="submit">OK</button>
    </form>
    <ul>
        <?php $__currentLoopData = $model['allHangerType']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a href="/admin/item/<?php echo e($value->getId()); ?>/hanger/update"><?php echo e($value->getId()); ?></a>

                <table border="1">
                    <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Qty</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $model['allHanger'][$key1]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $value2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row"><?php echo e($value2->getOrderNumber()); ?></th>
                            <td><?php echo e($value2->getHangerName()); ?></td>
                            <td><?php echo e($value2->getHangerQty()); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/Item/HangerType/index.blade.php ENDPATH**/ ?>