

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Punishments</h2>

    <!-- Button to open Create Punishment form -->
    <a href="<?php echo e(route('punishments.create')); ?>" class="btn btn-primary mb-3">Create Punishment</a>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th> <!-- Display team name or user name -->
                <th>Type</th>
                <th>Reason</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th> <!-- New column for actions -->
            </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $punishments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $punishment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <tr>
               <!-- Display the correct name based on who is punished -->
               <td>
    <?php if($punishment->team): ?>
        <?php echo e($punishment->team->name); ?>

    <?php elseif($punishment->player): ?>
        <?php echo e($punishment->player->name); ?>

    <?php elseif($punishment->coach): ?>
        <?php echo e($punishment->coach->name); ?>

    <?php elseif($punishment->referee): ?>
        <?php echo e($punishment->referee->name); ?>

    <?php else: ?>
        No Name Available
    <?php endif; ?>
</td>


               <td><?php echo e($punishment->type); ?></td>
               <td><?php echo e($punishment->reason); ?></td>
               <td><?php echo e($punishment->start_date); ?></td>
               <td><?php echo e($punishment->end_date); ?></td>
               <td>
                   <!-- Edit Button -->
                   <a href="<?php echo e(route('punishments.edit', $punishment->id)); ?>" class="btn btn-warning btn-sm">Edit</a>

                   
                   <!-- Terminate Button (only if punishment is ongoing) -->
                   <?php if(!$punishment->end_date): ?>
                       <form action="<?php echo e(route('punishments.terminate', $punishment->id)); ?>" method="POST" style="display:inline;">
                           <?php echo csrf_field(); ?>
                           <?php echo method_field('PUT'); ?>
                       </form>
                   <?php else: ?>
                   <?php endif; ?>

                   <!-- Delete Button with Confirmation -->
                   <form action="<?php echo e(route('punishments.destroy', $punishment->id)); ?>" method="POST" style="display:inline;" onsubmit="return confirmDelete();">
                       <?php echo csrf_field(); ?>
                       <?php echo method_field('DELETE'); ?>
                       <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                   </form>
               </td>
           </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<script>
function confirmDelete() {
    return confirm('Are you sure you want to delete this punishment? This action cannot be undone.');
}
</script>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/punishments/index.blade.php ENDPATH**/ ?>