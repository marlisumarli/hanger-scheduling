<?php if (isset($model['error'])) : ?>
    <?= $model["error"] ?>
<?php endif; ?>
<h1>Edit <?= $model['username'] ?></h1>
<form action="" method="post">
    <label>Nama
        <input type="text" required name="name" value="<?= $model['name'] ?>">
    </label>
    <br>
    <legend>Bagian:</legend>
    <div>
        <input type="radio" id="roleId" name="roleId" value="1"
            <?php
            if ($model['roleId'] == 1) {
                echo "checked";
            } ?>>
        <label for="role">Admin</label>
        <input type="radio" id="roleId" name="roleId" value="2"
            <?php if ($model['roleId'] == 2) {
                echo "checked";
            } ?>>
        <label for="role">Subjig</label>
    </div>
    <label>Password
        <a href="/admin/user-update-password?username=<?= $model['username'] ?>">Password Update</a>
    </label>
    <br>
    <button type="submit">submit</button>
    <a href="/admin/user">kembali</a>
</form>
<?php if (isset($model['success'])) : ?>
    <script>
        alert('<?= $model["success"] ?>');
        document.location.href = '/admin/user-update?username=<?= $model['username'] ?>';
    </script>
<?php endif; ?>
