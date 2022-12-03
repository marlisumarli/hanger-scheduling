
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
    <?php if($model['idSupply'] !== null): ?>
        <h1>Ubah laporan supply <?php echo e($model['idSupply']->getSupplyId()); ?></h1>
        <form method="post">
            <label for="dateUpdate">Tanggal</label>
            <input type="date" name="dateUpdate" id="dateUpdate" value="<?php echo e($model['idSupply']->getSupplyDate()); ?>">
            <label for="target">Update Target Supply</label>
            <input type="number" name="target" id="target" min="100" value="<?php echo e($model['idSupply']->getTargetSet()); ?>"
                   required="required">
            <br>
            <?php $__currentLoopData = $model['allSupply']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label for=""><?php echo e($value->getSubjigName()); ?></label>
                <input type="number" name="lnA[]" value="<?php echo e($value->getJumlahLineA()); ?>" min="0">
                <input type="number" name="lnB[]" value="<?php echo e($value->getJumlahLineB()); ?>" min="0">
                <input type="number" name="lnC[]" value="<?php echo e($value->getJumlahLineC()); ?>" min="0">
                <br>
            <?php endforeach;
            $__env->popLoop();
            $loop = $__env->getLastLoop(); ?>
            <button type="submit">submit</button>
        </form>
        <a href="/admin/laporan/<?php echo e($model['back']); ?>/supply">Kembali</a>

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/Supply/Hanger/view.blade.php ENDPATH**/ ?>