

<?php $__env->startSection('content'); ?>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .card {
            border-radius: 1rem;
        }
        .table th, .table td {
            text-align: center;
        }
        .table th {
            background-color: #f8f9fa;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn-print {
            font-size: 16px;
            background-color: #4e73df;
            color: white;
            border-radius: 25px;
        }
        .btn-print:hover {
            background-color: #2e59d9;
            text-decoration: none;
        }
        .performance-stats ul {
            list-style: none;
            padding: 0;
        }
        .performance-stats li {
            margin-bottom: 10px;
        }
    </style>

    <script>
        function printReport() {
            window.print();
        }
    </script>
</head>

<div class="container py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Team Report: <?php echo e($team->name); ?></h1>
    
    <div class="card shadow-lg border-0 rounded-3 bg-white p-4">
        <div class="row">
            <!-- Team Stats -->
            <div class="col-md-6 mb-4">
                <h3 class="text-lg font-semibold">Performance Overview</h3>
                <div class="performance-stats">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between">Total Matches: <span class="font-weight-bold"><?php echo e($totalMatches); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between">Goals Scored: <span class="font-weight-bold"><?php echo e($goalsScored); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between">Goals Conceded: <span class="font-weight-bold"><?php echo e($goalsConceded); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between">Yellow Cards: <span class="font-weight-bold"><?php echo e($yellowCards); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between">Red Cards: <span class="font-weight-bold"><?php echo e($redCards); ?></span></li>
                        <li class="list-group-item d-flex justify-content-between">Injuries: <span class="font-weight-bold"><?php echo e($injuries); ?></span></li>
                    </ul>
                </div>
            </div>
            
            <!-- Match Results -->
            <div class="col-md-6 mb-4">
                <h3 class="text-lg font-semibold">Recent Matches</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Opponent</th>
                                <th>Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $recentMatches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $match): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($match->match_date->format('F j, Y')); ?></td>
                                    <td>
                                        <?php if($match->home_team_id == $team->id): ?>
                                            <?php echo e($match->awayTeam->name); ?>

                                        <?php else: ?>
                                            <?php echo e($match->homeTeam->name); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($match->result); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Print Button -->
    <div class="mt-4 text-center">
        <button onclick="printReport()" class="btn btn-print">
            <i class="fa fa-print"></i> Print Report
        </button>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.team_dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/team/report.blade.php ENDPATH**/ ?>