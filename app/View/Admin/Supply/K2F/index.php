<form action="" method="post">
    <select class="" aria-label="Category">
        <?php foreach ($model['category'] as $key => $value) : ?>
            <option value="<?= $value->getCategoryId() ?>"><?= $value->getCategoryName() ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <?php foreach ($model['k2f'] as $key => $value) : ?>
        <label for="<?= $value->getK2fId() ?>"><?= $value->getK2fName() ?>
            <input type="number" name="<?= $value->getK2fId() ?>" id="<?= $value->getK2fId() ?>">
        </label>
        <br>
    <?php endforeach; ?>
    <button type="submit">submit</button>
</form>