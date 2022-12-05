@extends('Admin/Layout/main')
@section('content')

    <div class="d-flex mb-2">
        <button class="btn btn-sm bg-warning py-1 ms-auto shadow-lg" data-bs-target="#registerUser"
                data-bs-toggle="modal">
            <i class="fa-solid fa-user-plus"></i>
        </button>
    </div>

    @foreach($model['user_role'] as $role)

        <h1>{{$role->getRoleName()}}</h1>

        <div class="overflow-scroll">
            <table class="table table-info table-hover">

                <thead>

                <tr>
                    <th scope="col">Username</th>
                    <th scope="col">Role</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Last Login</th>
                    <th colspan="2" scope="col">Action</th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                @foreach($model['users']->findRoleId($role->getId()) as $user)
                    @if($user->getRoleId() == $role->getId())
                        @php($dateTime = new DateTime($user->getLastLogin()))
                        <tr>
                            <th>{{$user->getUsername()}}</th>
                            <td>{{$role->getRoleName()}}</td>
                            <td>{{$user->getFullName()}}</td>
                            <td>{{$dateTime->format('d-m-Y H:i:s')}}</td>
                            <td>
                                <a href="/admin/user/{{$user->getUsername()}}/update" class="btn btn-sm btn-warning">
                                    <i class="fa-solid fa-gear"></i>
                                </a>
                            </td>
                            <td>
                                <a href="/admin/user/{{$user->getUsername()}}/delete"
                                   onclick="return confirm('Delete Confirmation')" class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-user-minus"></i>
                                </a>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
    <div aria-hidden="true" aria-labelledby="registerUserLabel" class="modal fade" id="registerUser"
         tabindex="-1">
        <form action="/admin/user/register" class="modal-dialog" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="registerUserLabel">Add User</h1>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input class="form-control" id="floatingName" placeholder="Name" required
                               type="text" name="fullName">
                        <label for="floatingName">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="floatingUsername" placeholder="Username" required
                               type="text" name="username">
                        <label for="floatingUsername">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="floatingPassword" placeholder="Password" required
                               type="password" name="password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <select aria-label="Default select example" class="form-select" required name="role">
                        @foreach($model['user_role'] as $role)
                            <option value="{{$role->getId()}}">{{$role->getRoleName()}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                    <button class="btn btn-success" type="submit">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
