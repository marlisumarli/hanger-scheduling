
<?php $__env->startSection('content'); ?>

    <div class="col-md-12 d-flex justify-content-center py-5">
        <div class="card rounded-3 shadow-lg">
            <div class="card-header">
                <div class="card-title">
                    <span>Update User #<b><?php echo e($model['user']->getUserName()); ?></b></span>
                </div>
            </div>

            <div class="card-body">
                <form action="/admin/user/<?php echo e($model['user']->getUsername()); ?>/update" method="post"
                      class="form-floating d-flex mb-3">
                    <input class="form-control" id="floatingUpdateName" placeholder="Name" required
                           type="text" value="<?php echo e($model['user']->getFullName()); ?>" name="name">
                    <label for="floatingUpdateName">Name</label>
                    <div class="m-auto px-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="fa-solid fa-arrow-right-arrow-left"></i>
                        </button>
                    </div>
                </form>

                <form action="/admin/user/<?php echo e($model['user']->getUsername()); ?>/update" method="post"
                      class="form-floating d-flex mb-3">
                    <input class="form-control" id="floatingUpdatePassword" placeholder="Password"
                           required
                           type="password" name="password">
                    <label for="floatingUpdatePassword">Password</label>
                    <div class="m-auto px-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="fa-solid fa-arrow-right-arrow-left"></i>
                        </button>
                    </div>
                </form>
                <form action="/admin/user/<?php echo e($model['user']->getUsername()); ?>/update" method="post" class="d-flex">
                    <select aria-label="Default select example" class="form-select" required name="role">
                        <option selected>Jabatan</option>
                        <?php $__currentLoopData = $model['roles']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($model['user']->getRoleId() == $role->getId()): ?>
                                <option value="<?php echo e($model['user']->getRoleId()); ?>"
                                        selected><?php echo e($role->getRoleName()); ?></option>
                            <?php else: ?>
                                <option value="<?php echo e($model['user']->getRoleId()); ?>"><?php echo e($role->getRoleName()); ?></option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="m-auto px-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="fa-solid fa-arrow-right-arrow-left"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer d-flex">
                <div class="m-auto">
                    <a href="/admin/users" class="btn btn-sm btn-warning" type="submit">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php if(isset($model['success'])): ?>
        <script>
            alert('<?php echo e($model['success']); ?>');
        </script>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/User/update.blade.php ENDPATH**/ ?>