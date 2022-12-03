
<?php $__env->startSection('content'); ?>
    <form action="" method="post">
        <label for="category">Category</label>
        <select id="category" name="category" class="" aria-label="Category">
            <?php $__currentLoopData = $supply['allCategory'];
            $__env->addLoop($__currentLoopData);
            foreach ($__currentLoopData as $key => $value): $__env->incrementLoopIndices();
                $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($value->getCategoryId()); ?>"><?php echo e($value->getCategoryName()); ?></option>
            <?php endforeach;
            $__env->popLoop();
            $loop = $__env->getLastLoop(); ?>
        </select>
        <br>
        <label for="date">Tanggal</label>
        <input type="date" name="date" id="date" value="">
        <br>
        <?php $__currentLoopData = $supply['allK2f'];
        $__env->addLoop($__currentLoopData);
        foreach ($__currentLoopData as $key => $value): $__env->incrementLoopIndices();
            $loop = $__env->getLastLoop(); ?>
            <label for="<?php echo e($value->getK2fId()); ?>"><?php echo e($value->getK2fName()); ?></label>
            <input type="number" name="txK2f[]" id="<?php echo e($value->getK2fId()); ?>" value="0">
            <br>
        <?php endforeach;
        $__env->popLoop();
        $loop = $__env->getLastLoop(); ?>
        <button type="submit">submit</button>
    </form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/Supply/K2F/index.blade.php ENDPATH**/ ?>