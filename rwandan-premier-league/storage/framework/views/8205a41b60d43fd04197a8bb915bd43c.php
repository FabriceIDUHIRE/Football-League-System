

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Edit Team</h1>

        <?php if($errors->any()): ?>
          <div class="alert alert-danger">
           <ul>
              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        <?php endif; ?>

        <form action="<?php echo e(route('teams.update', $team->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- Team Name -->
            <div class="form-group">
                <label for="name">Team Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo e($team->name); ?>" required>
            </div>

            <!-- Location -->
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="<?php echo e(old('location', $team->location)); ?>" required>
            </div>

            <!-- Manager -->
            <div class="form-group">
                <label for="manager">Manager</label>
                <input type="text" class="form-control" id="manager" name="manager" value="<?php echo e(old('manager', $team->manager)); ?>" required>
            </div>

            <!-- Primary Color -->
            <div class="form-group">
                <label for="primary_color">Primary Color</label>
                <input type="color" class="form-control" id="primary_color" name="primary_color" value="<?php echo e(old('primary_color', $team->primary_color)); ?>" required>
            </div>

            <!-- Secondary Color -->
            <div class="form-group">
                <label for="secondary_color">Secondary Color</label>
                <input type="color" class="form-control" id="secondary_color" name="secondary_color" value="<?php echo e(old('secondary_color', $team->secondary_color)); ?>" required>
            </div>

            <!-- Logo -->
            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" class="form-control" id="logo" name="logo">
                <?php if($team->logo): ?>
                    <div class="mt-3">
                        <img src="<?php echo e(asset('storage/' . $team->logo)); ?>" alt="Current Logo" class="img-fluid" style="max-width: 150px;">
                    </div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-warning">Update Team</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/teams/edit.blade.php ENDPATH**/ ?>