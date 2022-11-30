
<?php $__env->startSection('content'); ?>

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    
    
    
    
    

    <?php $__currentLoopData = $model['allMonth']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $value1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $date = new DateTime($value1->getCreatedAt(), new DateTimeZone('Asia/Jakarta'));
        ?>
        <span><?php echo e($date->format('F')); ?></span>
        <a href="/admin/schedule/<?php echo e($value1->getId()); ?>/delete" onclick="return confirm('Ingin menghapusnya?')">delete</a>
        <br>
        <table>
            <?php $__currentLoopData = $model['allDate'][$key1]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $value2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($value2->getMid()); ?></td>
                    <td><?php echo e($value2->getDate()); ?></td>
                    <td><?php echo e($value2->getIsImplemented() == null ? 'belum' : 'sudah'); ?></td>
                    <td><?php if($value2->getIsImplemented() != null): ?>
                            <a href="<?php echo e($value2->getSupplyId()); ?>">Lihat</a></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/ScheduleSupply/Supply/Hanger/index.blade.php ENDPATH**/ ?>