<!-- resources/views/Team/partials/notifications.blade.php -->


<?php $__env->startSection('title', 'Notifications & Announcements'); ?>

<?php $__env->startSection('header', 'Notifications & Announcements'); ?>

<?php $__env->startSection('content'); ?>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold mb-4">Recent Notifications</h3>
        <?php if($notifications->isEmpty()): ?>
            <p>No notifications at this time.</p>
        <?php else: ?>
            <ul>
                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="mb-2">
                        <strong><?php echo e($notification->title); ?></strong><br>
                        <span><?php echo e($notification->message); ?></span><br>
                        <small class="text-gray-500"><?php echo e($notification->created_at->format('F j, Y, g:i a')); ?></small>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.team_dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/Team/partials/notifications.blade.php ENDPATH**/ ?>