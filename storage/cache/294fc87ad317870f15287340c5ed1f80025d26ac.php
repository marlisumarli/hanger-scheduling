<?php $__env->startSection('content'); ?>

    <ul>
        <?php $__currentLoopData = $model['allSchedule'];
        $__env->addLoop($__currentLoopData);
        foreach ($__currentLoopData as $key => $value): $__env->incrementLoopIndices();
            $loop = $__env->getLastLoop(); ?>
            <?php
            $date = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
            ?>
            <li><?php echo e($value->getDate()); ?>

                <ul>
                    <?php if (strtotime($date->format('Y-m-d')) == strtotime($value->getDate())): ?>
                        <li><a href="/admin/supply/<?php echo e($value->getDate()); ?>">buat laporan</a></li>
                    <?php endif; ?>
                    <?php if (strtotime($date->format('Y-m-d')) > strtotime($value->getDate())): ?>
                        <li><a href="/admin/supply/<?php echo e($value->getDate()); ?>">Lihat</a></li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endforeach;
        $__env->popLoop();
        $loop = $__env->getLastLoop(); ?>
    </ul>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/Supply/Hanger/index.blade.php ENDPATH**/ ?>