
<?php $__env->startSection('content'); ?>
    <?php if(isset($category['error'])): ?>
        <?php echo e($category['error']); ?>

    <?php endif; ?>

    <form method="post">
        <div><span>Subjig K2F</span>
            <label for="id">Id</label>
            <input type="text" name="id" id="id" required>
            <br>
            <label for="name">Nama Subjig</label>
            <input type="text" name="name" id="name" required>
            <br>
            <label for="qty">Qty</label>
            <input type="number" name="qty" id="qty" min="1" required>
            <br>
            <hr>
            <button type="submit">submit</button>
        </div>
    </form>

    <table border="1">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Id</th>
            <th scope="col">Nama</th>
            <th scope="col">Quantity</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $listItem['allK2f']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row"><?php echo e($key + 1); ?></th>
                <td><?php echo e($value->getK2fId()); ?></td>
                <td><?php echo e($value->getK2fName()); ?></td>
                <td><?php echo e($value->getK2fQty()); ?></td>
                <td><a href="/admin/list-item/subjig/k2f-update?id=<?php echo e($value->getK2fId()); ?>">Edit</a>
                    <a href="/admin/list-item/subjig/k2f-delete?id=<?php echo e($value->getK2fId()); ?>"
                       onclick="return confirm('Ingin menghapus?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/ListItem/Subjig/k2f.blade.php ENDPATH**/ ?>