

<?php $__env->startSection('content'); ?>
<div class="container">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">All Referees</h3>
        <a href="<?php echo e(route('referees.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Referee
        </a>
    </div>

    <!-- Check if there are referees -->
    <?php if($referees->isEmpty()): ?>
        <div class="alert alert-warning">
            No referees found. Click "Add Referee" to create one.
        </div>
    <?php else: ?>
        <!-- Referees List -->
        <div class="list-group">
            <?php $__currentLoopData = $referees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1"><?php echo e($referee->name); ?></h5> <!-- Display the referee's name -->
                        <small class="text-muted"><?php echo e($referee->qualification ?? 'Qualification not available'); ?></small>
                    </div>
                    <div>
                        <!-- Action Buttons -->
                        <a href="<?php echo e(route('referees.show', $referee->id)); ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="<?php echo e(route('referees.edit', $referee->id)); ?>" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="<?php echo e(route('referees.destroy', $referee->id)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this referee?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        <?php echo e($referees->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/referees/index.blade.php ENDPATH**/ ?>