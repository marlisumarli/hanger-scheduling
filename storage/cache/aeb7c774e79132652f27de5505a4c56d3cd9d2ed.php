<?php $__env->startSection('content'); ?>
<?php if (isset($model['error'])): ?>
    <?php echo e($model['error']); ?>

<?php endif; ?>
<?php if (isset($model['success'])): ?>
    <script>
        alert('success');
        document.location.href = '<?php echo e($model['success']); ?>';
    </script>
    <?php echo e($model['success']); ?>

<?php endif; ?>

    <span>Subjig K2F</span>
    <br>
    <button id="add">Tambah</button>
    <button id="rm">Hapus</button>

    <form method="post" id="forms">
        <div id="data">
            <span>M1</span>
            <input type="date" name="date[]" required="required" title="date">
            <span>M2</span>
            <input type="date" name="date[]" required="required" title="date">
            <span>M3</span>
            <input type="date" name="date[]" required="required" title="date">
            <span>M4</span>
            <input type="date" name="date[]" required="required" title="date">
            <hr>
        </div>
        <button type="submit">submit</button>
    </form>
    <hr>

<?php $__currentLoopData = $model['allMonth'];
$__env->addLoop($__currentLoopData);
foreach ($__currentLoopData as $key1 => $value1): $__env->incrementLoopIndices();
    $loop = $__env->getLastLoop(); ?>
    <?php
    $date = new DateTime($value1->getCreatedAt(), new DateTimeZone('Asia/Jakarta'));
    ?>
    <?php echo e($date->format('F')); ?><br>
    <table>
        <?php $__currentLoopData = $model['allDate'][ $key1 ];
        $__env->addLoop($__currentLoopData);
        foreach ($__currentLoopData as $key2 => $value2): $__env->incrementLoopIndices();
            $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>M<?php echo e($key2 + 1); ?></td>
                <td><?php echo e($value2->getTanggal()); ?></td>
                <td><?php echo e($value2->getIsImplemented() == null ? 'belum' : 'sudah'); ?></td>
                <td><a href="<?php echo e($value2->getSupplyId()); ?>">Lihat</a></td>
            </tr>
        <?php endforeach;
        $__env->popLoop();
        $loop = $__env->getLastLoop(); ?>
    </table>
<?php endforeach;
$__env->popLoop();
$loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/ScheduleSupply/index.blade.php ENDPATH**/ ?>