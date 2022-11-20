
<?php $__env->startSection('content'); ?>
    <?php if(isset($model['error'])): ?>
        <?php echo e($model['error']); ?>

    <?php endif; ?>
    <?php if(isset($model['success'])): ?>
        <script>
            alert('success');
            document.location.href = '<?php echo e($model["success"]); ?> ';
        </script>
    <?php endif; ?>
    <form action="" method="post">
        <button type="button" id="generate">Generate</button>
        <?php for($i = 0; $i < $model['typeQty']; $i++): ?>
            <div>
                <input type="number" class="order"
                       name="<?php echo e($i >= count($model['allSubjig']) ? 'orderNumber[]' : 'updateOrderNumber[]'); ?>"
                       id="" placeholder="Nomor Urut" required title="Angka"
                       value="<?php echo e($i < count($model['allSubjig']) ? $model['allSubjig'][$i]->getOrderNumber() : ''); ?>">
                <input type="text"
                       name="<?php echo e($i >= count($model['allSubjig']) ? 'subjigName[]' : 'updateSubjigName[]'); ?>"
                       id="" placeholder="Nama Subjig" required title="Valid Nama"
                       pattern="[A-Za-z ]{3,}"
                       value="<?php echo e($i < count($model['allSubjig']) ? $model['allSubjig'][$i]->getSubjigName() : ''); ?>">
                <input type="number"
                       name="<?php echo e($i >= count($model['allSubjig']) ? 'qty[]' : 'updateQty[]'); ?>"
                       id="" placeholder="Quantity" required title="Angka" min="1"
                       value="<?php echo e($i < count($model['allSubjig']) ? $model['allSubjig'][$i]->getSubjigQty() : ''); ?>">
            </div>
            <?php if($i < count($model['allSubjig'])): ?>
                <a href="/admin/subjig/<?php echo e($model['allSubjig'][$i]->getTypeId()); ?>/<?php echo e($model['allSubjig'][$i]->getSubjigId()); ?>-delete">Hapus</a>
            <?php endif; ?>
        <?php endfor; ?>
        <br>
        <?php if(count($model['allSubjig']) < $model['typeQty']): ?>
            <button name="create" type="submit">Buat</button>
        <?php endif; ?>
        <?php if(count($model['allSubjig']) == $model['typeQty']): ?>
            <button name="update" type="submit">Update</button>
        <?php endif; ?>
    </form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/Subjig/List.blade.php ENDPATH**/ ?>