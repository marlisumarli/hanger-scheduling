<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title><?php echo e($model['title'] ?? 'Subjig | Admin'); ?></title>
</head>

<body>
<?php echo $__env->make('Admin/Partial/navlogin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('content-login'); ?>
<script src="/src/js/index.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/Layout/login.blade.php ENDPATH**/ ?>