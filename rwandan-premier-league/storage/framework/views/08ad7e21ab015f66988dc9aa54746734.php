

<?php $__env->startSection('content'); ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                
                <div class="card shadow-lg rounded-lg" style="font-size: 1.5rem; padding: 3rem;">
                    <div class="card-header" 
                         style="background-color: <?php echo e($team->primary_color); ?>; color: <?php echo e($team->secondary_color); ?>; border-radius: 15px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="mb-0" style="font-size: 3rem; font-weight: bold;"><?php echo e($team->name); ?></h2>
                            
                            <img src="<?php echo e(asset('storage/' . $team->logo)); ?>" alt="<?php echo e($team->name); ?> Logo" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                
                                <h4><strong>Location:</strong></h4>
                                <p style="font-size: 1.25rem;"><?php echo e($team->location); ?></p>
                            </div>
                            <div class="col-md-6">
                                
                                <h4><strong>Manager:</strong></h4>
                                <p style="font-size: 1.25rem;"><?php echo e($team->manager ?? 'N/A'); ?></p>
                            </div>
                        </div>

                        <hr>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                
                                <h4><strong>Primary Color:</strong></h4>
                                <div class="d-flex align-items-center">
                                    <span style="display: inline-block; width: 50px; height: 50px; background-color: <?php echo e($team->primary_color); ?>; border-radius: 50%;"></span>
                                    <p style="font-size: 1.25rem; margin-left: 10px;"><?php echo e($team->primary_color); ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                                <h4><strong>Secondary Color:</strong></h4>
                                <div class="d-flex align-items-center">
                                    <span style="display: inline-block; width: 50px; height: 50px; background-color: <?php echo e($team->secondary_color); ?>; border-radius: 50%;"></span>
                                    <p style="font-size: 1.25rem; margin-left: 10px;"><?php echo e($team->secondary_color); ?></p>
                                </div>
                            </div>
                        </div>

                        <hr>

                        
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h4><strong>Team History:</strong></h4>
                                <p style="font-size: 1.25rem;"><?php echo e($team->history ?? 'No history available.'); ?></p>
                            </div>
                        </div>

                        <!-- Edit and Delete Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="<?php echo e(route('teams.edit', $team->id)); ?>" class="btn btn-warning">Edit Team</a>

                            <form action="<?php echo e(route('teams.destroy', $team->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this team?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger">Delete Team</button>
                            </form>
                        </div>
                    </div>
                </div>

                
                
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/teams/show.blade.php ENDPATH**/ ?>