
<?php $__env->startSection('content'); ?>
    <div class="px-lg-5 px-sm-3 mb-4">
        <h4>LIST ITEM</h4>
        <?php if($session->getRoleId() == 1 || $session->getRoleId() == 3): ?>
            <div class="d-flex">
                <button class="btn btn-sm bg-warning py-1 ms-auto shadow-lg" data-bs-placement="top"
                        data-bs-target="#staticBackdrop"
                        data-bs-title="Registrasi Type Baru" data-bs-toggle="tooltip"
                        onclick="modalPopUp()">
                    <span>Registrasi</span>
                </button>
            </div>
        <?php endif; ?>

    </div>

    <div class="row">
        <?php $__currentLoopData = $hanger_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hangerType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 mb-3 container">
                <div class="card rounded-3 shadow-lg">
                    <div class="card-header">
                        <h5 class="card-title"># <?php echo e(strtoupper($hangerType->getId())); ?></h5>
                    </div>
                    <div class="card-body text-center p-3">
                        <ol class="list-group list-group-numbered">
                            <?php $__currentLoopData = $hangers->findHangerTypeId($hangerType->getId()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hanger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($hanger->getHangerTypeId() == $hangerType->getId()): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <span class="fw-bold"><?php echo e($hanger->getName()); ?></span>
                                        </div>
                                        <span class="badge bg-warning fw-light">Quantity <?php echo e($hanger->getQty()); ?></span>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ol>
                    </div>
                    <?php if($session->getRoleId() == 1 || $session->getRoleId() == 3): ?>
                        <div class="card-footer d-flex">
                            <div class="ms-auto">
                                <a class="small" href="/admin/item/<?php echo e($hangerType->getId()); ?>/update">
                                    Ubah
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="staticBackdropLabel" class="modal fade"
         data-bs-backdrop="static" data-bs-keyboard="false"
         id="staticBackdrop" tabindex="-1">
        <form class="modal-dialog" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Registrasi Type Baru</h1>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>

                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input class="form-control" id="floatingId" placeholder="Id Type" pattern="[A-Z0-9]{1,}"
                               required type="text" name="id">
                        <label for="floatingId">ID Type</label>
                    </div>
                    <div class="form-floating">
                        <input class="form-control" id="floatingQty" min="1"
                               placeholder="Quantity" required type="number" name="qty">
                        <label for="floatingQty">Quantity</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal
                    </button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        function modalPopUp() {
            const modal = new bootstrap.Modal(document.getElementById('staticBackdrop'), {
                keyboard: false
            })
            modal.show()
        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/ItemList/index.blade.php ENDPATH**/ ?>