
<?php $__env->startSection('content'); ?>
    <?php if(isset($model['error'])): ?>
        <?php echo e($model['error']); ?>

    <?php endif; ?>

    <span>Subjig K2F</span>
    <div>
        <button id="add">Tambah</button>
        <button id="rm">Hapus</button>
    </div>

    <form action="/admin/list-item/subjig/k2f" method="post" id="forms">
        <div id="data">
            <div id="">
                <span>1.</span>
                <label for="id1">Id</label>
                <input type="text" name="id[]" id="id1" title="Tidak boleh mengandung angka atau spasi"
                       pattern="[a-zA-Z]{1,}"
                       required="required">
                <br>
                <label for="name1">Nama</label>
                <input type="text" name="name[]" id="name1" title="Tidak boleh mengandung angka"
                       pattern="[A-Za-z ]{1,}" required="required">
                <br>
                <label for="qty1">Quantity</label>
                <input type="number" name="qty[]" id="qty1" required="required">
                <hr>
            </div>
        </div>
        <button type="submit">submit</button>
    </form>


    <table border="1">
        <thead>
        <tr>
            <th scope="col"><a href="/admin/list-item/subjig/k2f-update-order">#</a></th>
            <th scope="col">Id</th>
            <th scope="col">Nama</th>
            <th scope="col">Quantity</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $model['allK2f']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row"><?php echo e($value->getK2fOrderId()); ?></th>
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