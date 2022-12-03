
<?php $__env->startSection('content'); ?>
    <?php if(isset($model['error'])): ?>
        <?php echo e($model['error']); ?>

    <?php endif; ?>
    <form action="/admin/list-item/subjig" method="post">
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
            <a href="/admin/subjig/<?php echo e($type->getId()); ?>"><?php echo e($type->getId()); ?></a>&emsp;<?php echo e($type->getTypeQty()); ?>

            Item
            <form action="/admin/list-item/subjig-update?id=<?php echo e($type->getId()); ?>" method="post">
                <label for="id">Id</label>
                <input type="text" name="newId" id="id" title="Huruf kapital"
                       pattern="[A-Z0-9]{1,}"
                       required="required"
                       value="<?php echo e($type->getId()); ?>">
                <button name="updateId" type="submit">update id</button>
            </form>
            <form action="/admin/list-item/subjig-update?id=<?php echo e($type->getId()); ?>" method="post">
                <label for="qty">Quantity</label>
                <input type="number" name="qty" id="qty"
                       min="1"
                       required="required" value="<?php echo e($type->getTypeQty()); ?>">
                <button name="updateQty" type="submit">update qty</button>
            </form>
        </li>
    <?php endforeach;
    $__env->popLoop();
    $loop = $__env->getLastLoop(); ?>
</ul>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/HangerType/index.blade.php ENDPATH**/ ?>