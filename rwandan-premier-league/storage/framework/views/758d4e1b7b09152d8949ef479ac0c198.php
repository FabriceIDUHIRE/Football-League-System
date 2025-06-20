

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-4 text-center">
            <h2 class="display-4 text-uppercase font-weight-bold">League Report</h2>
            <p class="lead text-muted">Generated on <?php echo e(now()->format('d M Y')); ?></p>
            <hr>
        </div>
    </div>

    <!-- Filtering Options -->
    <div class="row mb-4">
        <div class="col-md-12">
            <form method="GET" action="<?php echo e(route('reports.index')); ?>">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="show_teams" checked> Teams
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="show_punishments" checked> Punishments
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="show_matches" checked> Match Results
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="show_goals" checked> Goals Scored
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Filter</button>
            </form>
        </div>
    </div>

    <!-- Report Data -->
    <div class="row">
        <!-- Total Teams -->
        <div class="col-md-4 mb-4">
            <div class="card border-primary h-100">
                <div class="card-header bg-primary text-white text-center">Total Teams</div>
                <div class="card-body text-center">
                    <h2><?php echo e($teamCount); ?></h2>
                </div>
            </div>
        </div>



    <!-- Goals Scored (Top Scorers) -->
    <?php if(request()->has('show_goals')): ?>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card border-success">
                <div class="card-header bg-success text-white text-center">Top Scorers</div>
                <div class="card-body">
                    <ul>
                        <?php $__currentLoopData = $topScorers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scorer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($scorer->name); ?> - <?php echo e($scorer->total_goals); ?> Goals</li>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(request()->has('show_matches')): ?>
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card border-info">
            <div class="card-header bg-info text-white text-center">Match Results</div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Home Team</th>
                            <th>Away Team</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $matches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $match): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(\Carbon\Carbon::parse($match->match_date)->format('d M Y')); ?></td>
                            <td><?php echo e($match->home_team); ?></td>
                            <td><?php echo e($match->away_team); ?></td>
                            <td><?php echo e($match->home_goals); ?> - <?php echo e($match->away_goals); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<?php if(request()->has('show_punishments')): ?>
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card border-dark">
            <div class="card-header bg-dark text-white text-center">Punishments</div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Entity</th>
                            <th>Type</th>
                            <th>Reason</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $punishments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $punishment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <!-- Display Player Name, Team Name, Coach, or Referee Name -->
                                <td>
                                    <?php if($punishment->player_id): ?>
                                        <?php echo e($punishment->player->name ?? 'Player Not Found'); ?> <!-- Display player name -->
                                    <?php elseif($punishment->team_id): ?>
                                        <?php echo e($punishment->team->name ?? 'Team Not Found'); ?> <!-- Display team name -->
                                    <?php elseif($punishment->coach_id): ?>
                                        <?php echo e($punishment->coach->name ?? 'Coach Not Found'); ?> <!-- Display coach name -->
                                    <?php elseif($punishment->referee_id): ?>
                                        <?php echo e($punishment->referee->name ?? 'Referee Not Found'); ?> <!-- Display referee name -->
                                    <?php else: ?>
                                        N/A <!-- If none of the above exist -->
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($punishment->type); ?></td>
                                <td><?php echo e($punishment->reason); ?></td>
                                <td><?php echo e($punishment->created_at->format('d M Y')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>




    <!-- Print Button -->
    <div class="text-center mt-4">
        <button onclick="window.print()" class="btn btn-primary">Print Report</button>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/reports/index.blade.php ENDPATH**/ ?>