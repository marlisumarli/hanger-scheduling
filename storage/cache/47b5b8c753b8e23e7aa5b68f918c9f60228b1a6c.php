<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title><?php echo e($model['title'] ?? 'Hanger | Admin'); ?></title>
</head>

<body>
<?php echo $__env->make('Admin/Layout/navlogin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('content-login'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/Layout/login.blade.php ENDPATH**/ ?>