@extends('layouts.team_dashboard')

@section('content')

<head>
    <!-- jQuery and Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<div class="container mt-5">
    <h2 class="mb-4">Team Profile</h2>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- View Team Profile Details -->
    <div class="team-profile bg-light p-4 rounded shadow-sm">
        <div class="mb-3">
            <strong>Team Name:</strong> <span>{{ $team->name }}</span>
        </div>
        <div class="mb-3">
            <strong>Primary Color:</strong> 
            <span style="background-color: {{ $team->primary_color }}; width: 30px; height: 20px; display: inline-block;"></span>
        </div>
        <div class="mb-3">
            <strong>Secondary Color:</strong> 
            <span style="background-color: {{ $team->secondary_color }}; width: 30px; height: 20px; display: inline-block;"></span>
        </div>
        <div class="mb-3">
            <strong>Location:</strong> <span>{{ $team->location }}</span>
        </div>
        <div class="mb-3">
            <strong>History:</strong> <p>{{ $team->history }}</p>
        </div>
        <div class="mb-3">
            <strong>Manager:</strong> <span>{{ $team->manager }}</span>
        </div>

        @if($team->logo)
            <div class="mb-3">
                <strong>Logo:</strong>
                <div>
                    <img src="{{ asset('storage/' . $team->logo) }}" alt="Team Logo" class="img-fluid" style="max-width: 150px;">
                </div>
            </div>
        @endif

        <!-- Edit Profile Button (FIXED for Bootstrap 5) -->
        <button class="btn btn-warning mt-4" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
    </div>

    <!-- Modal for Editing Profile -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Team Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('team.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name">Team Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $team->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="logo">Logo</label>
                            <input type="file" name="logo" class="form-control">
                            @if($team->logo)
                                <img src="{{ asset('storage/' . $team->logo) }}" alt="Team Logo" width="100" class="mt-2">
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="primary_color">Primary Color</label>
                            <input type="color" name="primary_color" class="form-control" value="{{ old('primary_color', $team->primary_color) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="secondary_color">Secondary Color</label>
                            <input type="color" name="secondary_color" class="form-control" value="{{ old('secondary_color', $team->secondary_color) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="location">Location</label>
                            <input type="text" name="location" class="form-control" value="{{ old('location', $team->location) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="history">History</label>
                            <textarea name="history" class="form-control" rows="5" required>{{ old('history', $team->history) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="manager">Manager</label>
                            <input type="text" name="manager" class="form-control" value="{{ old('manager', $team->manager) }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <!-- Ensure jQuery and Bootstrap JS are loaded -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Optional: Ensure modal works when dynamically added
        $(document).ready(function () {
            $('#editProfileModal').on('shown.bs.modal', function () {
                console.log("Modal is shown");
            });
        });
    </script>
@endpush
