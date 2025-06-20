<?php
    use Illuminate\Support\Facades\Auth;
?>



<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0"><?php echo e($match->homeTeam->name); ?> <span class="fw-bold">vs</span> <?php echo e($match->awayTeam->name); ?></h3>
        </div>

        
        <div class="card-body">
            <!-- Match Information -->
            <div class="row">
                <div class="col-md-6 text-center">
                    <img src="<?php echo e(asset('storage/' . ($match->homeTeam->logo ?? 'logos/default.png'))); ?>" 
                         alt="<?php echo e($match->homeTeam->name); ?>" class="rounded-circle" 
                         style="width: 100px; height: 100px;">
                    <h5 class="mt-2"><?php echo e($match->homeTeam->name); ?></h5>
                </div>
                <div class="col-md-6 text-center">
                    <img src="<?php echo e(asset('storage/' . ($match->awayTeam->logo ?? 'logos/default.png'))); ?>" 
                         alt="<?php echo e($match->awayTeam->name); ?>" class="rounded-circle" 
                         style="width: 100px; height: 100px;">
                    <h5 class="mt-2"><?php echo e($match->awayTeam->name); ?></h5>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>📅 Match Date:</strong> <?php echo e(\Carbon\Carbon::parse($match->match_date)->format('M d, Y H:i')); ?></p>
                    <p><strong>🏆 Category:</strong> <?php echo e($match->matchCategory->name); ?></p>
                    <p><strong>🏟 Venue:</strong> <?php echo e($match->stadium->name); ?></p>
                </div>
                <div class="col-md-6">
                    <h5 class="mt-3">Match Officials</h5>
                    <p><strong>⚖ Referee:</strong> <?php echo e($match->referee->name); ?></p>
                    <p><strong>🛑 Assistant Referee 1:</strong> <?php echo e($match->assistantReferees[0]->name ?? 'Not Assigned'); ?></p>
                    <p><strong>🛑 Assistant Referee 2:</strong> <?php echo e($match->assistantReferees[1]->name ?? 'Not Assigned'); ?></p>
                    <p><strong>👨‍⚖ Fourth Referee:</strong> <?php echo e($match->fourthReferee->name ?? 'Not Assigned'); ?></p>
                    <p><strong>📝 Match Commissioner:</strong> <?php echo e($match->matchCommissioner->name); ?></p>
                </div>
            </div>

            <hr>

            <!-- Action Buttons -->
            <div class="text-center mt-4">
                
                    <a href="<?php echo e(route('match.edit', $match->id)); ?>" class="btn btn-warning px-4">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="<?php echo e(route('matches.destroy', $match->id)); ?>" method="POST" class="d-inline" 
                            onsubmit="return confirm('Are you sure you want to delete this match?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger px-4">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </form>

               

                <a href="<?php echo e(route('matches.index')); ?>" class="btn btn-dark px-4">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/match/details.blade.php ENDPATH**/ ?>