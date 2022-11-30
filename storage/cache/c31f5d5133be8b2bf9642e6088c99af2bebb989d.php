
<?php $__env->startSection('content'); ?>
    <?php if(isset($model['error'])): ?>
        <?php echo e($model['error']); ?>

    <?php endif; ?>
    <?php if(isset($model['success'])): ?>
        <script>
            alert('success');
            document.location.href = '<?php echo e($model["success"]); ?>';
        </script>
    <?php endif; ?>

    <form method="post">
        <label for="target">Update Target Supply</label>
        <input type="number" name="target" id="target" min="100" required="required">

        <br>
        <?php $__currentLoopData = $model['allSubjig']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label for=""><?php echo e($value->getHangerName()); ?></label>
            <input type="number" name="lnA[]" value="0" min="0">
            <input type="number" name="lnB[]" value="0" min="0">
            <input type="number" name="lnC[]" value="0" min="0">
            <br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <button type="submit">submit</button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/ScheduleSupply/Supply/Hanger/create.blade.php ENDPATH**/ ?>