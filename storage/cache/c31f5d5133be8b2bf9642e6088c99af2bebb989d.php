
<?php $__env->startSection('content'); ?>
    <?php if(isset($model['success'])): ?>
        <script>
            alert('success');
            document.location.href = '<?php echo e($model["success"]); ?>';
        </script>
    <?php endif; ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/supply">Supply</a></li>
            <li class="breadcrumb-item"><a href="/admin/supply/<?php echo e($model["type"]); ?>">Schedule</a></li>
            <li aria-current="page" class="breadcrumb-item active">Buat Laporan</li>
        </ol>
    </nav>
    <div class="mb-4">
        <h1>Buat Laporan Supply <?php echo e($model["type"]); ?></h1>
    </div>

    <form class="d-flex justify-content-center" method="post">
        <div class="row">
            <div class="col-md-4 order-md-last mb-3">
                <div class="card rounded-3 shadow-lg">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span>Tanggal dibuat</span><span
                                    class="badge text-bg-warning"><?php echo e($model['schedule_week']->getDate()); ?></span>
                        </div>
                        <label class="form-label card-title" for="targetSet">Target Set</label>
                        <input class="form-control" id="targetSet" min="100" name="target" required type="number">
                    </div>
                </div>
            </div>

            <div class="col-md">
                <?php $__currentLoopData = $model['hangers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hanger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card shadow-lg rounded-3 mb-2">
                        <div class="card-header border-bottom-0">
                            <span class="card-title"># <?php echo e($hanger->getHangerName()); ?></span>
                        </div>
                        <div class="card-body">
                            <div class="row g-1">
                                <div class="col-4">
                                    <label for="1">Line A</label>
                                    <input class="form-control" id="1" name="lnA[]" type="number" min="0">
                                </div>
                                <div class="col-4">
                                    <label for="2">Line B</label>
                                    <input class="form-control" id="2" name="lnB[]" type="number" min="0">
                                </div>
                                <div class="col-4">
                                    <label for="3">Line C</label>
                                    <input class="form-control" id="3" name="lnC[]" type="number" min="0">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary rounded-3 mt-3 px mx-2 shadow-lg" type="submit">Submit</button>
                    <a href="/admin/supply/<?php echo e($model["type"]); ?>" class="btn btn-secondary rounded-3 mt-3 shadow-lg">Kembali</a>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/ScheduleSupply/Supply/Hanger/create.blade.php ENDPATH**/ ?>