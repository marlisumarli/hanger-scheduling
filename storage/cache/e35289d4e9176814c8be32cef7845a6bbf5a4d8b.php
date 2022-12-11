<?php if(isset($error)): ?>
    <script>
        alert('<?php echo e($error); ?>');
        document.location.href = '<?php echo e($direct); ?>';
    </script>
<?php endif; ?>
<script>
    document.location.href = '<?php echo e($direct); ?>';
</script><?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/ItemList/Temp/delete.blade.php ENDPATH**/ ?>