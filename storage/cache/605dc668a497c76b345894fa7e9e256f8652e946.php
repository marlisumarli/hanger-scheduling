
<?php $__env->startSection('content'); ?>
    <script crossorigin="anonymous" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script crossorigin="anonymous" src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <div class="mb-4">
        <h4>Dashboard</h4>
    </div>

    <div class="d-flex justify-content-center">
        <div class="col-lg-5 col-md-12 col-sm-12 mb-3">

            <div class="card rounded-3">
                <div class="card-body py-2 d-flex shadow-lg">
                    <div class="avatar my-auto"
                         data-label="MS"></div>
                    <div class="mx-3">
                        <span class="fw-bold">Selamat Datang, User</span>
                        <br>
                        <a class="btn-link text-dark text-decoration-none" href="" id="logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <?php
            $dateNow = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
        ?>

        <?php $__currentLoopData = $model['hanger_types']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hanger_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php if($model['supply_schedule']->findById(strtolower($dateNow->format('YF').'-'.$hanger_type->getId())) !== null): ?>

                <?php
                    $schedule = $model['supply_schedule']->findById(strtolower($dateNow->format('YF').'-'.$hanger_type->getId()));

                        $result = ['m1' => [], 'm2' => [], 'm3' => [], 'm4' => [], 'm5' => []];

                           foreach($model['schedule_weeks']->findScheduleSupplyId($schedule->getId()) as $sch_week){
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
                            <button class="btn btn-primary btn-sm py-0 ms-auto"
                                    data-bs-target="#export_<?php echo e($hanger_type->getId()); ?>"
                                    data-bs-toggle="modal">
                                <i class="fa-solid fa-file-export"></i>
                                <span>Export To Excle</span>
                            </button>
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

                                    <?php $__currentLoopData = $model['schedule_weeks']->findScheduleSupplyId($schedule->getId()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sch_week): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $dateTime = new DateTime($sch_week->getDate());
                                        ?>
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


                <div aria-hidden="true" aria-labelledby="exportLabel" class="modal fade"
                     id="export_<?php echo e($hanger_type->getId()); ?>"
                     tabindex="-1">
                    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-sm modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exportLabel">Download
                                    Laporan <?php echo e(strtoupper($hanger_type->getId())); ?></h1>
                                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"
                                        type="button"></button>
                            </div>
                            <div class="modal-body" id="exporting_<?php echo e($hanger_type->getId()); ?>">
                                <div class="mb-4">
                                    <h2>Total Supply <?php echo e(strtoupper($hanger_type->getId())); ?></h2>
                                </div>


                                <?php $__currentLoopData = $model['schedule_weeks']->findScheduleSupplyId($schedule->getId()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sch_week): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php
                                        $dateTime2 = new DateTime($sch_week->getDate());
                                    ?>

                                    <?php $__currentLoopData = $model['supplies']->findScheduleWeekId($sch_week->getId()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <div class="container overflow-scroll mb-3">
                                            <span><i>Periode Tanggal : <?php echo e($dateTime2->format('d/m/Y')); ?></i></span>
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

                                                <?php $__currentLoopData = $model['hangers']->findHangerTypeId($hanger_type->getId()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hanger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <?php if($sch_week->getIsdone() != null): ?>

                                                        <tr>
                                                            <?php $__currentLoopData = $model['supply_lines']->findSupplyId($supply->getId()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supply_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

                                                    <?php endif; ?>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </tbody>
                                            </table>
                                        </div>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                                <button class="btn btn-success" id="download_<?php echo e($hanger_type->getId()); ?>" type="button">
                                    Download
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <script>
                    $(document).ready(function () {
                        $("#download_<?php echo e($hanger_type->getId()); ?>").click(function () {
                            let table = $("#exporting_<?php echo e($hanger_type->getId()); ?>").html();
                            let uri = 'data:application/vnd.ms-excel;base64,';
                            let template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head></head><body><table>{table}</table></body></html>';
                            let base64 = function (s) {
                                return window.btoa(unescape(encodeURIComponent(s)))
                            };
                            let format = function (s, c) {
                                return s.replace(/{(\w+)}/g, function (m, p) {
                                    return c[p];
                                })
                            };
                            let ctx = {
                                worksheet: 'Worksheet',
                                table: table
                            };
                            let link = document.createElement("a");
                            link.download = "data-supply-bulan-december2022.xls";
                            link.href = uri + base64(format(template, ctx));
                            link.click();
                        });
                    });
                </script>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/Dashboard/index.blade.php ENDPATH**/ ?>