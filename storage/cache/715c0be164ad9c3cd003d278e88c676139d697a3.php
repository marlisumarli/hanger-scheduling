
<?php $__env->startSection('content'); ?>

    <?php
        if (isset($schedule_week)){
             $dateTime = new \DateTime($schedule_week);
        }
    ?>

    <nav aria-label="breadcrumb">
        <?php if($session->getRoleId() == 1): ?>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/schedule">Schedule</a></li>
                <li class="breadcrumb-item"><a href="/admin/schedule/<?php echo e($type); ?>/create">Buat</a></li>
                <li aria-current="page" class="breadcrumb-item active">View Data</li>
            </ol>
        <?php elseif($session->getRoleId() == 3): ?>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/supply">Supply</a></li>
                <li class="breadcrumb-item"><a href="/admin/supply/<?php echo e($type); ?>">Schedule</a></li>
                <li aria-current="page" class="breadcrumb-item active">View Data</li>
            </ol>

        <?php endif; ?>
    </nav>
    <div class="mb-4">
        <h1>Laporan Supply <u>K2F</u> Tanggal <i> <?php echo e($dateTime->format('d/m/Y')); ?></i>
        </h1>
    </div>
    <div class="card mb-2">
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
                    <tr class="c-border">
                        <?php $__currentLoopData = $supply_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supply_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($supply_line->getHangerId() == $hanger->getId()): ?>
                                <?php ($total = $supply_line->getTotal()); ?>
                                <td><?php echo e($hanger->getOrderNumber()); ?></td>
                                <td><?php echo e($hanger->getName()); ?></td>
                                <td><?php echo e($hanger->getQty()); ?></td>
                                <td><?php echo e(strtoupper($hanger->getHangerTypeId())); ?></td>
                                <td><?php echo e(ceil($supply->getTargetSet()/$hanger->getQty())); ?></td>
                                <td><?php echo e($supply_line->getLineA()); ?></td>
                                <td><?php echo e($supply_line->getLineB()); ?></td>
                                <td><?php echo e($supply_line->getLineC()); ?></td>
                                <td><?php echo e($supply_line->getTotal()); ?></td>
                                <td><?php echo e(($total*$hanger->getQty()) <= $supply->getTargetSet() ? 'Open' : 'Close'); ?></td>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php if($session->getRoleId() == 3): ?>
            <div class="card-footer d-flex">
                <div class="ms-auto">
                    <a class="btn btn-warning btn-sm py-0"
                       href="/admin/supply/<?php echo e($type); ?>/<?php echo e($schedule); ?>/<?php echo e($supplyId); ?>/update">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span>Ubah</span>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/Supply/view.blade.php ENDPATH**/ ?>