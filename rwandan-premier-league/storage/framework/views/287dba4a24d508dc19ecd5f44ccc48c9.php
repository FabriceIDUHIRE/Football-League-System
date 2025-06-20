

<?php $__env->startSection('content'); ?>
<div class="container">
    <h3 class="mb-4">Player Details</h3>

    <div class="card">
        <div class="row g-0">
            <!-- Player Image -->
            <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
                <?php if($player->image): ?>
                    <img src="<?php echo e(asset('storage/' . $player->image)); ?>" alt="<?php echo e($player->name); ?>" class="img-fluid rounded" style="max-width: 100%; border-radius:100%;">
                <?php else: ?>
                    <p>No image available</p>
                <?php endif; ?>
            </div>

            <!-- Player Details -->
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title"><?php echo e($player->name); ?></h4>
                    <p><strong>Team:</strong> <?php echo e($player->team->name); ?></p>
                    <p><strong>Position:</strong> <?php echo e($player->position); ?></p>
                    <p><strong>Date of Birth:</strong> <?php echo e($player->dob); ?></p>
                    <p><strong>Nationality:</strong> <?php echo e($player->nationality); ?></p>
                    <p><strong>Jersey Number:</strong> <?php echo e($player->jersey_number); ?></p>

                    <a href="<?php echo e(route('admin.players')); ?>" class="btn btn-secondary mt-3">Back to Players List</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Player Statistics -->
    <div class="row mt-4">
        <!-- Goals & Assists -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-futbol text-success"></i> Performance</h5>
                    <p><strong>Goals Scored:</strong> <?php echo e($goals); ?></p>
                </div>
            </div>
        </div>

        <!-- Cards Received -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-exclamation-triangle text-danger"></i> Disciplinary</h5>
                    <p><strong>Yellow Cards:</strong> <?php echo e($yellowCards); ?></p>
                    <p><strong>Red Cards:</strong> <?php echo e($redCards); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Injuries -->
    <div class="card mt-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-user-injured text-warning"></i> Injury History</h5>
            <?php if($injuries->isEmpty()): ?>
                <p class="text-muted">No recorded injuries.</p>
            <?php else: ?>
                <ul class="list-group">
                    <?php $__currentLoopData = $injuries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $injury): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item">
                            <strong><?php echo e($injury->injury); ?></strong> - 
                            <small>Occurred at minute <?php echo e($injury->minute); ?></small>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/players/show.blade.php ENDPATH**/ ?>