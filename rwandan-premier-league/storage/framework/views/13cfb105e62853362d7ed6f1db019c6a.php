

<?php $__env->startSection('content'); ?>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>



    <div class="container">
        <h1 class="mb-4">Bid Requests for <?php echo e($team->name); ?></h1>


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



        <a href="<?php echo e(route('bids.create')); ?>" class="btn btn-primary" style="margin-bottom:4rem;">Send New Bid Request</a>

        <?php if($bids->isEmpty()): ?>
            <div class="alert alert-info">
                No bids have been made for your team at the moment.
            </div>
        <?php else: ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Player</th>
                        <th>Bid Amount</th>
                        <th>Status</th>
                        <th>Message</th>
                        <th>Expires In</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $bids; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($bid->player->name); ?></td>
                            <td>$<?php echo e(number_format($bid->bid_amount, 2)); ?></td>
                            <td>
    <span class="badge 
        <?php echo e($bid->status == 'Accepted' ? 'bg-success' : ''); ?>

        <?php echo e($bid->status == 'Rejected' ? 'bg-danger' : ''); ?>

        <?php echo e($bid->status == 'Negotiating' ? 'bg-warning' : ''); ?>

        <?php echo e(!in_array($bid->status, ['Accepted', 'Rejected', 'Negotiating']) ? 'bg-secondary' : ''); ?>">
        <?php echo e($bid->status); ?>

    </span>
</td>

                            <td>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#messageModal<?php echo e($bid->id); ?>">Message</button>

                                <!-- Modal for Message -->
                                <div class="modal fade" id="messageModal<?php echo e($bid->id); ?>" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">

                                <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bid Messages</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Buying Team (<?php echo e($bid->buyingTeam->name); ?>):</strong> <?php echo e($bid->buying_team_message ?? 'No message yet'); ?></p>
                <p><strong>Selling Team (<?php echo e($bid->sellingTeam->name); ?>):</strong> <?php echo e($bid->selling_team_message ?? 'No response yet'); ?></p>
            </div>
            <div class="modal-footer w-100">
    <form action="<?php echo e(route('bids.updateMessage', $bid->id)); ?>" method="POST" class="w-100">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="mb-3 w-100">
            <label for="message" class="form-label">Reply</label>
            <textarea name="message" id="message" class="form-control w-100" rows="5" required style="width: 100% !important;"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
</div>

        </div>
    </div>

                                </div>
                            </td>
                            <td>
                               <span id="countdown-<?php echo e($bid->id); ?>" class="badge bg-danger"></span>
                            </td>

                            <td>
                                <?php if($bid->status == 'Pending'): ?>
                                    <form action="<?php echo e(route('bids.accept', $bid->id)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                    </form>
                                    
                                    <form action="<?php echo e(route('bids.reject', $bid->id)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                <?php elseif($bid->status == 'Negotiating'): ?>
                                    <button class="btn btn-warning btn-sm" disabled>Negotiating</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php endif; ?>

        
    </div>
<?php $__env->stopSection(); ?>


<script>
    function startCountdown(expiryTime, elementId) {
        let countdownElement = document.getElementById(elementId);

        function updateCountdown() {
            let now = new Date().getTime();
            let timeLeft = expiryTime - now;

            if (timeLeft <= 0) {
                countdownElement.innerHTML = "Expired";
                countdownElement.classList.remove('bg-danger');
                countdownElement.classList.add('bg-secondary');
                return;
            }

            let hours = Math.floor((timeLeft / (1000 * 60 * 60)) % 24);
            let minutes = Math.floor((timeLeft / (1000 * 60)) % 60);
            let seconds = Math.floor((timeLeft / 1000) % 60);

            countdownElement.innerHTML = `${hours}h ${minutes}m ${seconds}s`;
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    }

    document.addEventListener("DOMContentLoaded", function () {
        <?php $__currentLoopData = $bids; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($bid->expiry_date): ?>
                startCountdown(new Date("<?php echo e($bid->expiry_date); ?>").getTime(), "countdown-<?php echo e($bid->id); ?>");
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    });
</script>

<?php echo $__env->make('layouts.team_dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/bids/index.blade.php ENDPATH**/ ?>