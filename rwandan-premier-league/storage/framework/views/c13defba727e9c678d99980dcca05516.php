<?php use Illuminate\Support\Str; ?>



<?php $__env->startSection('title', 'Announcements'); ?>

<?php $__env->startSection('header', 'Announcements'); ?>

<?php $__env->startSection('content'); ?>

<head>
    <style>
        /* Ensure that flexbox is applied correctly */
        .announcement-cards-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem; /* Adds space between cards */
        }

        .announcement-cards-container a {
            display: block;
            text-decoration: none;
            flex: 1 1 calc(33% - 1rem); /* Make each card take 33% of the width minus the gap */
            margin: 0.5rem; /* Adds margin around the card */
        }

        /* Make sure cards don't grow too large */
        .card {
            height: 100%;
        }
    </style>
</head>

<div class="announcements-container">
    <h2>Recent Announcements</h2>

    <?php if($announcements->isEmpty()): ?>
        <p>No announcements available.</p>
    <?php else: ?>
        <div class="announcement-cards-container">
            <?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('announcement.show', $announcement->id)); ?>" class="text-decoration-none">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($announcement->title); ?></h5>
                            <p class="card-text"><?php echo e(Str::limit($announcement->content, 100)); ?></p>
                            <p class="text-muted small">Published on: <?php echo e($announcement->created_at->format('d M Y')); ?></p>
                        </div>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.team_dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/team/announcements.blade.php ENDPATH**/ ?>