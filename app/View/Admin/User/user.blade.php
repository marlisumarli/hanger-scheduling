@extends('Admin/Layout/main')
@section('content')
    <ul>
        <li><a href="/admin/user-create">Create</a></li>
    </ul>
    <br>
    <legend>Admin</legend>
    <table border="1">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Nama</th>
            <th scope="col">Bagian</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At(Detail)</th>
            <th scope="col">Updated At(Password)</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($model['admin'] as $key => $value)
            <tr>
                <th scope="row"><?= $key + 1 ?></th>
                <td><?= $value->getUsername() ?></td>
                <td><?= $value->getFullName() ?></td>
                <td><?= $value->getRoleName() ?></td>
                <td><?= $value->getCreatedAt() ?></td>
                <td><?= $value->getUserDetailUpdatedAt() ?></td>
                <td><?= $value->getUserUpdatePasswordAt() ?></td>
                <td><a href="/admin/user-update?username=<?= $value->getUsername() ?>">Edit</a>
                    <a href="/admin/user-delete?username=<?= $value->getUsername() ?>"
                       onclick="return confirm('Ingin menghapus?');">Delete</a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <br>
    <legend>Subjig</legend>
    <table border="1">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Nama</th>
            <th scope="col">Bagian</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At(Detail)</th>
            <th scope="col">Updated At(Password)</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($model['subjig'] as $key => $value)
            <tr>
                <th scope="row"><?= $key + 1 ?></th>
                <td><?= $value->getUsername() ?></td>
                <td><?= $value->getFullName() ?></td>
                <td><?= $value->getRoleName() ?></td>
                <td><?= $value->getCreatedAt() ?></td>
                <td><?= $value->getUserDetailUpdatedAt() ?></td>
                <td><?= $value->getUserUpdatePasswordAt() ?></td>
                <td><a href="/admin/user-update?username=<?= $value->getUsername() ?>">Edit</a>
                    <a href="/admin/user-delete?username=<?= $value->getUsername() ?>"
                       onclick="return confirm('Ingin menghapus?');">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
