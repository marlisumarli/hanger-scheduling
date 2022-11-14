<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title><?php echo e($model['title'] ?? 'Subjig | Admin'); ?></title>
</head>

<body>
<?php echo $__env->make('Admin/Partial/navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('content'); ?>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"
        crossorigin="anonymous"></script>

<script>
    let dataRow = 0
    $('#add').click(() => {
        dataRow++
        inputRow(dataRow)
    })
    inputRow = (i) => {
        i += 1;
        var tr = [`
<divid>
<span>${i}.</span>
<label for="id${i}">Id</label>
<input type="text" name="id[]" id="id${i}" title="Tidak boleh mengandung angka atau spasi" pattern="[A-Za-z]{1,}" required="required">
<br>
<label for="name${i}">Nama</label>
<input type="text" name="name[]" id="name${i}" title="Tidak boleh mengandung angka" pattern="[A-Za-z ]{1,}" required="required">
<br>
<label for="qty${i}">Quantity</label>
<input type="number" name="qty[]" id="qty${i}" required="required">
<hr>
</divid>`];

        $('#data').append(tr)
    }

    $('#rm').click(() => {
        let data = $('#data');
        if (dataRow > 0) {
            dataRow--
        }
        let lists = data.find('divid');

        if (lists.length) {
            data.find('divid').last().remove();
        }
    })

    // Date
    document.getElementById("date").valueAsDate = new Date()


</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/Layout/main.blade.php ENDPATH**/ ?>