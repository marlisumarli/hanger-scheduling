
<?php $__env->startSection('content'); ?>

    <?php if(isset($model['error'])): ?>
        <script>
            alert(<?php echo e($model['error']); ?>);
        </script>
    <?php endif; ?>

    <?php if($model['find_id'] != null): ?>

        <form action="/admin/item/<?php echo e($model['find_id']->getId()); ?>/update" method="post">
            <label for="id">Id</label>
            <input type="text" name="newId" id="id" title="Huruf kapital"
                   pattern="[A-Z0-9]{1,}" required="required" value="<?php echo e(strtoupper($model['find_id']->getId())); ?>">
            <button name="updateId" type="submit">change</button>
        </form>
        <form action="/admin/item/<?php echo e($model['find_id']->getId()); ?>/update" method="post">
            <label for="qty">Quantity</label>
            <input type="number" name="qty" id="qty" min="1" required="required"
                   value="<?php echo e($model['find_id']->getQty()); ?>">
            <button name="updateQty" type="submit">change</button>
        </form>
        <form action="/admin/item/<?php echo e($model['find_id']->getId()); ?>/hanger/hanger/update" method="post">
            <button type="button" id="generate">Generate</button>
            <?php for($i = 0; $i < $model['find_id']->getQty(); $i++): ?>
                <div>
                    <input type="number" class="order"
                           name="<?php echo e($i >= count($model['hangers']) ? 'orderNumber[]' : 'updateOrderNumber[]'); ?>"
                           id="" placeholder="Nomor Urut" required title="Angka"
                           value="<?php echo e($i < count($model['hangers']) ? $model['hangers'][$i]->getOrderNumber() : ''); ?>">
                    <input type="text"
                           name="<?php echo e($i >= count($model['hangers']) ? 'hangerName[]' : 'updateName[]'); ?>"
                           id="" placeholder="Nama Subjig" required title="Valid Nama"
                           pattern="[A-Za-z ]{3,}"
                           value="<?php echo e($i < count($model['hangers']) ? $model['hangers'][$i]->getName() : ''); ?>">
                    <input type="number"
                           name="<?php echo e($i >= count($model['hangers']) ? 'qty[]' : 'updateQty[]'); ?>"
                           id="" placeholder="Quantity" required title="Angka" min="1"
                           value="<?php echo e($i < count($model['hangers']) ? $model['hangers'][$i]->getQty() : ''); ?>">
                </div>
                <?php if($i < count($model['hangers'])): ?>
                    <a href="/admin/item/<?php echo e($model['hangers'][$i]->getHangerTypeId()); ?>/hanger/<?php echo e($model['hangers'][$i]->getId()); ?>/delete"
                       onclick="return confirm('are you sure want to be delete?')">Hapus</a>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if(count($model['hangers']) < $model['find_id']->getQty()): ?>
                <button name="register" type="submit">registrasi</button>
            <?php endif; ?>
            <?php if(count($model['hangers']) >= $model['find_id']->getQty()): ?>
                <button name="update" type="submit">update</button>
            <?php endif; ?>
        </form>

        <script>
            //    Generate sequence number
            const generate = document.getElementById('generate');
            const id = document.querySelectorAll('.order');
            const makeArray = (count, content) => {
                const result = [];
                if (typeof content === "function") {
                    for (let i = 0; i < count; i++) {
                        result.push(content(i));
                    }
                }
                return result;
            }
            generate.addEventListener('click', () => {
                makeArray(id.length, (i) => {
                    return id[i].value = i + 1;
                });
            });
        </script>
    <?php else: ?>
        notfound
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/Item/HangerType/update.blade.php ENDPATH**/ ?>