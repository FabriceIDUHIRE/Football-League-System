

<?php $__env->startSection('content'); ?>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>


<div class="container">
    <h2 class="mb-4">📋 All Match Results</h2>

    
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Match Day</th>
                <th>Home Team</th>
                <th>Score</th>
                <th>Away Team</th>
                <th>View Stats</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($results) && count($results) > 0): ?>
                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $match): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(\Carbon\Carbon::parse($match['match_day'])->format('d M Y')); ?></td>
                        <td><?php echo e($match['home_team']); ?></td>
                        <td><?php echo e($match['home_goals']); ?> - <?php echo e($match['away_goals']); ?></td>
                        <td><?php echo e($match['away_team']); ?></td>
                        <td>
                            <a href="<?php echo e(route('team.match-stats', $match['match_id'])); ?>" class="btn btn-sm btn-outline-primary">
                                📊 View Stats
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center text-muted">No match results available yet.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    
    
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.team_dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/team/match_results.blade.php ENDPATH**/ ?>