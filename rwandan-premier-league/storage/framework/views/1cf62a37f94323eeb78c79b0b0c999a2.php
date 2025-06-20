

<?php $__env->startSection('content'); ?>
<div class="container my-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0"><?php echo e($stadium->name); ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="text-muted">Stadium Details</h5>
                    <p><strong>Location:</strong> <?php echo e($stadium->location); ?></p>
                    <p><strong>Capacity:</strong> <?php echo e($stadium->capacity); ?></p>
                    <!-- Add more details here if available -->
                </div>
                <div class="col-md-6 text-center">
                    <img src="<?php echo e(asset('images/stadium_placeholder.jpg')); ?>" alt="Stadium Image" class="img-fluid rounded shadow" style="max-height: 300px;">
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="<?php echo e(route('stadiums.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Stadiums
            </a>
            <div>
                <a href="<?php echo e(route('stadiums.edit', $stadium->id)); ?>" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="<?php echo e(route('stadiums.destroy', $stadium->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this stadium?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/stadiums/show.blade.php ENDPATH**/ ?>