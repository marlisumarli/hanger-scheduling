
<?php $__env->startSection('content'); ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li aria-current="page" class="breadcrumb-item active">Download</li>
        </ol>
    </nav>

    <button class="btn btn-success" id="download" type="button">
        Download
    </button>
    <div id="exporting">
        <div class=" mb-4">
            <h2>Total Supply <?php echo e(strtoupper($schedule->getId())); ?></h2>
        </div>
        <?php $__currentLoopData = $schedule_weeks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sch_week): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php ($dateTime = new DateTime($sch_week->getDate())); ?>
            <?php $__currentLoopData = $supplies->findScheduleWeekId($sch_week->getId()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="container overflow-scroll mb-3">
                    <span><i>Periode Tanggal : <?php echo e($dateTime->format('d/m/Y')); ?></i></span>
                    <br>
                    <span>Target : <?php echo e($supply->getTargetSet()); ?> set</span>

                    <table class="text-center table-bordered" border="1">
                        <thead>
                        <tr>
                            <th rowspan="2">NO</th>
                            <th rowspan="2">NAMA SUBJIG</th>
                            <th rowspan="2">QTY</th>
                            <th rowspan="2">TYPE</th>
                            <th>TARGET</th>
                            <th colspan="4">LINE</th>
                            <th rowspan="2">KETERANGAN</th>
                        </tr>
                        <tr>
                            <th>JIG</th>
                            <th>A</th>
                            <th>B
                            </th>
                            <th>C</th>
                            <th>TOTAL</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $__currentLoopData = $hangers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hanger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $supply_lines->findSupplyId($supply->getId()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supply_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($supply_line->getHangerId() == $hanger->getId()): ?>
                                    <tr>
                                        <?php ($total = $supply_line->getTotal()); ?>
                                        <td><?php echo e($hanger->getOrderNumber()); ?></td>
                                        <td><?php echo e($hanger->getName()); ?></td>
                                        <td><?php echo e($hanger->getQty()); ?></td>
                                        <td><?php echo e(strtoupper($hanger->getHangerTypeId())); ?></td>
                                        <td><?php echo e(ceil($supply->getTargetSet()/$hanger->getQty())); ?></td>
                                        <td><?php echo e($supply_line->getLineA()); ?></td>
                                        <td><?php echo e($supply_line->getLineB()); ?></td>
                                        <td><?php echo e($supply_line->getLineC()); ?></td>
                                        <td><?php echo e($total); ?></td>
                                        <td><?php echo e(($total*$hanger->getQty()) <= $supply->getTargetSet() ? 'Open' : 'Close'); ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <script src="/src/js/export.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/Data/SupplyData/export.blade.php ENDPATH**/ ?>