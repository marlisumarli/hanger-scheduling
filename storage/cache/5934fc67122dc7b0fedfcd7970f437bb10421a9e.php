
<?php $__env->startSection('content'); ?>
    <?php if(isset($model['error'])): ?>
        <?php echo e($model['error']); ?>

    <?php endif; ?>
    <h1>Ubah laporan supply <?php echo e($model['idSupply']->getSupplyId()); ?></h1>
    <form action="" method="post">
        <label for="dateUpdate">Tanggal</label>
        <input type="date" name="dateUpdate" id="dateUpdate" value="<?php echo e($model['idSupply']->getSupplyDate()); ?>">
        <br>
        <?php $__currentLoopData = $model['allSupply']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label for=""><?php echo e($value->getK2fName()); ?></label>
            <input type="number" name="k2fLnA[]" value="<?php echo e($value->getJumlahLineA()); ?>" min="0">
            <input type="number" name="k2fLnB[]" value="<?php echo e($value->getJumlahLineB()); ?>" min="0">
            <input type="number" name="k2fLnC[]" value="<?php echo e($value->getJumlahLineC()); ?>" min="0">
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
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/Supply/Subjig/K2F/update.blade.php ENDPATH**/ ?>