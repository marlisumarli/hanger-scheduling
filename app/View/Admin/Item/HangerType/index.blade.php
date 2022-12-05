@extends('Admin/Layout/main')
@section('content')
    <div class="px-lg-5 px-sm-3 mb-4">
        <h1>LIST ITEM</h1>
        @if($model['session']->getRoleId() == 1)
            <div class="d-flex">
                <button class="btn btn-sm bg-warning py-1 ms-auto shadow-lg" data-bs-placement="top"
                        data-bs-target="#staticBackdrop"
                        data-bs-title="Registrasi Type Baru" data-bs-toggle="tooltip"
                        onclick="modalPopUp()">
                    <span>Registrasi</span>
                </button>
            </div>
        @endif

    </div>

    <div class="row">
        @foreach($model['hanger_types'] as $hangerType)
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 mb-3 container">
                <div class="card rounded-3 shadow-lg">
                    <div class="card-header">
                        <h5 class="card-title"># {{strtoupper($hangerType->getId())}}</h5>
                    </div>
                    <div class="card-body text-center p-3">
                        <ol class="list-group list-group-numbered">
                            @foreach ($model['hangers']->findHangerTypeId($hangerType->getId()) as $hanger)
                                @if($hanger->getHangerTypeId() == $hangerType->getId())
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <span class="fw-bold">{{$hanger->getName()}}</span>
                                        </div>
                                        <span class="badge bg-warning fw-light">Quantity {{$hanger->getQty()}}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ol>
                    </div>
                    @if($model['session']->getRoleId() == 1)
                    <div class="card-footer d-flex">
                        <div class="ms-auto">
                            <a class="small" href="/admin/item/{{$hangerType->getId()}}/hanger/update">
                                Ubah
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        @endforeach
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

@endsection
