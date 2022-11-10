<?php if (isset($model['error'])) : ?>
    <?= $model['error'] ?>
<?php endif; ?>
<?php if (isset($model['success'])) : ?>
    <script>
        alert('<?= $model["success"] ?>');
        document.location.href = '/admin/categories';
    </script>
<?php endif; ?>
<form action="/admin/categories-update-name-category?id=<?= $model['id'] ?>" method="post">
    <div><span>Edit Category <?= $model['id'] ?></span>
        <br>
        <label for="name">Nama Category</label>
        <input type="text" name="name" id="name" value="<?= $model['name'] ?>" required>
        <button type="submit">submit</button>
    </div>
</form>
<br>
<form action="/admin/categories-update-id-category?id=<?= $model['id'] ?>" method="post">
    <div>
        <label for="newId">New ID</label>
        <input type="text" name="newId" id="newId" value="<?= $model['id'] ?>" required>
        <button type="submit">submit</button>
        <br>
        <a href="/admin/categories">kembali</a>
    </div>
</form>
