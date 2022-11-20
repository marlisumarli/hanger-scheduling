
<?php $__env->startSection('content'); ?>
    <?php if(isset($model['error'])): ?>
        <?php echo e($model['error']); ?>

    <?php endif; ?>

    <form method="post">
        <label for="date">Tanggal</label>
        <input type="date" name="date" id="date" value="">
        <script>
            document.getElementById("date").valueAsDate = new Date()
        </script>
        <label for="target">Update Target Supply</label>
        <input type="number" name="target" id="target" min="100" value="300" required="required">

        <br>
        <?php $__currentLoopData = $model['allSubjig']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label for=""><?php echo e($value->getSubjigName()); ?></label>
            <input type="number" name="lnA[]" value="0" min="0">
            <input type="number" name="lnB[]" value="0" min="0">
            <input type="number" name="lnC[]" value="0" min="0">
            <br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <button type="submit">submit</button>
    </form>
    <?php if(isset($model['success'])): ?>
        <script>
            alert('success');
            document.location.href = '<?php echo e($model["success"]); ?>';
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/Supply/Subjig/index.blade.php ENDPATH**/ ?>