

<?php $__env->startSection('content'); ?>

<head>
    
</head>
<div class="container">
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php elseif(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>
    <h1>Transfer Window</h1>
    <p>Status: <?php echo e($window ? ($window->is_open ? 'Open' : 'Closed') : 'No window available'); ?></p>

    <?php if($window && $window->is_open): ?>
    <form action="<?php echo e(route('transfers.close')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-danger">Close Transfer Window</button>
    </form>
    <?php elseif($window): ?>
    <form action="<?php echo e(route('transfers.open')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-success">Open Transfer Window</button>
    </form>
    <?php endif; ?>

    <h3 style="margin-top:5rem;">Transfers Made</h3>
    <?php if(!$transfers->isEmpty()): ?>
    <table class="table" style="margin-top:2rem;">
    <thead>
        <tr>
            <th>Player</th>
            <th>From Team</th>
            <th>To Team</th>
            <th>Transfer Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($transfer->player ? $transfer->player->name : 'N/A'); ?></td>
                <td><?php echo e($transfer->fromTeam ? $transfer->fromTeam->name : 'N/A'); ?></td>
                <td><?php echo e($transfer->toTeam ? $transfer->toTeam->name : 'N/A'); ?></td>
                <td><?php echo e($transfer->transfer_date ? $transfer->transfer_date->format('Y-m-d') : 'N/A'); ?></td>
                <td>
                    <!-- Debugging the raw status -->
                    <?php echo e($transfer->status); ?> <!-- This will display the raw status value from the database -->
                    
                    <!-- Display transfer status with color-coded badges -->
                    <?php if($transfer->status == 'pending'): ?>
                        <span class="badge badge-warning">Pending</span>
                    <?php elseif($transfer->status == 'approved'): ?>
                        <span class="badge badge-success">Approved</span>
                    <?php elseif($transfer->status == 'rejected'): ?>
                        <span class="badge badge-danger">Rejected</span>
                    <?php else: ?>
                        <span class="badge badge-secondary">N/A</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

        
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/transfersWindow/index.blade.php ENDPATH**/ ?>