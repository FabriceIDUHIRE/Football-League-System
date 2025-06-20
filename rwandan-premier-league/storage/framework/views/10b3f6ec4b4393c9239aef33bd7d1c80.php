

<?php $__env->startSection('content'); ?>

<head>
    <!-- Add Bootstrap CSS (in <head>) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Add Bootstrap JS (before closing </body> tag) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</head>
<div class="container">
    <h2>User Details</h2>

    <div class="card p-3">
        <h5>Email: <?php echo e($user->email); ?></h5>
        <h5>Username: <?php echo e($user->username); ?></h5>
        <h5>Status: 
            <span class="badge <?php echo e($user->status === 'blocked' ? 'bg-danger' : 'bg-success'); ?>">
                <?php echo e(ucfirst($user->status)); ?>

            </span>
        </h5>

        <div class="mt-3">
            <!-- Edit Button -->
            <a href="<?php echo e(route('users.edit', $user->id)); ?>" class="btn btn-primary">Edit</a>

            <!-- Delete Button -->
            <form action="<?php echo e(route('users.destroy', $user->id)); ?>" method="POST" class="d-inline">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>

            <!-- Block / Unblock Button -->
            <?php if($user->status === 'active'): ?>
                <form action="<?php echo e(route('users.block', $user->id)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-warning">Block</button>
                </form>
            <?php else: ?>
                <form action="<?php echo e(route('users.unblock', $user->id)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-success">Unblock</button>
                </form>
            <?php endif; ?>

            <!-- Reset Password -->
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#resetPasswordModal">
                Reset Password
            </button>
        </div>
    </div>
</div>

<!-- Reset Password Modal -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo e(route('users.updatePassword', $user->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reset Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="password" name="password" class="form-control" placeholder="New Password" required>
                </div>

                <div class="modal-body">          
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm New Password" required>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/users/show.blade.php ENDPATH**/ ?>