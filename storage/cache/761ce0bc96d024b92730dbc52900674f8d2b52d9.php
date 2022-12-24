
<?php $__env->startSection('content'); ?>
    <?php if(isset($success)): ?>
        <script>
            swal({
                title: "Sukses!",
                text: "<?php echo e($success); ?>",
                icon: "success"
            }).then(function() {
                window.location = "<?php echo e($redirect); ?>";
            });
        </script>
    <?php endif; ?>
    <?php
        if (isset($schedule_week)){
             $dateTime = new DateTime($schedule_week);
        }
    ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/supply">Supply</a></li>
            <li class="breadcrumb-item"><a href="/admin/supply/<?php echo e($type); ?>">Schedule</a></li>
            <li class="breadcrumb-item">
                <a href="/admin/supply/<?php echo e($type); ?>/<?php echo e($schedule); ?>/<?php echo e($supplyId); ?>/view"><?php echo e($dateTime->format('d/m/Y')); ?></a>
            </li>
            <li aria-current="page" class="breadcrumb-item active">Ubah Laporan</li>
        </ol>
    </nav>
    <div class="mb-4">
        <h1>Update Laporan Supply <?php echo e(strtoupper($type)); ?></h1>
    </div>

    <form class="d-flex justify-content-center" method="post">
        <div class="row">
            <div class="col-md-4 order-md-last mb-3">
                <div class="card rounded-3 shadow-lg">
                    <div class="card-body">
                        <label class="form-label card-title" for="targetSet">Ubah Target Set</label>
                        <input class="form-control" id="targetSet" min="100" name="target" required type="number"
                               value="<?php echo e($supply->getTargetSet()); ?>">
                    </div>
                </div>
            </div>

            <div class="col-md">
                <?php $__currentLoopData = $hangers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hanger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card shadow-lg rounded-3 mb-2">
                        <div class="card-header border-bottom-0">
                            <span class="card-title"># <?php echo e($hanger->getName()); ?></span>
                        </div>
                        <div class="card-body">
                            <div class="row g-1">
                                <?php $__currentLoopData = $supply_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplyLine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php if($supplyLine->getHangerId() == $hanger->getId() && $supplyLine->getSupplyId() == $supply->getId()): ?>
                                        <div class="col-4">
                                            <label for="1">Line A</label>
                                            <input class="form-control" id="1" name="lnA_<?php echo e($supplyLine->getId()); ?>"
                                                   type="number" min="0"
                                                   value="<?php echo e($supplyLine->getLineA()); ?>">
                                        </div>
                                        <div class="col-4">
                                            <label for="2">Line B</label>
                                            <input class="form-control" id="2" name="lnB_<?php echo e($supplyLine->getId()); ?>"
                                                   type="number" min="0"
                                                   value="<?php echo e($supplyLine->getLineB()); ?>">
                                        </div>
                                        <div class="col-4">
                                            <label for="3">Line C</label>
                                            <input class="form-control" id="3" name="lnC_<?php echo e($supplyLine->getId()); ?>"
                                                   type="number" min="0"
                                                   value="<?php echo e($supplyLine->getLineC()); ?>">
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary rounded-3 mt-3 px mx-2 shadow-lg" type="submit">Submit</button>
                    <a href="/admin/supply/<?php echo e($type); ?>/<?php echo e($schedule); ?>/<?php echo e($supplyId); ?>/view"
                       class="btn btn-secondary rounded-3 mt-3 shadow-lg">Kembali</a>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/Supply/update.blade.php ENDPATH**/ ?>