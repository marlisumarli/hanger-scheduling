<?php if (isset($model['error'])) : ?>
    <?= $model["error"] ?>
<?php endif; ?>
<h1>Update password <?= $model['username'] ?></h1>
<form method="post">
    <label>Password
        <input type="password" required name="password">
    </label>
    <br>
    <label>Ulang password
        <input type="password" required name="repeatPassword">
    </label>
    <br>
    <button type="submit">submit</button>
    <br>
    <a href="/admin/user">Kembali</a>
</form>
<?php if (isset($model['success'])) : ?>
    <script>
        alert('<?= $model["success"] ?>');
        document.location.href = '/admin/user-update?username=<?= $model['username'] ?>';
    </script>
<?php endif; ?>
