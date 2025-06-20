

<?php $__env->startSection('title', 'Announcement Details'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?php echo e($announcement->title); ?></h5>
            <p class="card-text"><?php echo e($announcement->content); ?></p>
            <p class="text-muted small">Published on: <?php echo e($announcement->created_at->format('d M Y')); ?></p>

            
        </div>
        <!-- Back Button -->
        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary mt-3" style="margin-top:10rem;">Go Back</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.team_dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/team/show.blade.php ENDPATH**/ ?>