

<?php $__env->startSection('content'); ?>

<head>
    <!-- jQuery and Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<div class="container">
    <h2 class="mb-4">Contracts</h2>

    <!-- Success message -->
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <!-- Add Contract Button -->
    <a href="<?php echo e(route('contracts.create')); ?>" class="btn btn-primary mb-3">Add New Contract</a>

    <!-- Contracts Table -->
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Player</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Salary</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $contracts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contract): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($contract->player->name); ?></td>
                            <td><?php echo e($contract->start_date); ?></td>
                            <td><?php echo e($contract->end_date); ?></td>
                            <td><?php echo e(number_format($contract->salary, 2)); ?> Rwf</td>
                            <td>
                                <span class="badge 
                                    <?php if($contract->contract_status == 'active'): ?> bg-success text-dark
                                    <?php elseif($contract->contract_status == 'expired'): ?> bg-warning text-dark
                                    <?php elseif($contract->contract_status == 'terminated'): ?> bg-danger text-light
                                    <?php endif; ?>">
                                    <?php echo e(ucfirst($contract->contract_status)); ?>

                                </span>
                            </td>
                            <td>
                            <button type="button"
        class="btn btn-warning btn-sm"
        data-bs-toggle="modal"
        data-bs-target="#editContractModal"
        data-contract='<?php echo json_encode($contract, 15, 512) ?>'>
    Edit
</button>

                                <form action="<?php echo e(route('contracts.destroy', $contract->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this contract?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                
                                <!-- Add Terminate Contract Button (Only if the contract is active) -->
                                <?php if($contract->contract_status == 'active'): ?>
                                    <form action="<?php echo e(route('contracts.terminate', $contract->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to terminate this contract?');">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-danger btn-sm">Terminate Contract</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if($contracts->isEmpty()): ?>
                        <tr>
                            <td colspan="7" class="text-center">No new Contracts Made yet!.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Edit Contract Modal -->
<div class="modal fade" id="editContractModal" tabindex="-1" aria-labelledby="editContractModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="editContractForm">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Contract</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="edit_contract_id">

                    <div class="mb-3">
                        <label>Player</label>
                        <select name="player_id" id="edit_player_id" class="form-select" required>
                            <?php $__currentLoopData = $contracts->pluck('player')->unique('id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($player->id); ?>"><?php echo e($player->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Start Date</label>
                        <input type="date" name="start_date" id="edit_start_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>End Date</label>
                        <input type="date" name="end_date" id="edit_end_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Salary</label>
                        <input type="number" name="salary" id="edit_salary" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="contract_status" id="edit_status" class="form-select" required>
                            <option value="active">Active</option>
                            <option value="expired">Expired</option>
                            <option value="terminated">Terminated</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>



<?php $__env->stopSection(); ?>


<script>
    const editModal = document.getElementById('editContractModal');
    const editForm = document.getElementById('editContractForm');

    editModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const contract = JSON.parse(button.getAttribute('data-contract'));

        // Fill input fields
        document.getElementById('edit_player_id').value = contract.player_id;
        document.getElementById('edit_start_date').value = contract.start_date;
        document.getElementById('edit_end_date').value = contract.end_date;
        document.getElementById('edit_salary').value = contract.salary;
        document.getElementById('edit_status').value = contract.contract_status;

        // Set the form action URL
        editForm.action = `/contracts/${contract.id}`;
    });
</script>



<?php echo $__env->make('layouts.team_dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/contracts/index.blade.php ENDPATH**/ ?>