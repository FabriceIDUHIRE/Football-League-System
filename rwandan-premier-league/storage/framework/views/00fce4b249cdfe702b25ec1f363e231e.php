<?php
    use Illuminate\Support\Facades\Auth;
?>




<?php $__env->startSection('content'); ?>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<div class="container mt-4">
    <h2 class="mb-4">Sponsorship Details</h2>

    <!-- Add Sponsor Button -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addSponsorModal">
        <i class="fas fa-plus"></i> Add New Sponsor
    </button>


    <?php if($errors->any()): ?>
      <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
       </div>
    <?php endif; ?>

    <!-- Flash Message -->
    <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <!-- Sponsors Table -->
    <table class="table table-bordered shadow-sm">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Contract Start</th>
                <th>Contract End</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $sponsors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sponsor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($sponsor->sponsor_name); ?></td>
                <td><?php echo e($sponsor->contract_start_date); ?></td>
                <td><?php echo e($sponsor->contract_end_date); ?></td>
                <td><?php echo e(number_format($sponsor->amount, 2)); ?> RWF</td>
                <td>
                  
                    <a href="<?php echo e(route('sponsors.edit', $sponsor->id)); ?>" class="btn btn-primary btn-sm">
    <i class="fas fa-edit"></i>
</a>



<form action="<?php echo e(route('sponsors.destroy', $sponsor->id)); ?>" method="POST" style="display: inline;">
    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this sponsor?');">
        <i class="fas fa-trash"></i>
    </button>
</form>

                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<!-- Add Sponsor Modal -->
<div class="modal fade" id="addSponsorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="exampleModalLabel">Add New Sponsor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="<?php echo e(route('sponsors.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="team_id" value="<?php echo e(Auth::user()->team_id); ?>">

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Sponsor Name</label>
                        <input type="text" name="sponsor_name" class="form-control" placeholder="Sponsor Name" required>
                    </div>

                    <div class="mb-3">
                        <label>Contract Start Date</label>
                        <input type="date" name="contract_start_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Contract End Date</label>
                        <input type="date" name="contract_end_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Amount (RWF)</label>
                        <input type="number" name="amount" class="form-control" placeholder="1000000 RWF" required>
                    </div>

                    <input type="hidden" name="team_id" value="<?php echo e(Auth::user()->team_id); ?>">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save Sponsor</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/sponsors/index.blade.php ENDPATH**/ ?>