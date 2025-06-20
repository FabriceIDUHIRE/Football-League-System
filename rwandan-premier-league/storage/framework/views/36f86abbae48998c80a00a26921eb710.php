<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .header {
            margin: 20px 0;
            text-align: center;
        }
        .table-container {
            margin-top: 30px;
        }
        .btn-custom {
            border-radius: 20px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Ticket Management</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Tickets</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Reports</a></li>
        <li class="nav-item">
                        <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                            <button type="submit" class="nav-link btn btn-link text-danger">
                               <i class="fas fa-sign-out-alt"></i> Logout
                             </button>
                       </form>
                   </li>    \
                </ul>
</div>

    </nav>

    <!-- Main Container -->
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <h1 class="display-4">Tickets</h1>
            <p class="lead">Welcome to the ticket management page. Here you can view, manage, and update tickets.</p>
        </div>

        <!-- Add Ticket Button -->
        <div class="text-right mb-3">
            <a href="/tickets/create" class="btn btn-primary btn-custom">Add New Ticket</a>
        </div>

        <!-- Tickets Table -->
        <div class="table-container">
            <table class="table table-bordered table-striped">
            <thead class="thead-dark">
    <tr>
        <th>#</th>
        <th>Event</th>
        <th>Home Team</th>
        <th>Away Team</th>
        <th>Price</th>
        <th>Available Seats</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
</thead>
<tbody>
<?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($ticket->id); ?></td>
        <td><?php echo e($ticket->event); ?></td>
            <td><?php echo e($ticket->homeTeam ? $ticket->homeTeam->name : 'No Home Team'); ?></td>
            <td><?php echo e($ticket->awayTeam ? $ticket->awayTeam->name : 'No Away Team'); ?></td>
            <td>$<?php echo e($ticket->price); ?></td>
            <td><?php echo e($ticket->seats); ?></td>
            <td><?php echo e($ticket->status); ?></td>
        <td>
            <a href="<?php echo e(route('tickets.edit', $ticket->id)); ?>" class="btn btn-warning btn-sm btn-custom">Edit</a>
            <form action="<?php echo e(route('tickets.destroy', $ticket->id)); ?>" method="POST" style="display:inline-block;">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger btn-sm btn-custom">Delete</button>
            </form>
        </td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</tbody>

               
            </table>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center mt-4">
        <p>&copy; 2025 Rwandan League. All rights reserved.</p>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/tickets/index.blade.php ENDPATH**/ ?>