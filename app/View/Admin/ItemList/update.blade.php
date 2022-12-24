@extends('Admin/Layout/main')
@section('content')
    @if(isset($success))
        <script>
            swal({
                title: "Sukses!",
                text: "{{$success}}",
                icon: "success"
            }).then(function () {
                window.location = "{{$direct}}";
            });
        </script>
    @endif
    @isset($error)
        <script>
            swal({
                title: "Perhatian!",
                text: "{{$error}}",
                icon: "error"
            }).then(function () {
                window.location = "{{$direct}}";
            });
        </script>
    @endisset
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/admin/item">List Item</a></li>
            <li aria-current="page" class="breadcrumb-item active">Update</li>
        </ol>
    </nav>

    <div class="px-lg-5 px-sm-3 mb-4">
        <h4>LIST ITEM</h4>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-6 mb-3">

            <ul class="list-group">
                <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <span class="fw-bold">Type : {{strtoupper($find_id->getId())}}</span>
                    </div>
                    <button class="btn btn-sm rounded bg-warning py-1 ms-auto shadow-lg"
                            data-bs-placement="top"
                            data-bs-target="#updateType"
                            data-bs-title="Ubah Nama Type" data-bs-toggle="tooltip"
                            onclick="modalPopUpType()">
                        <span>Ubah</span>
                    </button>
                </li>
                <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <span class="fw-bold">Jumlah Item : {{$find_id->getQty()}}</span>
                    </div>
                    <button class="btn btn-sm rounded bg-warning py-1 ms-auto shadow-lg"
                            data-bs-placement="top"
                            data-bs-target="#staticBackdrop"
                            data-bs-title="Ubah Jumlah Type" data-bs-toggle="tooltip"
                            onclick="modalPopUpQty()">
                        <span>Ubah</span>
                    </button>
                </li>
            </ul>
            <div class="mt-3">

                <div class="card">
                    <section class="card-body">
                        <p>User guide mengubah atau registrasi tipe hanger atau data hanger</p>
                        <ol>
                            <li>Untuk mengubah ID Tipe atau Quantity tipe hanger anda hanya perlu klik tombol <span
                                        class="btn btn-sm rounded bg-warning py-1 ms-auto shadow-lg">
                                        <span>Ubah</span></span> kemudian isi bagian yang anda ingin merubahnya, lalu klik <span class="btn btn-sm btn-primary">
                                Simpan
                            </span> dengan syarat tidak boleh mengandung karakter yang selain huruf <strong> alphabet dan nomor</strong>,
                                jika ingin membatalkannya klik <span class="btn btn-sm btn-secondary">
                                Batal
                            </span>
                            </li>
                            <li><span class="btn btn-sm btn-primary py-0 rounded-3">
                                <i class="fa-solid fa-list-ol"></i>
                            </span>
                                Ini adalah nomor urut generator, yang dimana bisa otomatis mengurutkan nomor.
                                Setelah nomor diurutkan maka klik tombol <span class="btn btn-sm btn-primary">
                                Update
                            </span>
                            </li>
                            <li>
                                Syarat untuk registrasi hanger atau ubah data hanger, tidak boleh memasukkan karakter selain huruf <strong>alphabet</strong>
                            </li>
                            <li>
                                Jika sudah mengubah atau registrasi data hanger, kemudian klik <span class="btn btn-sm btn-primary">
                                Submit
                            </span> atau jika anda hanya mengubahnya klik <span class="btn btn-sm btn-primary">
                                Update
                            </span>
                            </li>
                            <li>
                                hanger tidak bisa dihapus ketika laporan supply sudah dibuat
                            </li>
                        </ol>
                    </section>
                </div>
            </div>
        </div>


        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 mb-3">
            <form class="card rounded-3 shadow-lg"
                  action="/admin/item/{{$find_id->getId()}}/hanger/update" method="post" autocomplete="off">
                <div class="card-header">
                    <h5 class="card-title"># Item</h5>
                </div>
                <div class="card-body p-2">

                    <table class="table text-center">
                        <thead class="text-primary">
                        <tr>
                            <th scope="col" class="col-1">
                                <button class="btn btn-sm btn-primary py-0 rounded-3" id="generate"
                                        type="button" data-bs-placement="top"
                                        data-bs-target="#staticBackdrop"
                                        data-bs-title="Generate Number Ordered" data-bs-toggle="tooltip">
                                    <i class="fa-solid fa-list-ol"></i>
                                </button>
                            </th>
                            <th scope="col" class="col-5">
                                <svg class="bi bi-input-cursor-text" fill="currentColor" height="16"
                                     viewBox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 2a.5.5 0 0 1 .5-.5c.862 0 1.573.287 2.06.566.174.099.321.198.44.286.119-.088.266-.187.44-.286A4.165 4.165 0 0 1 10.5 1.5a.5.5 0 0 1 0 1c-.638 0-1.177.213-1.564.434a3.49 3.49 0 0 0-.436.294V7.5H9a.5.5 0 0 1 0 1h-.5v4.272c.1.08.248.187.436.294.387.221.926.434 1.564.434a.5.5 0 0 1 0 1 4.165 4.165 0 0 1-2.06-.566A4.561 4.561 0 0 1 8 13.65a4.561 4.561 0 0 1-.44.285 4.165 4.165 0 0 1-2.06.566.5.5 0 0 1 0-1c.638 0 1.177-.213 1.564-.434.188-.107.335-.214.436-.294V8.5H7a.5.5 0 0 1 0-1h.5V3.228a3.49 3.49 0 0 0-.436-.294A3.166 3.166 0 0 0 5.5 2.5.5.5 0 0 1 5 2z"
                                          fill-rule="evenodd"/>
                                    <path d="M10 5h4a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1h-4v1h4a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-4v1zM6 5V4H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v-1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h4z"/>
                                </svg>
                            </th>
                            <th scope="col" class="col-1">
                                <svg class="bi bi-123" fill="currentColor" height="16"
                                     viewBox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.873 11.297V4.142H1.699L0 5.379v1.137l1.64-1.18h.06v5.961h1.174Zm3.213-5.09v-.063c0-.618.44-1.169 1.196-1.169.676 0 1.174.44 1.174 1.106 0 .624-.42 1.101-.807 1.526L4.99 10.553v.744h4.78v-.99H6.643v-.069L8.41 8.252c.65-.724 1.237-1.332 1.237-2.27C9.646 4.849 8.723 4 7.308 4c-1.573 0-2.36 1.064-2.36 2.15v.057h1.138Zm6.559 1.883h.786c.823 0 1.374.481 1.379 1.179.01.707-.55 1.216-1.421 1.21-.77-.005-1.326-.419-1.379-.953h-1.095c.042 1.053.938 1.918 2.464 1.918 1.478 0 2.642-.839 2.62-2.144-.02-1.143-.922-1.651-1.551-1.714v-.063c.535-.09 1.347-.66 1.326-1.678-.026-1.053-.933-1.855-2.359-1.845-1.5.005-2.317.88-2.348 1.898h1.116c.032-.498.498-.944 1.206-.944.703 0 1.206.435 1.206 1.07.005.64-.504 1.106-1.2 1.106h-.75v.96Z"/>
                                </svg>
                            </th>
                            <th class="text-danger col-2" scope="col"><i class="fa-solid fa-trash"></i></th>
                        </tr>
                        </thead>
                        <tbody class="table-group-divider">
                        @for($i = 0; $i < $find_id->getQty(); $i++)
                            <tr>
                                <td>
                                    <input class="form-control p-0 text-center order" id="numberOrder"
                                           name="{{$i >= count($hangers) ? 'orderNumber[]' : 'updateOrderNumber[]'}}"
                                           placeholder="0" required title="" type="number"
                                           value="{{$i < count($hangers) ? $hangers[$i]->getOrderNumber() : ''}}"
                                           min="1">
                                </td>
                                <td>
                                    <input class="form-control p-0 text-center" id="name"
                                           name="{{$i >= count($hangers) ? 'hangerName[]' : 'updateName[]'}}"
                                           placeholder="..."
                                           required title="" type="text"
                                           value="{{$i < count($hangers) ? $hangers[$i]->getName() : ''}}"
                                           min="1">
                                </td>
                                <td>
                                    <input class="form-control p-0 text-center" id="qty"
                                           name="{{$i >= count($hangers) ? 'qty[]' : 'updateQty[]'}}"
                                           placeholder="00"
                                           required title="" type="number"
                                           value="{{$i < count($hangers) ? $hangers[$i]->getQty() : ''}}"
                                           min="1">
                                </td>
                                <td>
                                    @if($i < count($hangers))
                                        <button type="button" class="btn btn-link link-danger"
                                                onclick="confirmation('{{$hangers[$i]->getHangerTypeId()}}/{{$hangers[$i]->getId()}}')">
                                            Hapus
                                        </button>
                                        <script>
                                            function confirmation($id) {
                                                swal({
                                                    title: "Apakah anda yakin?",
                                                    text: "Data akan di hapus secara permanen",
                                                    buttons: true,
                                                    dangerMode: true,
                                                }).then((willDelete) => {
                                                    if (willDelete) {
                                                        window.location = "/admin/item/" + $id + "/delete";
                                                    }
                                                });
                                            }
                                        </script>
                                    @endif
                                </td>
                            </tr>
                        @endfor
                        </tbody>

                    </table>
                </div>
                <div class="card-footer text-end">
                    @if(count($hangers) < $find_id->getQty())
                        <button name="register" class="btn btn-primary" type="submit">
                            Submit
                        </button>
                    @elseif(count($hangers) >= $find_id->getQty())
                        <button name="update" class="btn btn-primary" type="submit">
                            Update
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div aria-hidden="true" aria-labelledby="updateTypeLabel" class="modal fade"
         data-bs-backdrop="static" data-bs-keyboard="false"
         id="updateType" tabindex="-1">
        <form action="/admin/item/{{$find_id->getId()}}/update" method="post" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateTypeLabel">Ubah Nama Type</h1>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"
                            type="button"></button>
                </div>
                <div class="modal-body">

                    <div class="form-floating mb-3">
                        <input class="form-control" id="type" placeholder="Id Type" pattern="[A-Z0-9]{1,}"
                               required type="text" name="newId">
                        <label for="type">ID Type</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal
                    </button>
                    <button class="btn btn-primary" type="submit" name="updateId">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    <!--            Modal Jumlah-->
    <div aria-hidden="true" aria-labelledby="updateQtyLabel" class="modal fade"
         data-bs-backdrop="static" data-bs-keyboard="false"
         id="updateQty" tabindex="-1">
        <form action="/admin/item/{{$find_id->getId()}}/update" method="post" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateQtyLabel">Ubah Jumlah Item</h1>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"
                            type="button"></button>
                </div>
                <div class="modal-body">

                    <div class="form-floating">
                        <input class="form-control" id="floatingQty"
                               min="1" placeholder="Quantity" required type="number" name="qty">
                        <label for="floatingQty">Quantity</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal
                    </button>
                    <button class="btn btn-primary" type="submit" name="updateQty">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        function modalPopUpType() {
            const modal = new bootstrap.Modal(document.getElementById('updateType'), {
                keyboard: false
            })
            modal.show()
        }

        function modalPopUpQty() {
            const modal = new bootstrap.Modal(document.getElementById('updateQty'), {
                keyboard: false
            })
            modal.show()
        }

        const generate = document.getElementById('generate');
        const id = document.querySelectorAll('.order');
        const makeArray = (count, content) => {
            const result = [];
            if (typeof content === "function") {
                for (let i = 0; i < count; i++) {
                    result.push(content(i));
                }
            }
            return result;
        }
        generate.addEventListener('click', () => {
            makeArray(id.length, (i) => {
                return id[i].value = i + 1;
            });
        });
    </script>
@endsection