<?php if(isset($model['error'])): ?>
    <script>
        alert(<?php echo e($model['error']); ?>);
    </script>
<?php endif; ?>
<script>
    alert('success');
    document.location.href = '<?php echo e($model["success"]); ?>';
</script><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/TypeItem/update.blade.php ENDPATH**/ ?>