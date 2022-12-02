
<?php $__env->startSection('content'); ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/supply">Supply</a></li>
            <li aria-current="page" class="breadcrumb-item active">Schedule</li>
        </ol>
    </nav>
    <div class="mb-4">
        <h1>SCHEDULE SUPPLY K2F</h1>
    </div>
    <div class="row">
        <?php $__currentLoopData = $model['schedule_m_categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="col-lg-4 col-md-6 col-sm-6 mb-3">
                <div class="card rounded-3 shadow-lg">
                    <div class="card-header p-0">
                        <h5 class="card-title m-2">Minggu #<?php echo e($category->getId()); ?></h5>
                    </div>
                    <div class="card-body p-3">
                        <div class="row text-center">
                            <?php
                                $dateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
                            ?>
                            <?php if(isset($model['schedule_weeks'][0])): ?>
                                <?php $__currentLoopData = $model['schedule_weeks'][0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sch_week): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($sch_week->getMId() == $category->getId()): ?>
                                        <div class="col-5">
                                            <span class="small"><?php echo e($sch_week->getDate()); ?></span>
                                        </div>
                                        <?php if($dateTime->format('Y-m-d') == $sch_week->getDate() && $sch_week->getIsImplemented() == null): ?>
                                            <div class="col-6">
                                                <a href="/admin/supply/<?php echo e($model['type']); ?>/<?php echo e($sch_week->getSupplyId()); ?>/create">
                                                    <span class="small">Buat Laporan</span>
                                                </a>
                                            </div>
                                        <?php elseif($dateTime->format('Y-m-d') >= $sch_week->getDate() && $sch_week->getIsImplemented() == null): ?>
                                            <div class="col-6">
                                                <a class="link-primary"
                                                   href="/admin/supply/<?php echo e($model['type']); ?>/<?php echo e($sch_week->getSupplyId()); ?>">
                                                    <span class="small">Lihat</span>
                                                </a>
                                                <svg class="bi bi-question-circle text-warning" fill="currentColor"
                                                     height="16"
                                                     viewBox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                    <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                                                </svg>
                                            </div>
                                        <?php elseif($dateTime->format('Y-m-d') <= $sch_week->getDate() && $sch_week->getIsImplemented() == null): ?>
                                            <div class="col-6">
                                                <i class="fa-regular fa-clock text-secondary"></i>
                                            </div>

                                        <?php else: ?>
                                            <div class="col-6">
                                                <a class="link-primary"
                                                   href="/admin/supply/<?php echo e($model['type']); ?>/<?php echo e($sch_week->getSupplyId()); ?>">
                                                    <span class="small">Lihat</span>
                                                </a>
                                                <svg class="bi bi-check2-circle text-success" fill="currentColor"
                                                     height="16"
                                                     viewBox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                                                    <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php $__currentLoopData = $model['periods']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $period): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <hr class="my-5">
        <div class="mb-4">
            <h1>SCHEDULE <?php echo e($model['type']); ?> <?php echo e($period->getId()); ?></h1>
        </div>

        <?php $__currentLoopData = $model['schedules']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data => $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($schedule->getPeriodId() == $period->getId()): ?>
                <?php
                    $result = ['m1' => [], 'm2' => [], 'm3' => [], 'm4' => [], 'm5' => []];
                        foreach($model['schedule_weeks'][$data] as $sch_week){
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
                        <span class="card-title"># <?php echo e(DateTime::createFromFormat('!m', $schedule->getMonth())->format('F')); ?></span>
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

                            <?php
                                $dateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
                            ?>

                            <tbody class="table-group-divider">
                            <tr>
                                <?php $__currentLoopData = $model['schedule_weeks'][$data]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sch_week): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td>
                                        <div class="card border-0">
                                            <div class="card-body p-0">
                                                <a class="btn-link position-relative"
                                                   href="/admin/supply/<?php echo e($model['type']); ?>/<?php echo e($sch_week->getSupplyId()); ?>"><?php echo e($sch_week->getDate()); ?></a>
                                            </div>
                                            <span class="position-absolute top-100 start-100 translate-middle rounded-circle">
                                                <?php if($dateTime->format('Y-m-d') >= $sch_week->getDate() && $sch_week->getIsImplemented() == null): ?>
                                                    <i class="fa-solid fa-question text-warning"></i>
                                                <?php elseif($dateTime->format('Y-m-d') <= $sch_week->getDate() && $sch_week->getIsImplemented() == null): ?>
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
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/ScheduleSupply/Supply/Hanger/index.blade.php ENDPATH**/ ?>