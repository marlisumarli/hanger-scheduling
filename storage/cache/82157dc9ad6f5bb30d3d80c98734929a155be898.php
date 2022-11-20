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
    //    Generate sequence number
    const generate = document.getElementById('generate');
    const id = document.querySelectorAll('.order');
    const makeArray = (count, content) => {
        const result = [];
        if (typeof content === "function") {
            for (let i = 0; i < count; i++) {
                result.push(content(i));
            }
        }
        return result;
    }
    generate.addEventListener('click', () => {
        makeArray(id.length, (i) => {
            return id[i].value = i + 1;
        });
    });
</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/Layout/main.blade.php ENDPATH**/ ?>