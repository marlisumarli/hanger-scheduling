
<?php $__env->startSection('content'); ?>
    <nav aria-label="breadcrumb">

        <?php if($session->getRoleId() == 1): ?>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/schedule">Schedule</a></li>
                <li class="breadcrumb-item"><a href="/admin/schedule/<?php echo e($type); ?>/create">Buat</a></li>
                <li aria-current="page" class="breadcrumb-item active">Data Supply <?php echo e($schedule->getMonth()); ?></li>
            </ol>
        <?php elseif($session->getRoleId() == 3): ?>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/supply">Supply</a></li>
                <li class="breadcrumb-item"><a href="/admin/supply/<?php echo e($type); ?>">Schedule</a></li>
                <li aria-current="page" class="breadcrumb-item active">Data Supply <?php echo e($schedule->getMonth()); ?></li>
            </ol>
        <?php else: ?>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/supply-data/<?php echo e($type); ?>"><?php echo e(strtoupper($type)); ?></a></li>
            </ol>
        <?php endif; ?>

    </nav>
    <div class="mb-4">
        <h1>Laporan Supply <u><?php echo e(strtoupper($type)); ?></u> Bulan
            <u><?php echo e(DateTime::createFromFormat('!m', $schedule->getMonth())->format('F')); ?></u>
        </h1>

        <button class="btn btn-success btn-sm py-0 ms-auto"
                data-bs-target="#export"
                data-bs-toggle="modal">
            <i class="fa-solid fa-file-export"></i>
            <span>Export To Excle</span>
        </button>
    </div>


    <?php if($schedule->getId() !== null): ?>

        <?php $__currentLoopData = $schedule_weeks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scheduleWeek): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php ($dateTime = new DateTime($scheduleWeek->getDate())); ?>
            <?php $__currentLoopData = $supplies->findScheduleWeekId($scheduleWeek->getId()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card mb-3">
                    <div class="card-header d-flex">
                        <span class="card-title"># <?php echo e($dateTime->format('d F Y')); ?></span>
                        <div class="ms-auto">
                            <span>Target #<?php echo e($supply->getTargetSet()); ?> set</span>
                        </div>
                    </div>
                    <div class="card-body overflow-scroll">
                        <table class="table table-borderless text-center table-subjig">
                            <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="border" colspan="3">Line</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr class="c-border border-bottom border-dark border-2">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">QTY</th>
                                <th scope="col">Type</th>
                                <th scope="col">Target</th>
                                <th scope="col">A</th>
                                <th scope="col">B</th>
                                <th scope="col">C</th>
                                <th scope="col">Total</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                            </thead>
                            <tbody class="border">
                            <?php $__currentLoopData = $hangers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hanger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $supply_lines->findSupplyId($supply->getId()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supply_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($supply_line->getHangerId() == $hanger->getId()): ?>
                                        <tr class="c-border">
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
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div aria-hidden="true" aria-labelledby="exportLabel" class="modal fade"
             id="export"
             tabindex="-1">
            <div class="modal-dialog modal-dialog-scrollable modal-xl modal-sm modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exportLabel">Download Laporan</h1>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"
                                type="button"></button>
                    </div>
                    <div class="modal-body" id="exporting">
                        <div class="mb-4">
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
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                        <button class="btn btn-success" id="download" type="button">
                            Download
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <script src="/src/js/export.js"></script>
    <?php else: ?>
        not found
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/Data/SupplyData/supply-data.blade.php ENDPATH**/ ?>