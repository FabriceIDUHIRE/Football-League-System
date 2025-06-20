

<?php $__env->startSection('content'); ?>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<h3 class="mb-4 text-primary"><i class="fas fa-user-md"></i> Your Team's Doctors</h3>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Button to trigger modal -->
<button class="btn btn-primary mb-3" style="color:#fff;" data-bs-toggle="modal" data-bs-target="#addDoctorModal">
    <i class="fas fa-plus"></i> Add New Doctor
</button>

<div class="container mt-4">
    <div class="card p-4 shadow-lg">
        <!-- Doctors Table -->
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Specialization</th>
                        <th>Contact Info</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($doctor->name); ?></td>
                        <td><?php echo e($doctor->specialization); ?></td>
                        <td><?php echo e($doctor->contact_info); ?></td>
                        <td class="text-center">
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editDoctorModal" onclick="openEditModal(<?php echo e($doctor->id); ?>)">
    <i class="fas fa-edit"></i> Edit
</button>


                            <form action="<?php echo e(route('doctors.destroy', $doctor->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for Adding New Doctor -->
<div class="modal fade" id="addDoctorModal" tabindex="-1" aria-labelledby="addDoctorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addDoctorModalLabel"><i class="fas fa-user-md"></i> Add New Doctor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('doctors.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Specialization</label>
                        <input type="text" class="form-control" name="specialization" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contact Info</label>
                        <input type="text" class="form-control" name="contact_info" required>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary" style="color:#fff;"><i class="fas fa-save"></i> Save Doctor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Editing Doctor -->
<div class="modal fade" id="editDoctorModal" tabindex="-1" aria-labelledby="editDoctorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="editDoctorModalLabel"><i class="fas fa-user-md"></i> Edit Doctor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editDoctorForm" method="POST" action="<?php echo e(route('doctors.update', ['id' => 'ID_HERE'])); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="editName" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Specialization</label>
                        <input type="text" class="form-control" name="specialization" id="editSpecialization" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contact Info</label>
                        <input type="text" class="form-control" name="contact_info" id="editContactInfo" required>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-warning" style="color:#fff;">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
document.getElementById('editDoctorForm').action = `/doctors/${doctorId}`;

// Function to trigger the Edit Modal and load the doctor data into the form
function openEditModal(doctorId) {
    fetch(`/doctors/${doctorId}/edit`)  // Ensure this endpoint returns the doctor data as JSON
        .then(response => response.json())
        .then(data => {
            // Populate the form with the doctor data
            document.getElementById('editName').value = data.name;
            document.getElementById('editSpecialization').value = data.specialization;
            document.getElementById('editContactInfo').value = data.contact_info;

            // Update the form action URL to the correct one for the PUT request
            document.getElementById('editDoctorForm').action = `/doctors/${doctorId}`;
        })
        .catch(error => console.error('Error:', error));
}



$('#editDoctorModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var doctorId = button.data('id'); // Extract info from data-* attributes

    var name = button.data('name');
    var specialization = button.data('specialization');
    var contact_info = button.data('contact_info');

    // Update the form action to include the doctor ID
    var form = $(this).find('form');
    form.attr('action', '/team/doctor/' + doctorId);

    // Fill the form fields with the current data
    $('#editName').val(name);
    $('#editSpecialization').val(specialization);
    $('#editContactInfo').val(contact_info);
});



</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.team_dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/team/doctor-management.blade.php ENDPATH**/ ?>