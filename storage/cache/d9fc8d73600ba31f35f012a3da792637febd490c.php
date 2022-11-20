<?php if(isset($model['error'])): ?>
    <script>
        alert("! <?php echo e($model['error']); ?> !");
        document.location.href = "<?php echo e($model['direct']); ?>";
    </script>
<?php endif; ?>
<?php if(isset($model['success'])): ?>
    <script>
        alert('success');
        document.location.href = '<?php echo e($model["success"]); ?>';
    </script>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\subjig-management-pt-indospray\app\View/Admin/Subjig/delete.blade.php ENDPATH**/ ?>