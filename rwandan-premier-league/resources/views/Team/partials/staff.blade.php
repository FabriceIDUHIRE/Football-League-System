@extends('layouts.team_dashboard')

@section('content')

<head>
    <!-- jQuery and Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>


<div class="container">
    <h1>Team Staff</h1>

    <!-- Button to trigger Add Staff modal -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#staffModal" onclick="openModal()">Add Staff</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Position</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($staff as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->position }}</td>
                <td>{{ $member->created_at->format('Y-m-d') }}</td>
                <td>
                    <!-- Edit button -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#staffModal" onclick="openModal({{ $member }})">Edit</button>

                    <!-- Delete button -->
                    <form action="{{ route('staff.destroy', $member->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Staff Modal -->
<div class="modal fade" id="staffModal" tabindex="-1" aria-labelledby="staffModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staffModalLabel">Add Staff</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="staffForm" action="{{ route('staff.store') }}" method="POST">
                    @csrf
                    <input type="hidden" id="staff_id" name="id">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control" id="position" name="position" required>
                    </div>

                    <button type="submit" class="btn btn-success">Save Staff</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function openModal(staff = null) {
    if (staff) {
        document.getElementById('staffModalLabel').textContent = "Edit Staff";
        document.getElementById('staff_id').value = staff.id;
        document.getElementById('name').value = staff.name;
        document.getElementById('position').value = staff.position;
        document.getElementById('staffForm').action = `/staff/${staff.id}`;
        
        // Add the hidden _method field for PUT method
        var methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        document.getElementById('staffForm').appendChild(methodInput);
    } else {
        document.getElementById('staffModalLabel').textContent = "Add Staff";
        document.getElementById('staff_id').value = '';
        document.getElementById('name').value = '';
        document.getElementById('position').value = '';
        document.getElementById('staffForm').action = "{{ route('staff.store') }}";

        // Remove any existing _method field
        var existingMethodInput = document.querySelector("input[name='_method']");
        if (existingMethodInput) {
            existingMethodInput.remove();
        }
    }
}

</script>

@endsection
