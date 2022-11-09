<?php if (isset($model['error'])) : ?>
    <?= $model['error'] ?>
<?php endif; ?>

<form method="post">
    <div><span>Subjig K2F</span>
        <br>
        <label for="code">Kode</label>
        <input type="text" name="code" id="code" required>
        <br>
        <label for="name">Nama Subjig</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="qty">Qty</label>
        <input type="number" name="qty" id="qty" min="1" required>
        <br>
        <button type="submit">submit</button>
    </div>
</form>

<table border="1">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Kode</th>
        <th scope="col">Nama</th>
        <th scope="col">Quantity</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($model['k2f'] as $key => $value) : ?>
        <tr>
            <th scope="row"><?= $key + 1 ?></th>
            <td><?= $value->getCode() ?></td>
            <td><?= $value->getName() ?></td>
            <td><?= $value->getQty() ?></td>
            <td><a href="/admin/list-item/subjig/k2f-edit?code=<?= $value->getCode() ?>">Edit</a>
                <a href="/admin/list-item/subjig/k2f-delete?code=<?= $value->getCode() ?>"
                   onclick="return confirm('Ingin menghapus?');">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
