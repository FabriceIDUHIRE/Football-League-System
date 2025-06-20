

<?php $__env->startSection('content'); ?>
<div class="container">
    <h3 class="text-primary">Category Details</h3>
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title"><?php echo e($category->name); ?></h5>
            <p class="card-text"><?php echo e($category->description ?? 'No description available.'); ?></p>
            <a href="<?php echo e(route('match_categories.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Categories
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/match_categories/show.blade.php ENDPATH**/ ?>