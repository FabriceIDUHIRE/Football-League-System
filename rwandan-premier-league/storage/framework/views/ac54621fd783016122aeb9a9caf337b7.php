

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('header', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<!-- Check for new transfer notifications -->
<?php if(session('new_transfer_notification')): ?>
    <script>
        alert("<?php echo e(session('new_transfer_notification')); ?>");
    </script>
<?php endif; ?>

<div class="card">
    <p>Here's a quick overview of your team's activities.</p>
</div>

<div class="grid grid-cols-4 gap-4">
    <a href="<?php echo e(route('team.matches')); ?>" class="card">
        <h3>Total Matches Played</h3>
        <p><?php echo e($matchesCount ?? 0); ?></p>
    </a>
    <a href="<?php echo e(route('team.players')); ?>" class="card">
        <h3>Number of Players</h3>
        <p><?php echo e($playersCount ?? 0); ?></p>
    </a>
    <a href="<?php echo e(route('team.staff')); ?>" class="card">
        <h3>Staff Members</h3>
        <p><?php echo e($staffCount ?? 0); ?></p>
    </a>
    <a href="<?php echo e(route('team.doctors')); ?>" class="card">
        <h3>Doctors</h3>
        <p><?php echo e($doctorsCount ?? 0); ?></p>
    </a>
    <a href="<?php echo e(route('team.sponsors')); ?>" class="card">
        <h3>Active Sponsors</h3>
        <p><?php echo e($sponsorsCount ?? 0); ?></p>
    </a>

    <a href="<?php echo e(route('team.announcements')); ?>" class="card">
        <h3>Announcements</h3>
        <p><?php echo e($announcementsCount ?? 0); ?></p>
    </a>
    <a href="<?php echo e(route('team.posts')); ?>" class="card">
        <h3>Number of Posts</h3>
        <p><?php echo e($postsCount ?? 0); ?></p>
    </a>
    <!-- Add the new "Number of Injuries" card -->
    <a href="<?php echo e(route('team.injuries')); ?>" class="card">
        <h3>Number of Injuries</h3>
        <p><?php echo e($injuriesCount ?? 0); ?></p>
    </a>
</div>

<div class="card">
    <h3>Quick Links</h3>
    <div class="grid grid-cols-2 gap-4">
        <a href="<?php echo e(route('team.match-management')); ?>" class="quick-link">Manage Matches</a>
        <a href="<?php echo e(route('team.player-management')); ?>" class="quick-link">Player Roster</a>
        <a href="<?php echo e(route('team.sponsorship')); ?>" class="quick-link">Sponsors</a>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.team_dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/team/partials/index.blade.php ENDPATH**/ ?>