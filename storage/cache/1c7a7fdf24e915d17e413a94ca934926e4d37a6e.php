
<?php $__env->startSection('content'); ?>

    <?php if(isset($success)): ?>
        <script>
            alert('success');
            document.location.href = '<?php echo e($success); ?>';
        </script>
        <?php echo e($success); ?>

    <?php endif; ?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/schedule">Schedule</a></li>
            <li aria-current="page" class="breadcrumb-item active">Buat</li>
        </ol>
    </nav>

    <div class="mb-4">
        <h1>BUAT SCHEDULE <?php echo e(strtoupper($type)); ?></h1>
    </div>

    <form class="row" method="post">
        <div class="col-lg-3 col-md-5 mb-3">
            <div class="card rounded-3 shadow-lg">
                <div class="card-header p-0">
                    <h5 class="card-title m-2">Minggu #1</h5>
                </div>
                <div class="card-body p-3">
                    <div class="mx-auto text-center">
                        <div id="m1">
                        </div>
                        <button class="btn btn-sm btn-primary py-0 rounded-3"
                                id="add-m1" type="button">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-5 mb-3">
            <div class="card rounded-3 shadow-lg">
                <div class="card-header p-0">
                    <h5 class="card-title m-2">Minggu #2</h5>
                </div>
                <div class="card-body p-3">
                    <div class="mx-auto text-center">
                        <div id="m2">
                        </div>
                        <button class="btn btn-sm btn-primary py-0 rounded-3"
                                id="add-m2" type="button">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-5 mb-3">
            <div class="card rounded-3 shadow-lg">
                <div class="card-header p-0">
                    <h5 class="card-title m-2">Minggu #3</h5>
                </div>
                <div class="card-body p-3">
                    <div class="mx-auto text-center">
                        <div id="m3">
                        </div>
                        <button class="btn btn-sm btn-primary py-0 rounded-3"
                                id="add-m3" type="button">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-5 mb-3">
            <div class="card rounded-3 shadow-lg">
                <div class="card-header p-0">
                    <h5 class="card-title m-2">Minggu #4</h5>
                </div>
                <div class="card-body p-3">
                    <div class="mx-auto text-center">
                        <div id="m4">
                        </div>
                        <button class="btn btn-sm btn-primary py-0 rounded-3"
                                id="add-m4" type="button">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-5 mb-3">
            <div class="card rounded-3 shadow-lg">
                <div class="card-header p-0">
                    <h5 class="card-title m-2">Minggu #5</h5>
                </div>
                <div class="card-body p-3">
                    <div class="mx-auto text-center">
                        <div id="m5">
                        </div>
                        <button class="btn btn-sm btn-primary py-0 rounded-3"
                                id="add-m5" type="button">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button class="btn btn-primary disabled" id="submit" type="submit" name="submit">Submit</button>
        </div>

    </form>
    <hr class="my-5">
    <form class="col-5 ms-auto">
        <input aria-label="Search" class="form-control" placeholder="2022december" type="search" name=""
               id="searchData" onkeyup="search()">
    </form>

    <?php $__currentLoopData = $periods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $period): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <hr class="my-5">
        <div class="mb-4">
            <h1>SCHEDULE <?php echo e(strtoupper($type)); ?> <?php echo e($period->getId()); ?></h1>
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

                    <div class="card mb-2">
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
                                        <?php $__currentLoopData = $supplies->findScheduleWeekId($sch_week->getId()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php ($date = new DateTime($sch_week->getDate())); ?>
                                            <td>
                                                <div class="card border-0">
                                                    <div class="card-body p-0">
                                                        <a class="btn-link position-relative"
                                                           href="/admin/supply/<?php echo e($type); ?>/<?php echo e($sch_week->getId()); ?>/<?php echo e($supply->getId()); ?>/view"><?php echo e($date->format('d/m/Y')); ?></a>
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
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex">
                            <a class="btn btn-danger btn-sm py-0 ms-auto <?php echo e($schedule->getIsDone() != null ? 'disabled' : ''); ?>"
                               href="/admin/schedule/<?php echo e($schedule->getId()); ?>/delete"
                               onclick="return confirm('Apakah ingin menghapus Data?')"><i
                                        class="fa-solid fa-trash"></i>
                                <span>Hapus</span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <script src="/src/js/schedule.js"></script>
    <script src="/src/js/searching.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/Schedule/create.blade.php ENDPATH**/ ?>