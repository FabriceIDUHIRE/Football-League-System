
<?php $__env->startSection('content'); ?>
<div class="container">
    <h3>All Teams</h3>



    <!-- Button to trigger modal -->
    <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addTeamModal">
        Add New Team
    </button>

        <!-- Success message after adding a team -->
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

    <!-- Teams Grid -->
<!-- Teams Grid -->
<div class="row justify-content-center g-4" style="margin-top: 7rem;">
    <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-lg-3 col-md-4 col-sm-6 d-flex justify-content-center">
        <div class="card text-center shadow-lg border-0" 
             style="width: 320px; height: 240px; border-radius: 15px; background: linear-gradient(135deg, #f8f9fa, #e9ecef); cursor: pointer; transition: transform 0.3s, box-shadow 0.3s;" 
             onclick="window.location='<?php echo e(route('teams.show', $team->id)); ?>';"
             onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0px 8px 20px rgba(0, 0, 0, 0.2)';"
             onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0px 4px 10px rgba(0, 0, 0, 0.1)';">
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
            <img src="<?php echo e(asset('storage/' . $team->logo)); ?>" alt="Team Logo"  class="img-fluid mb-3"   style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%; border: 3px solidrgb(172, 181, 188);">
                <h5 class="card-title" style="font-size: 1.4rem; font-weight: bold; color: #343a40;"><?php echo e($team->name); ?></h5>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>



    <!-- Modal for Adding New Team -->
    <div class="modal fade" id="addTeamModal" tabindex="-1" aria-labelledby="addTeamModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTeamModalLabel">Add New Team</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="<?php echo e(route('teams.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <!-- Team Name -->
    <div class="mb-3">
        <label for="name" class="form-label">Team Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <!-- Team Logo -->
    <div class="mb-3">
        <label for="logo" class="form-label">Team Logo</label>
        <input type="file" class="form-control" id="logo" name="logo" required>
    </div>

    <!-- Primary Color -->
    <div class="mb-3">
        <label for="primary_color" class="form-label">Primary Color</label>
        <input type="color" class="form-control" id="primary_color" name="primary_color" required>
    </div>

    <!-- Secondary Color -->
    <div class="mb-3">
        <label for="secondary_color" class="form-label">Secondary Color</label>
        <input type="color" class="form-control" id="secondary_color" name="secondary_color" required>
    </div>

    <!-- Location/City -->
    <div class="mb-3">
        <label for="location" class="form-label">Location/City</label>
        <input type="text" class="form-control" id="location" name="location" required>
    </div>

    <!-- Stadium -->
    <div class="mb-3">
         <label for="stadium" class="form-label">Stadium</label>
         <input type="text" class="form-control" id="stadium" name="stadium" required>
    </div>


    <!-- Manager Name -->
    <div class="mb-3">
        <label for="manager" class="form-label">Manager Name</label>
        <input type="text" class="form-control" id="manager" name="manager" required>
    </div>

    <!-- Team History -->
    <div class="mb-3">
        <label for="history" class="form-label">Team History</label>
        <textarea class="form-control" id="history" name="history" rows="4"></textarea>
    </div>

<!-- Team Role -->
<div class="mb-3">
    <label for="role" class="form-label">Select Role</label>
    <select class="form-control" id="role" name="role" required>
        <option value="">Choose Role</option>
        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>




    <button type="submit" class="btn btn-primary">Register Team</button>
</form>

            </div>
        </div>
    </div>
</div>

</div>


</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/teams/index.blade.php ENDPATH**/ ?>