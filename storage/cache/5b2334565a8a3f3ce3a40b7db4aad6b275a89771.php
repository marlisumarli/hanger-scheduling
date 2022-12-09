
<?php $__env->startSection('content'); ?>

    <div class="mb-4">
        <h4>DATA SUPPLY</h4>
    </div>

    <form class="col-5 ms-auto">
        Search
        <input aria-label="Search" class="form-control" placeholder="2022january" type="search" name=""
               id="searchData" onkeyup="search()">
    </form>

    <?php $__currentLoopData = $periods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $period): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <hr class="my-5">
        <div class="mb-4">
            <h2>SCHEDULE <?php echo e(strtoupper($type)); ?> <?php echo e($period->getId()); ?></h2>
        </div>
        <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($schedule->getPeriodId() == $period->getId()): ?>
                <div class="data" id="<?php echo e($schedule->getId()); ?>">
                    <?php
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

                    <div class="card mb-3">
                        <div class="card-header d-flex">
                            <a class="card-title" href="/admin/supply-data/<?php echo e($type); ?>/<?php echo e($schedule->getId()); ?>">#
                                <span class="month"><?php echo e(DateTime::createFromFormat('!m', $schedule->getMonth())->format('F')); ?></span>
                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
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
                                        <?php ($date = new DateTime($sch_week->getDate())); ?>
                                        <td>
                                            <div class="card border-0">
                                                <div class="card-body p-0">
                                                    <span class="position-relative"><?php echo e($date->format('d/m/Y')); ?></span>
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
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <script src="/src/js/searching.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/Data/SupplyData/schedule-data.blade.php ENDPATH**/ ?>