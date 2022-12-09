
<?php $__env->startSection('content'); ?>
    <div class="mb-4">
        <h4>Dashboard</h4>
    </div>

    <div class="d-flex justify-content-center">
        <div class="col-lg-5 col-md-12 col-sm-12 mb-3">

            <div class="card rounded-3">
                <div class="card-body py-2 d-flex shadow-lg">
                    <div class="avatar my-auto"
                         data-label="<?php echo e($full_name); ?>"></div>
                    <div class="mx-3">
                        <span class="fw-bold">Selamat Datang, <?php echo e($session->getFullName()); ?> 👋</span>
                        <br>
                        <a class="btn-link text-dark text-decoration-none" href="/admin/user/logout"
                           id="logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <?php $__currentLoopData = $hanger_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hanger_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php if($supply_schedule->findById(strtolower($dateNow->format('YF').'-'.$hanger_type->getId())) !== null): ?>

                <?php
                    $schedule = $supply_schedule->findById(strtolower($dateNow->format('YF').'-'.$hanger_type->getId()));

                        $result = ['m1' => [], 'm2' => [], 'm3' => [], 'm4' => [], 'm5' => []];

                           foreach($schedule_weeks->findScheduleSupplyId($schedule->getId()) as $sch_week){
                               if ($sch_week->getMId() == 'M1'){
                                   $result['m1'][] = $sch_week->getMId();
                               }elseif ($sch_week->getMId() == 'M2'){
                                   $result['m2'][] = $sch_week->getMId();
                               }elseif ($sch_week->getMId() == 'M3'){
                                   $result['m3'][] = $sch_week->getMId();
                               }elseif ($sch_week->getMId() == 'M4'){
                                   $result['m4'][] = $sch_week->getMId();
                               }elseif ($sch_week->getMId() == 'M5'){
                                   $result['m5'][] = $sch_week->getMId();
                               }
                           }
                ?>

                <div class="col-lg-6 col-md-12 mb-3">
                    <div class="card shadow-lg mb-2">
                        <div class="card-header d-flex">
                            <span class="card-title">Laporan <?php echo e(strtoupper($hanger_type->getId())); ?> Bulan Ini</span>
                            <a href="/admin/supply-data/<?php echo e($hanger_type->getId()); ?>/<?php echo e($schedule->getId()); ?>/export"
                               class="text-success btn-sm py-0 ms-auto">
                                Export To Excel
                            </a>
                        </div>
                        <div class="card-body overflow-scroll">
                            <table class="table table-bordered text-center">
                                <thead>
                                <tr>
                                    <th colspan="<?php echo e(count($result['m1'])); ?>" scope="col">M1</th>
                                    <th colspan="<?php echo e(count($result['m2'])); ?>" scope="col">M2</th>
                                    <th colspan="<?php echo e(count($result['m3'])); ?>" scope="col">M3</th>
                                    <th colspan="<?php echo e(count($result['m4'])); ?>" scope="col">M4</th>
                                    <th colspan="<?php echo e(count($result['m5'])); ?>" scope="col">M5</th>
                                </tr>
                                </thead>

                                <tbody class="table-group-divider">
                                <tr>

                                    <?php $__currentLoopData = $schedule_weeks->findScheduleSupplyId($schedule->getId()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sch_week): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php ($dateTime = new DateTime($sch_week->getDate())); ?>
                                        <td>
                                            <div class="card border-0">
                                                <div class="card-body p-0">
                                                    <span><?php echo e($dateTime->format('d/m/Y')); ?></span>
                                                </div>
                                                <span class="position-absolute top-100 start-100 translate-middle rounded-circle">

                                                    <?php if($dateNow->format('Y-m-d') >= $sch_week->getDate() && $sch_week->getIsDone() == null): ?>
                                                        <i class="fa-solid fa-question text-warning"></i>
                                                    <?php elseif($dateNow->format('Y-m-d') <= $sch_week->getDate() && $sch_week->getIsDone() == null): ?>
                                                        <i class="fa-regular fa-clock text-secondary"></i>
                                                    <?php else: ?>
                                                        <i class="fa-solid fa-check text-success"></i>

                                                    <?php endif; ?>

                                                </span>
                                            </div>
                                        </td>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/Dashboard/index.blade.php ENDPATH**/ ?>