

<?php $__env->startSection('content'); ?>

<head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </head>



<div class="container">
    <h1>Player Transfers</h1>

  

    <div class="d-flex justify-content-between mt-4">
        <div>
            <?php if($isOpen): ?>
                <a href="<?php echo e(route('transfers.create')); ?>" class="btn btn-primary">Add New Transfer</a>
            <?php else: ?>
                <button class="btn btn-secondary" disabled>Transfer Window Closed</button>
            <?php endif; ?>
        </div>
        <div>
            <!-- Loan Deals Button on the right -->
            <a href="<?php echo e(route('loan-deals.index')); ?>">
                <button class="btn btn-tertiary" disabled>Loan Deals</button>
            </a>
        </div>
    </div>

    <?php if($transfers->isEmpty()): ?>
        <p>No Transfer Made so far.</p>
    <?php else: ?>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Player</th>
                    <th>From Team</th>
                    <th>To Team</th>
                    <th>Transfer Fee</th>
                    <th>Transfer Date</th>
                    <th>Contract Duration</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($transfer->player->name); ?></td>
                        <td><?php echo e($transfer->fromTeam->name); ?></td>
                        <td><?php echo e($transfer->toTeam->name); ?></td>
                        <td><?php echo e(number_format($transfer->transfer_fee, 2)); ?> Rwf</td>
                        <td><?php echo e($transfer->transfer_date); ?></td>
                        <td><?php echo e($transfer->contract_duration); ?></td>
                        <td>
                            <?php if($transfer->status == 'pending' && auth()->user()->team_id == $transfer->to_team_id): ?>
                                <form action="<?php echo e(route('transfers.approve', $transfer->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                </form>
    
                                <form action="<?php echo e(route('transfers.reject', $transfer->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                </form>
                            <?php else: ?>
                                <?php echo e(ucfirst($transfer->status)); ?>

                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.team_dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/transfers/index.blade.php ENDPATH**/ ?>