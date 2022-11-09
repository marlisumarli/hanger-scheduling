<main>
    <h1>Hallo <?= $model['user'] ?></h1>
    <hr>
    <h1>Dashboard</h1>
    <ul>
        <li><a href="/admin/supply">Supply</a></li>
        <li><a href="">Perbaikan</a></li>
        <li><a href="">Subjig Baru</a></li>
        <li><a href="">Laporan</a></li>
        <li><a href="/admin/list-item">Daftar Subjig / Mainjig / Messboat</a></li>
    </ul>
    <br>
    <ul>
        <?php if ($model['roleId'] == 1) : ?>
            <li><a href="/admin/user">User</a></li>
        <?php endif; ?>
        <li><a href="/admin/user/logout">Logout</a></li>
    </ul>
</main>
<form action="/admin/dashboard" method="post">

</form>