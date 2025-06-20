<?php
    use Illuminate\Support\Facades\Auth;
?>



<?php $__env->startSection('content'); ?>

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    
</head>

<h2>Loan Deals</h2>

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



<div class="d-flex justify-content-between mb-4">
    <!-- Button to trigger modal -->
    <button class="btn btn-primary" 
            data-bs-toggle="modal" 
            data-bs-target="#createLoanModal" 
            <?php if(!$isOpen): echo 'disabled'; endif; ?>>
        <?php if($isOpen): ?>
            Create Loan Deal
        <?php else: ?>
            Transfer Window Closed - Loan Deals Unavailable
        <?php endif; ?>
    </button>

    <!-- Transfers Button (On the right side) -->
    <a href="<?php echo e(route('transfers.index')); ?>">
        <button class="btn btn-tertiary" disabled>Transfers</button>
    </a>
</div>






<!-- Loan Deals Table -->
<table class="table table-bordered mt-4">
    <thead>
        <tr>
            <th>Player Name</th>
            <th>Loan Start Date</th>
            <th>Loan End Date</th>
            <th>Receiving Team</th> 
            <th>Buy Clause</th>
            <th>Buy Clause Fee</th>
            <th>Actions</th> <!-- New Actions Column -->
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $loanDealsCreated; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loanDeal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($loanDeal->player->name); ?></td>
        <td><?php echo e($loanDeal->loan_start_date); ?></td>
        <td><?php echo e($loanDeal->loan_end_date); ?></td>
        <td><?php echo e($loanDeal->receivingTeam ? $loanDeal->receivingTeam->name : 'N/A'); ?></td>
        <td><?php echo e($loanDeal->has_buy_clause ? 'Yes' : 'No'); ?></td>
        <td><?php echo e($loanDeal->buy_clause_fee); ?></td>
        <td>
            <!-- Edit Button triggers Modal -->
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo e($loanDeal->id); ?>">
                Edit
            </button>
            <!-- Delete Form -->
            <form action="<?php echo e(route('loan-deals.destroy', $loanDeal->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button class="btn btn-danger btn-sm">Delete</button>
            </form>
        </td>
    </tr>

    <!-- Modal for editing loan deal -->
    <div class="modal fade" id="editModal<?php echo e($loanDeal->id); ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo e($loanDeal->id); ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo e(route('loan-deals.update', $loanDeal->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel<?php echo e($loanDeal->id); ?>">Edit Loan Deal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Fields -->
                        <div class="mb-3">
                            <label>Loan Start Date</label>
                            <input type="date" name="loan_start_date" value="<?php echo e($loanDeal->loan_start_date); ?>" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Loan End Date</label>
                            <input type="date" name="loan_end_date" value="<?php echo e($loanDeal->loan_end_date); ?>" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Buy Clause</label>
                            <select name="has_buy_clause" class="form-control" required>
                                <option value="1" <?php echo e($loanDeal->has_buy_clause ? 'selected' : ''); ?>>Yes</option>
                                <option value="0" <?php echo e(!$loanDeal->has_buy_clause ? 'selected' : ''); ?>>No</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Buy Clause Fee</label>
                            <input type="number" name="buy_clause_fee" value="<?php echo e($loanDeal->buy_clause_fee); ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Receiving Team</label>
                            <select name="receiving_team_id" class="form-control">
                                <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($team->id); ?>" <?php echo e($loanDeal->receiving_team_id == $team->id ? 'selected' : ''); ?>>
                                        <?php echo e($team->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </tbody>
</table>




<?php if($loanDealsReceived->isNotEmpty()): ?>
<div class="container">
    <div class="row">
        <?php $__currentLoopData = $loanDealsReceived; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loanDeal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm h-100 card-loan" style="min-height: 350px; transition: all 0.3s ease;">
                <img src="<?php echo e(asset('storage/' . $loanDeal->player->image)); ?>" 
                     class="mx-auto mt-3" 
                     alt="<?php echo e($loanDeal->player->name); ?>" 
                     style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">

                <div class="card-body p-2">
                    <h6 class="card-title"><?php echo e($loanDeal->player->name); ?></h6>
                    <p class="card-text small">Team: <?php echo e($loanDeal->player->team->name); ?></p>

                    <button class="btn btn-sm btn-outline-primary toggle-btn" 
                            data-bs-toggle="collapse" 
                            href="#playerDetails<?php echo e($loanDeal->id); ?>" 
                            role="button" 
                            aria-expanded="false" 
                            aria-controls="playerDetails<?php echo e($loanDeal->id); ?>"
                            data-target="#playerDetails<?php echo e($loanDeal->id); ?>"
                            data-button-id="btn<?php echo e($loanDeal->id); ?>"
                            id="btn<?php echo e($loanDeal->id); ?>">
                        View
                    </button>
                </div>

                <div class="collapse" id="playerDetails<?php echo e($loanDeal->id); ?>">
                    <div class="card-body p-2 text-start" style="font-size: 12px;">
                        <hr>
                        <p><strong>Loan Start:</strong> <?php echo e($loanDeal->loan_start_date); ?></p>
                        <p><strong>Loan End:</strong> <?php echo e($loanDeal->loan_end_date); ?></p>
                        <p><strong>Buy Clause:</strong> <?php echo e($loanDeal->has_buy_clause ? 'Yes' : 'No'); ?></p>
                        <p><strong>Fee:</strong> <?php echo e($loanDeal->buy_clause_fee); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.toggle-btn');
        
        buttons.forEach(button => {
            const targetId = button.getAttribute('data-target');
            const target = document.querySelector(targetId);
            
            if (target) {
                target.addEventListener('shown.bs.collapse', () => {
                    button.innerText = 'Hide';
                });
                target.addEventListener('hidden.bs.collapse', () => {
                    button.innerText = 'View';
                });
            }
        });
    });
