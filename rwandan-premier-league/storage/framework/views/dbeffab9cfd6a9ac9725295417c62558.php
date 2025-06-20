

<?php $__env->startSection('content'); ?>
<div class="container" style="margin-top:10rem;">
<?php
    $cards = [
        ['Players', 'user-friends', 'success', 'playerCount', 'admin.players', 'players'],
        ['Referees', 'users', 'warning', 'refereeCount', 'referees.index', 'referees'],
        ['Stadiums', 'building', 'primary', 'stadiumCount', 'stadiums.index', 'stadiums'],
        ['Sponsors', 'handshake', 'danger', 'sponsorCount', 'admin.sponsors', 'sponsors'],
        ['Users', 'user', 'dark', 'userCount', 'users.index', 'users'],
        ['Transfers Approved', 'exchange-alt', 'info', 'transferApproved', 'Windowtransfers.index', 'approved'],
        ['Transfers Rejected', 'times-circle', 'danger', 'transferRejected', 'Windowtransfers.index', 'rejected'],
        ['Transfers Pending', 'hourglass-half', 'warning', 'transferPending', 'Windowtransfers.index', 'pending'],
    ];
?>

<div class="row">
    <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3 mb-4">
            <a href="<?php echo e(route($card[4], ['type' => $card[5]])); ?>" class="text-decoration-none">
                <div class="card shadow-lg border-<?php echo e($card[2]); ?> h-100 animated fadeInUp hover-scale">
                    <div class="card-header bg-<?php echo e($card[2]); ?> text-white text-center">
                        <h4 class="mb-0"><i class="fas fa-<?php echo e($card[1]); ?>"></i> <?php echo e($card[0]); ?></h4>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <h2 class="display-4 font-weight-bold text-<?php echo e($card[2]); ?>"><?php echo e(${$card[3]}); ?></h2>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

</div>

<style>
    .hover-scale {
        transition: transform 0.3s ease-in-out;
    }
    .hover-scale:hover {
        transform: scale(1.05);
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/dashboard/index.blade.php ENDPATH**/ ?>