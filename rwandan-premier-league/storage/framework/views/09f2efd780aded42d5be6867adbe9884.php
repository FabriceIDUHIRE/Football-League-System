


<?php $__env->startSection('content'); ?>
    <h1>Match Commissioners</h1>

    <!-- Button to add a new commissioner -->
    <a href="<?php echo e(route('match_commissioners.create')); ?>" class="btn btn-primary mb-3">Add New Commissioner</a>

    <!-- Display Match Commissioners in a Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $matchCommissioners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commissioner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($commissioner->name); ?></td>
                    <td><?php echo e($commissioner->email); ?></td>
                    <td><?php echo e($commissioner->phone); ?></td>
                    <td>
                        <a href="<?php echo e(route('match_commissioners.edit', $commissioner->id)); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="<?php echo e(route('match_commissioners.destroy', $commissioner->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/match_commissioners/index.blade.php ENDPATH**/ ?>