
<?php $__env->startSection('content'); ?>
    <div class="mb-4">
        <h1>SUPPLY</h1>
    </div>
    <div class="row">
        <?php $__currentLoopData = $model['hanger_types']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hanger_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="container col-md-3 mb-3">
                <div class="card rounded-3 shadow-lg">
                    <div class="card-header">
                        <h5 class="card-title"># <?php echo e(strtoupper($hanger_type->getId())); ?></h5>
                    </div>
                    <div class="card-body d-flex text-center p-3">
                        <div class="mx-auto">
                            Schedule Supply
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a class="small" href="/admin/supply/<?php echo e($hanger_type->getId()); ?>">
                            Daftar Schedule
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/ScheduleSupply/Supply/index.blade.php ENDPATH**/ ?>