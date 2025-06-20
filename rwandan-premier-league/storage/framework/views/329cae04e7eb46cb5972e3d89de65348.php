

<?php $__env->startSection('content'); ?>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<div class="container">
<h1 class="mb-4" style="margin-top:5rem;">Match Results</h1>

<?php if($matchResults->count()): ?>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Date</th>
                <th>Home Team</th>
                <th>Away Team</th>
                <th>Stadium</th>
                <th>Total Goals</th>
                <th>Total Injuries</th>
                <th>Total Cards</th>
                <th>Yellow Cards</th>
                <th>Red Cards</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $matchResults; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($result->match_date); ?></td>
                    <td><?php echo e($result->home_team_name); ?></td>
                    <td><?php echo e($result->away_team_name); ?></td>
                    <td><?php echo e($result->stadium_name); ?></td>
                    <td><?php echo e($result->total_goals); ?></td>
                    <td><?php echo e($result->total_injuries); ?></td>
                    <td><?php echo e($result->total_cards); ?></td>
                    <td><?php echo e($result->yellow_cards); ?></td>
                    <td><?php echo e($result->red_cards); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No match results available.</p>
<?php endif; ?>

<h2 style="margin-top:4rem;">Player Performance</h2>

<?php if(count($groupedPerformances)): ?>
    <table class="table table-bordered" style="margin-top:2rem;">
        <thead>
            <tr>
                <th>Match</th>
                <th>Player</th>
                <th>Injuries</th>
                <th>Cards</th>
                <th>Yellow Cards</th>
                <th>Red Cards</th>
                <th>Goals</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $groupedPerformances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $match => $players): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player => $stats): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($match); ?></td>
                        <td><?php echo e($player); ?></td>
                        <td><?php echo e($stats['injuries']); ?></td>
                        <td><?php echo e($stats['cards']); ?></td>
                        <td><?php echo e($stats['yellow_cards']); ?></td>
                        <td><?php echo e($stats['red_cards']); ?></td>
                        <td><?php echo e($stats['goals']); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No player performance data available.</p>
<?php endif; ?>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/results/index.blade.php ENDPATH**/ ?>