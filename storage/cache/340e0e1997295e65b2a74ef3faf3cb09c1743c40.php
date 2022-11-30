
<?php $__env->startSection('content'); ?>
    <form action="" method="post">
        <label for="id">Id</label>
        <input type="text" name="id" id="id" title="Huruf kapital"
               pattern="[A-Z0-9]{1,}"
               required="required">
        <br>
        <label for="qty">Quantity</label>
        <input type="number" name="qty" id="qty"
               min="1"
               required="required">
        <button type="submit">submit</button>
    </form>
<hr>

<ul>
    <?php $__currentLoopData = $model['allType'];
    $__env->addLoop($__currentLoopData);
    foreach ($__currentLoopData as $key => $type): $__env->incrementLoopIndices();
        $loop = $__env->getLastLoop(); ?>
        <li>
            <a href="/admin/subjig/<?php echo e($type->getTypeId()); ?>"><?php echo e($type->getTypeId()); ?></a>&emsp;<?php echo e($type->getTypeQty()); ?>

            Item <a href="">edit</a>
        </li>
    <?php endforeach;
    $__env->popLoop();
    $loop = $__env->getLastLoop(); ?>
</ul>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/Item/Hanger/index.blade.php ENDPATH**/ ?>