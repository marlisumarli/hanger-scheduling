<?php if (isset($model['error'])) : ?>
    <?= $model["error"] ?>
<?php endif; ?>
<form action="/admin/user-create" method="post">
    <label>Nama
        <input type="text" required name="name" value="">
    </label>
    <br>
    <legend>Bagian:</legend>
    <div>
        <input type="radio" id="role" name="role"
               value="1">
        <label for="role">Admin</label>
        <input type="radio" id="role" name="role"
               value="2"
               checked>
        <label for="role">Subjig</label>
    </div>
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
<?php if (isset($model['success'])) : ?>
    <script>
        alert('<?= $model["success"] ?>');
        document.location.href = '/admin/user-create';
    </script>
<?php endif; ?>