</script>
<?php endif; ?>











<!-- Modal for creating loan deal -->
<div class="modal fade" id="createLoanModal" tabindex="-1" aria-labelledby="createLoanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLoanModalLabel">Create a Loan Deal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo e(url('/loan-deals')); ?>">
                    <?php echo csrf_field(); ?>
                    
                    <!-- Player selection dropdown -->
                    <div class="mb-3">
                        <label for="player_id" class="form-label">Player</label>
                        <select class="form-select" name="player_id" id="player_id" required>
                            <option value="" disabled selected>Select Player</option>
                            <?php $__currentLoopData = $players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($player->id); ?>"><?php echo e($player->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Hidden field for team ID (auto-filled with the logged-in team's ID) -->
                    <input type="hidden" name="team_id" value="<?php echo e(Auth::user()->team_id); ?>" required>

                    <div class="mb-3">
                        <label for="loan_start_date" class="form-label">Loan Start Date</label>
                        <input type="date" class="form-control" id="loan_start_date" name="loan_start_date" required>
                    </div>

                    <div class="mb-3">
                        <label for="loan_end_date" class="form-label">Loan End Date</label>
                        <input type="date" class="form-control" id="loan_end_date" name="loan_end_date" required>
                    </div>

                    <!-- Receiving Team Selection -->
                    <div class="mb-3">
                    <label for="receiving_team_id" class="form-label">Receiving Team</label>
                    <select class="form-select" name="receiving_team_id" id="receiving_team_id" required>
                    <option value="" disabled selected>Select Receiving Team</option>
                       <?php $__currentLoopData = App\Models\Team::where('id', '!=', Auth::user()->team_id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $receivingTeam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option value="<?php echo e($receivingTeam->id); ?>"><?php echo e($receivingTeam->name); ?></option>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    </div>


                    <div class="mb-3">
                        <label for="has_buy_clause" class="form-label">Has Buy Clause</label>
                        <input type="checkbox" name="has_buy_clause" value="1" <?php echo e(old('has_buy_clause') ? 'checked' : ''); ?>>
                    </div>

                    <div class="mb-3">
                        <label for="buy_clause_fee" class="form-label">Buy Clause Fee</label>
                        <input type="number" class="form-control" id="buy_clause_fee" name="buy_clause_fee" placeholder="Buy Clause Fee" min="0">
                    </div>

                    <button type="submit" class="btn btn-primary">Create Loan Deal</button>
                </form>
            </div>
        </div>
    </div>
</div>





<?php $__env->stopSection(); ?>

<!-- Bootstrap JS (required for modal to function) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        // Open the modal when the button is clicked
        $('.btn-primary').click(function() {
            var target = $(this).data('bs-target');
            $(target).modal('show');
        });
    });
</script>


<?php echo $__env->make('layouts.team_dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/loan_deals/index.blade.php ENDPATH**/ ?>