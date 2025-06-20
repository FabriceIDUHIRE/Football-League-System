

<?php $__env->startSection('content'); ?>
<div class="container">
    <h3>Register New Stadium</h3>

    <form action="<?php echo e(route('stadiums.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="form-group">
        <label for="name">Stadium Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="location">Location</label>
        <input type="text" name="location" id="location" class="form-control">
    </div>
    <div class="form-group">
        <label for="capacity">Capacity</label>
        <input type="number" name="capacity" id="capacity" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/stadiums/create.blade.php ENDPATH**/ ?>