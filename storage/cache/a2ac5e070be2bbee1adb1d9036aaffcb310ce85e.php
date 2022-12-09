
<?php $__env->startSection('content'); ?>

    <div class="d-flex mb-2">
        <button class="btn btn-sm bg-warning py-1 ms-auto shadow-lg" data-bs-target="#registerUser"
                data-bs-toggle="modal">
            <i class="fa-solid fa-user-plus"></i>
        </button>
    </div>

    <?php $__currentLoopData = $user_role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <h1><?php echo e($role->getRoleName()); ?></h1>

        <div class="overflow-scroll">
            <table class="table table-info table-hover">

                <thead>

                <tr>
                    <th scope="col">Username</th>
                    <th scope="col">Role</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Last Login</th>
                    <th colspan="2" scope="col">Action</th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                <?php $__currentLoopData = $users->findRoleId($role->getId()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($user->getRoleId() == $role->getId()): ?>
                        <?php ($dateTime = new DateTime($user->getLastLogin())); ?>
                        <tr>
                            <th><?php echo e($user->getUsername()); ?></th>
                            <td><?php echo e($role->getRoleName()); ?></td>
                            <td><?php echo e($user->getFullName()); ?></td>
                            <td><?php echo e($dateTime->format('d-m-Y H:i:s')); ?></td>
                            <td>
                                <a href="/admin/user/<?php echo e($user->getUsername()); ?>/update" class="btn btn-sm btn-warning">
                                    <i class="fa-solid fa-gear"></i>
                                </a>
                            </td>
                            <td>
                                <a href="/admin/user/<?php echo e($user->getUsername()); ?>/delete"
                                   onclick="return confirm('Delete Confirmation')" class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-user-minus"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div aria-hidden="true" aria-labelledby="registerUserLabel" class="modal fade" id="registerUser"
         tabindex="-1">
        <form action="/admin/user/register" class="modal-dialog" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="registerUserLabel">Add User</h1>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input class="form-control" id="floatingName" placeholder="Name" required
                               type="text" name="fullName">
                        <label for="floatingName">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="floatingUsername" placeholder="Username" required
                               type="text" name="username">
                        <label for="floatingUsername">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="floatingPassword" placeholder="Password" required
                               type="password" name="password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <select aria-label="Default select example" class="form-select" required name="role">
                        <?php $__currentLoopData = $user_role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($role->getId()); ?>"><?php echo e($role->getRoleName()); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                    <button class="btn btn-success" type="submit">Save</button>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/User/index.blade.php ENDPATH**/ ?>