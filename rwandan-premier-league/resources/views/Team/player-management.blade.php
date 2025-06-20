@extends('layouts.team_dashboard')

@section('content')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Flash Message -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container mt-5">
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold">Player Management</h2>
            <!-- Add Player Button -->
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPlayerModal">
                <i class="fas fa-plus"></i> Add New Player
            </button>
        </div>
    </div>

    <!-- Player Table -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover shadow-sm rounded">
            <thead class="table-light">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Date of Birth</th>
                    <th>Nationality</th>
                    <th>Jersey Number</th>
                    <th>Contract Start Date</th>
                    <th>Contract End Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($players as $player)
                    <tr>
                        <td>
                            @if($player->image)
                                <img src="{{ asset('storage/' . $player->image) }}" alt="{{ $player->name }}'s image" style="border-radius:50%; width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <span>No Image</span>
                            @endif
                        </td>
                        <td>{{ $player->name }}</td>
                        <td>{{ $player->position }}</td>
                        <td>{{ $player->dob }}</td>
                        <td>{{ $player->nationality }}</td>
                        <td>{{ $player->jersey_number }}</td>
                        <td>{{ $player->contract_start_date }}</td>
                        <td>{{ $player->contract_end_date }}</td>
                        <td>

                        <a href="{{ route('team.playerDetails', ['id' => $player->id]) }}" class="btn btn-primary">
    View Details
</a>

                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPlayerModal{{ $player->id }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <form action="{{ route('players.destroy', $player->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Player Modal -->
<div class="modal fade" id="addPlayerModal" tabindex="-1" aria-labelledby="addPlayerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addPlayerModalLabel">Add New Player</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('players.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="team_id" value="{{ auth()->user()->team_id }}">

                    <div class="mb-3">
                        <label for="name" class="form-label">Player Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control" name="position" required>
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="dob" required max="{{ now()->subYears(18)->format('Y-m-d') }}">
                    </div>
                    
                    <div class="mb-3">
                        <label for="nationality" class="form-label">Nationality</label>
                        <input type="text" class="form-control" name="nationality" required>
                    </div>
                    <div class="mb-3">
                        <label for="jersey_number" class="form-label">Jersey Number</label>
                        <input type="number" class="form-control" name="jersey_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="contract_start_date" class="form-label">Contract Start Date</label>
                        <input type="date" class="form-control" name="contract_start_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="contract_end_date" class="form-label">Contract End Date</label>
                        <input type="date" class="form-control" name="contract_end_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Player Image</label>
                        <input type="file" class="form-control" name="image" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Add Player</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Player Modals -->
@foreach($players as $player)
    <div class="modal fade" id="editPlayerModal{{ $player->id }}" tabindex="-1" aria-labelledby="editPlayerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">Edit Player</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('players.update', $player->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Player Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $player->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" class="form-control" name="position" value="{{ $player->position }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" name="dob" value="{{ $player->dob }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="nationality" class="form-label">Nationality</label>
                            <input type="text" class="form-control" name="nationality" value="{{ $player->nationality }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="jersey_number" class="form-label">Jersey Number</label>
                            <input type="number" class="form-control" name="jersey_number" value="{{ $player->jersey_number }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="contract_start_date" class="form-label">Contract Start Date</label>
                            <input type="date" class="form-control" name="contract_start_date" value="{{ $player->contract_start_date }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="contract_end_date" class="form-label">Contract End Date</label>
                            <input type="date" class="form-control" name="contract_end_date" value="{{ $player->contract_end_date }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Update Player Image</label>
                            <input type="file" class="form-control" name="image" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Update Player</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var addPlayerModal = new bootstrap.Modal(document.getElementById('addPlayerModal'));
        document.querySelector('[data-bs-target="#addPlayerModal"]').addEventListener('click', function() {
            addPlayerModal.show();
        });
    });
</script>


<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector('input[name="dob"]').addEventListener("change", function() {
        let dob = new Date(this.value);
        let today = new Date();
        let age = today.getFullYear() - dob.getFullYear();
        let monthDiff = today.getMonth() - dob.getMonth();
        let dayDiff = today.getDate() - dob.getDate();

        if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
            age--;
        }

        if (age < 18) {
            alert("Player must be at least 18 years old.");
            this.value = "";
        }
    });
});
</script>

