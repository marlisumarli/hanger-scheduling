<form action="/admin/user-create" method="post">
    <label>Nama
        <input type="text" required name="name">
    </label>
    <br>
    <legend>Bagian:</legend>
    <?php
    foreach ($model['role'] as $role => $value): ?>
        <div>
            <input type="radio" id="role" name="role" value="<?= $value->getRoleId() ?>"
                   checked>
            <label for="role"><?= $value->getName() ?></label>
        </div>
    <?php endforeach; ?>
    <label>Username
        <input type="text" required name="username">
    </label>
    <br>
    <label>Password
        <input type="password" required name="password">
    </label>
    <br>
    <button type="submit">submit</button>
    <a href="/admin/user">kembali</a>
</form>
