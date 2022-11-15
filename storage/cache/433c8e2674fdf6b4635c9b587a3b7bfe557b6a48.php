
<?php $__env->startSection('content'); ?>
    <form action="#" method="post">
        <table border="1">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Id</th>
                <th scope="col">Quantity</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $model['allK2f']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row">
                        <label for="order"></label>
                        <input type="number" name="order[]" id="order" value="<?php echo e($value->getId()); ?>" min="1"></th>
                    <td><?php echo e($value->getK2fName()); ?></td>
                    <td><input type="text" name="id[]" value="<?php echo e($value->getK2fId()); ?>"></td>
                    <td><?php echo e($value->getK2fQty()); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <button type="submit">submit</button>
        <a href="/admin/list-item/subjig/k2f">kembali</a>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/ListItem/Subjig/update-ordered.blade.php ENDPATH**/ ?>