
<?php $__env->startSection('content'); ?>
    <ul>
        <li><a href="/admin/user-create">Create</a></li>
    </ul>
    <br>
    <legend>Admin</legend>
    <table border="1">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Nama</th>
            <th scope="col">Bagian</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At(Detail)</th>
            <th scope="col">Updated At(Password)</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $model['admin']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row"><?= $key + 1 ?></th>
                <td><?= $value->getUsername() ?></td>
                <td><?= $value->getFullName() ?></td>
                <td><?= $value->getRoleName() ?></td>
                <td><?= $value->getCreatedAt() ?></td>
                <td><?= $value->getUserDetailUpdatedAt() ?></td>
                <td><?= $value->getUserUpdatePasswordAt() ?></td>
                <td><a href="/admin/user-update?username=<?= $value->getUsername() ?>">Edit</a>
                    <a href="/admin/user-delete?username=<?= $value->getUsername() ?>"
                       onclick="return confirm('Ingin menghapus?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
    </table>
    <br>
    <legend>Subjig</legend>
    <table border="1">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Nama</th>
            <th scope="col">Bagian</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At(Detail)</th>
            <th scope="col">Updated At(Password)</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $model['subjig']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row"><?= $key + 1 ?></th>
                <td><?= $value->getUsername() ?></td>
                <td><?= $value->getFullName() ?></td>
                <td><?= $value->getRoleName() ?></td>
                <td><?= $value->getCreatedAt() ?></td>
                <td><?= $value->getUserDetailUpdatedAt() ?></td>
                <td><?= $value->getUserUpdatePasswordAt() ?></td>
                <td><a href="/admin/user-update?username=<?= $value->getUsername() ?>">Edit</a>
                    <a href="/admin/user-delete?username=<?= $value->getUsername() ?>"
                       onclick="return confirm('Ingin menghapus?');">Delete</a>
                </td>
            </tr>
        <?php endforeach;
        $__env->popLoop();
        $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/User/index.blade.php ENDPATH**/ ?>