@extends('Admin/Layout.main')
@section('content')

    <div class="col-md-12 d-flex justify-content-center py-5">
        <div class="card rounded-3 shadow-lg">
            <div class="card-header">
                <div class="card-title">
                    <span>Update User #<b>{{$model['user']->getUserName()}}</b></span>
                </div>
            </div>

            <div class="card-body">
                <form action="/admin/user/{{$model['user']->getUsername()}}/update" method="post"
                      class="form-floating d-flex mb-3">
                    <input class="form-control" id="floatingUpdateName" placeholder="Name" required
                           type="text" value="{{$model['user']->getFullName()}}" name="name">
                    <label for="floatingUpdateName">Name</label>
                    <div class="m-auto px-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="fa-solid fa-arrow-right-arrow-left"></i>
                        </button>
                    </div>
                </form>

                <form action="/admin/user/{{$model['user']->getUsername()}}/update" method="post"
                      class="form-floating d-flex mb-3">
                    <input class="form-control" id="floatingUpdatePassword" placeholder="Password"
                           required
                           type="password" name="password">
                    <label for="floatingUpdatePassword">Password</label>
                    <div class="m-auto px-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="fa-solid fa-arrow-right-arrow-left"></i>
                        </button>
                    </div>
                </form>
                <form action="/admin/user/{{$model['user']->getUsername()}}/update" method="post" class="d-flex">
                    <select aria-label="Default select example" class="form-select" required name="role">
                        <option selected>Jabatan</option>
                        @foreach($model['roles'] as $role)
                            @if($model['user']->getRoleId() == $role->getId())
                                <option value="{{$model['user']->getRoleId()}}"
                                        selected>{{$role->getRoleName()}}</option>
                            @else
                                <option value="{{$model['user']->getRoleId()}}">{{$role->getRoleName()}}</option>
                            @endif
                        @endforeach
                    </select>
                    <div class="m-auto px-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="fa-solid fa-arrow-right-arrow-left"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer d-flex">
                <div class="m-auto">
                    <a href="/admin/users" class="btn btn-sm btn-warning" type="submit">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if(isset($model['success']))
        <script>
            alert('{{$model['success']}}');
        </script>
    @endif

@endsection