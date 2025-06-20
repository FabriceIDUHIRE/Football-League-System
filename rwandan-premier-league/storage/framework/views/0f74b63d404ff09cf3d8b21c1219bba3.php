

<?php $__env->startSection('content'); ?>
<div class="container">
    <h3>Players List</h3>

    <!-- Team Filter Form -->
    <form method="GET" action="<?php echo e(route('admin.players')); ?>" class="d-flex justify-content-between align-items-center">
        <div class="form-group mb-2 d-flex align-items-center">
            <label for="team_id" class="mr-2 mb-7">Filter by Team:</label>
            <select name="team_id" id="team_id" class="form-control">
                <option value="">All Teams</option>
                <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($team->id); ?>" <?php echo e($team->id == $selectedTeam ? 'selected' : ''); ?>>
                        <?php echo e($team->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary ml-3">Filter</button>
    </form>

    <!-- Players Table -->
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Team</th>
                <th>Position</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <img src="<?php echo e(asset('storage/' . $player->image)); ?>" alt="<?php echo e($player->name); ?>" width="50" height="50" class="rounded-circle">
                </td>
                <td><?php echo e($player->name); ?></td>
                <td><?php echo e($player->team->name); ?></td> 
                <td><?php echo e($player->position); ?></td>
                <td>
                    <a href="<?php echo e(route('players.show', $player->id)); ?>" class="btn btn-info">View</a>
                    <!--<form action="<?php echo e(route('players.destroy', $player->id)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger">Delete</button>
                    </form>-->
                </td>

            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/players/index.blade.php ENDPATH**/ ?>