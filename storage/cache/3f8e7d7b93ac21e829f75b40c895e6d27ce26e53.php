
<?php $__env->startSection('content'); ?>
    <table border="1">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Id</th>
            <th scope="col">Nama</th>
            <th scope="col">Quantity</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $listItem['allK2f']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row"><?php echo e($value->getId()); ?></th>
                <td><?php echo e($value->getK2fId()); ?></td>
                <td><?php echo e($value->getK2fName()); ?></td>
                <td><?php echo e($value->getK2fQty()); ?></td>
                <td><a href="/admin/list-item/subjig/k2f-update?id=<?php echo e($value->getK2fId()); ?>">Edit</a>
                    <a href="/admin/list-item/subjig/k2f-delete?id=<?php echo e($value->getK2fId()); ?>"
                       onclick="return confirm('Ingin menghapus?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/DataReport/Hanger/k2f.blade.php ENDPATH**/ ?>