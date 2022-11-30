
<?php $__env->startSection('content'); ?>

    <form method="post">
        <?php $__currentLoopData = $model['allDate']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div id="m1">

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div id="submit">
            <button type="submit" disabled>submit</button>
        </div>
    </form>
    <hr>

    <script type="text/javascript">
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/ScheduleSupply/update.blade.php ENDPATH**/ ?>