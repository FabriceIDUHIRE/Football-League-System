
<?php
    use Illuminate\Support\Facades\Auth;
?>


<?php $__env->startSection('content'); ?>

<head>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<?php if(!Auth::check()): ?>
    <script>window.location.href = "<?php echo e(route('login')); ?>";</script>
<?php endif; ?>


<div class="container d-flex justify-content-center mt-8"> 
    <div class="col-md-6">
        <h1 class="text-center mb-4" style="margin-bottom: 5rem;">⚽ <strong>Match Management</strong></h1>

        <?php if($matches->isEmpty()): ?>
            <div class="alert alert-warning text-center">
                <strong>No upcoming matches available.</strong>
            </div>
        <?php else: ?>
            <div class="d-flex flex-column align-items-center" style="display: flex; justify-content: center;  gap: 10rem;">
                <?php $__currentLoopData = $matches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $match): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('team.details', $match->id)); ?>" class="text-decoration-none">
                        <div class="card shadow-lg border-0 mb-4 hover-effect" style="width: 100%; max-width: 450px; cursor: pointer;">
                            <div class="card-header bg-primary text-white text-center">
                                <h5 class="mb-0">
                                    <?php if($match->home_team_id == $teamId): ?>
                                        <strong><?php echo e(optional($match->homeTeam)->name); ?></strong> 
                                        <span class="text-warning">🆚</span> 
                                        <?php echo e(optional($match->awayTeam)->name); ?>

                                    <?php else: ?>
                                        <?php echo e(optional($match->homeTeam)->name); ?> 
                                        <span class="text-warning">🆚</span> 
                                        <strong><?php echo e(optional($match->awayTeam)->name); ?></strong>
                                    <?php endif; ?>
                                </h5>
                            </div>
                            <div class="card-body">
                                <p class="mb-2"><strong>📅 Date:</strong> <?php echo e(\Carbon\Carbon::parse($match->match_date)->format('d M Y, H:i')); ?></p>
                                <p class="mb-2"><strong>🏆 Category:</strong> <?php echo e(optional($match->category)->name); ?></p>
                                <p class="mb-2"><strong>📍 Venue:</strong> <?php echo e(optional($match->stadium)->name); ?></p>
                                <p class="mb-0"><strong>⚖ Referee:</strong> <?php echo e(optional($match->referee)->name); ?></p>
                            </div>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    /* Add hover effect for better UX */
    .hover-effect:hover {
        transform: scale(1.03);
        transition: all 0.3s ease-in-out;
    }
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.team_dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/Team/match-management.blade.php ENDPATH**/ ?>