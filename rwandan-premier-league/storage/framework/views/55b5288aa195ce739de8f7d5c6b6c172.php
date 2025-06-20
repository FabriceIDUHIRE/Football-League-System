

<?php $__env->startSection('content'); ?>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>


<div class="container">
    <?php if($matchResults): ?> <!-- Check if match data exists -->
        <h2 class="mb-4">📊 Match Stats: <?php echo e($matchResults->home_team_name); ?> vs <?php echo e($matchResults->away_team_name); ?></h2>

        <div class="row">
            
            <div class="col-md-12">
                <h4>🏟️ Match Summary</h4>
                <p>Total Goals: <?php echo e($matchResults->total_goals); ?></p>
                <p>Total Injuries: <?php echo e($matchResults->total_injuries); ?></p>
                <p>Yellow Cards: <?php echo e($matchResults->yellow_cards); ?></p>
                <p>Red Cards: <?php echo e($matchResults->red_cards); ?></p>
            </div>
        </div>

        <hr>

        
        <h5>⚽ Goal Scorers:</h5>
        <ul>
            <?php $__currentLoopData = $groupedPerformances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $playerName => $stats): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($stats['goals'] > 0): ?> <!-- Only display players with goals -->
                    <li><?php echo e($playerName); ?> - Goals: <?php echo e($stats['goals']); ?></li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        
        <h5>🩹 Injuries:</h5>
        <ul>
            <?php $__currentLoopData = $groupedPerformances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $playerName => $stats): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($stats['injuries'] > 0): ?> <!-- Only display players with injuries -->
                    <li><?php echo e($playerName); ?> - Injuries: <?php echo e($stats['injuries']); ?></li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        
        <h5>🟨 Yellow Cards:</h5>
        <ul>
            <?php $__currentLoopData = $groupedPerformances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $playerName => $stats): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($stats['yellow_cards'] > 0): ?> <!-- Only display players with yellow cards -->
                    <li><?php echo e($playerName); ?> - Yellow Cards: <?php echo e($stats['yellow_cards']); ?></li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        
        <h5>🟥 Red Cards:</h5>
        <ul>
            <?php $__currentLoopData = $groupedPerformances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $playerName => $stats): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($stats['red_cards'] > 0): ?> <!-- Only display players with red cards -->
                    <li><?php echo e($playerName); ?> - Red Cards: <?php echo e($stats['red_cards']); ?></li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php else: ?>
        <p>No stats available for this match.</p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.team_dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/team/match_stats.blade.php ENDPATH**/ ?>