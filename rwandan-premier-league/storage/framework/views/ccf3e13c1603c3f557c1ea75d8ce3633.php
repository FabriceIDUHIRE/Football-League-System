<!-- resources/views/transfers/create.blade.php -->



<?php $__env->startSection('content'); ?>

<head>
    <!-- jQuery and Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<div class="container">
    <h1>Create New Transfer</h1>

    <?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>

    <form action="<?php echo e(route('transfers.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <!-- Player Selection -->
        <div class="form-group">
            <label for="player_id">Player</label>
            <select name="player_id" id="player_id" class="form-control">
                <?php $__currentLoopData = $players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($player->id); ?>"><?php echo e($player->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>


        <!-- From Team -->
        <div class="form-group">
            <label for="from_team_id">From Team</label>
            <input type="text" class="form-control" value="<?php echo e(auth()->user()->team->name); ?>" disabled>
            <input type="hidden" name="from_team_id" value="<?php echo e($loggedTeamId); ?>">
        </div>

        <!-- To Team -->
        <div class="form-group">
            <label for="to_team_id">To Team</label>
            <select name="to_team_id" id="to_team_id" class="form-control">
                <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($team->id); ?>"><?php echo e($team->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Transfer Fee -->
        <div class="form-group">
            <label for="transfer_fee">Transfer Fee</label>
            <input type="text" name="transfer_fee" id="transfer_fee" class="form-control" value="<?php echo e(old('transfer_fee')); ?>">
        </div>

        <!-- Contract Start Date -->
        <div class="form-group">
            <label for="contract_start_date">Contract Start Date</label>
            <input type="date" name="contract_start_date" id="contract_start_date" class="form-control" value="<?php echo e(old('contract_start_date')); ?>">
        </div>

        <!-- Contract End Date -->
        <div class="form-group">
            <label for="contract_end_date">Contract End Date</label>
            <input type="date" name="contract_end_date" id="contract_end_date" class="form-control" value="<?php echo e(old('contract_end_date')); ?>">
        </div>

        <!-- Transfer Date -->
        <div class="form-group">
            <label for="transfer_date">Transfer Date</label>
            <input type="date" name="transfer_date" id="transfer_date" class="form-control" value="<?php echo e(old('transfer_date')); ?>" required>
        </div>

        <!-- Contract Duration -->
<div class="form-group">
    <label for="contract_duration">Contract Duration (in years)</label>
    <input type="number" name="contract_duration" id="contract_duration" class="form-control" value="<?php echo e(old('contract_duration')); ?>" required>
</div>

<!-- Status -->
<div class="form-group">
    <label for="status">Status</label>
    <select name="status" id="status" class="form-control" required>
        <option value="Active">Active</option>
        <option value="Inactive">Inactive</option>
        <option value="Pending">Pending</option>
        <option value="Completed">Completed</option>
    </select>
</div>


        <button type="submit" class="btn btn-success mt-3">Save Transfer</button>
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.team_dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/transfers/create.blade.php ENDPATH**/ ?>