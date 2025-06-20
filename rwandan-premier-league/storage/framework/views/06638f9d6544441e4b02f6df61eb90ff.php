

<?php $__env->startSection('content'); ?>

<head>
    <!-- jQuery and Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<div class="container">
    <h1>Add New Contract</h1>

    <!-- Displaying Errors if There Are Any -->
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('contracts.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>

    <div class="mb-3">
        <label for="player_id" class="form-label">Player</label>
        <select name="player_id" id="player_id" class="form-control" required>
            <option value="">Select a Player</option>
            <?php $__currentLoopData = $players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($player->id); ?>" data-start-date="<?php echo e($player->start_date); ?>" data-end-date="<?php echo e($player->end_date); ?>">
                    <?php echo e($player->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="mb-3">
    <label for="start_date" class="form-label">Contract Start Date</label>
    <input type="date" name="start_date" id="start_date" class="form-control" required>
</div>

<div class="mb-3">
    <label for="end_date" class="form-label">Contract End Date</label>
    <input type="date" name="end_date" id="end_date" class="form-control" required>
</div>


    <div class="mb-3">
        <label for="salary" class="form-label">Salary (RWF)</label>
        <input type="number" name="salary" id="salary" class="form-control" step="0.01" min="0">
    </div>

    <button type="submit" class="btn btn-primary">Add Contract</button>
</form>

</div>

<script>
    // When a player is selected, automatically fill the contract start and end dates from the player's registration details
    $('#player_id').change(function() {
    var selectedOption = $(this).find(':selected');
    var startDate = selectedOption.data('start-date');
    var endDate = selectedOption.data('end-date');

    // Pre-fill the contract start and end dates if they are not empty
    if (startDate) {
        $('#start_date').val(startDate);  // Match the ID
    }

    if (endDate) {
        $('#end_date').val(endDate);  // Match the ID
    }
});


</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.team_dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/contracts/create.blade.php ENDPATH**/ ?>