
<?php $__env->startSection('content'); ?>
    <form action="" method="post">
        <label for="id">Id</label>
        <input type="text" name="id" id="id" title="Huruf kapital"
               pattern="[A-Z0-9]{1,}"
               required="required">
        <br>
        <label for="qty">Quantity</label>
        <input type="number" name="qty" id="qty"
               min="1"
               required="required">
        <button name="generateQty" type="submit">generate</button>
    </form>
    <hr>

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin/Layout/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hanger-management-pt-indospray\app\View/Admin/Item/HangerType/register.blade.php ENDPATH**/ ?>