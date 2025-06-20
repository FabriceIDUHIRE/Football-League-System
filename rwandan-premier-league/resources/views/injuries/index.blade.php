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
    <h1>Injuries</h1>


    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addInjuryModal">
        <i class="fas fa-plus"></i> Add Injury
    </button>

    <table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th>Player</th>
            <th>Injury Type</th>
            <th>Severity</th>
            <th>Injury Date</th>
            <th>Expected Recovery Date</th>
            <th>Notes</th>
            <th>Doctor</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($injuries as $injury)
            <tr>
                <td>{{ $injury->player->name }}</td>
                <td>{{ $injury->injury_type }}</td>
                <td>{{ $injury->severity }}</td>
                <td>{{ $injury->injury_date->format('Y-m-d') }}</td>
                <td>{{ $injury->expected_recovery_date->format('Y-m-d') }}</td>
                <td>{{ $injury->notes }}</td>
                <td>{{ $injury->doctor ? $injury->doctor->name : 'No doctor assigned' }}</td>
                <!-- Display doctor name -->
                <td>
                    <!-- Edit Button -->
                    <button class="btn btn-warning btn-sm edit-btn" 
                        data-id="{{ $injury->id }}" 
                        data-player_id="{{ $injury->player_id }}" 
                        data-injury_type="{{ $injury->injury_type }}" 
                        data-severity="{{ $injury->severity }}" 
                        data-injury_date="{{ $injury->injury_date->format('Y-m-d') }}" 
                        data-expected_recovery_date="{{ $injury->expected_recovery_date->format('Y-m-d') }}" 
                        data-notes="{{ $injury->notes }}"
                        data-doctor_id="{{ $injury->doctor_id }}"
                        data-bs-toggle="modal" 
                        data-bs-target="#editInjuryModal">
                        <i class="fas fa-edit"></i>
                    </button>

                    <!-- Delete Button -->
                    <form action="{{ route('injuries.destroy', $injury->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
    </table>

</div>

<!-- Add Injury Modal -->
<div class="modal fade" id="addInjuryModal" tabindex="-1" aria-labelledby="addInjuryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInjuryModalLabel">Add New Injury</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('injuries.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Player</label>
                        <select class="form-control" name="player_id" required>
                            <option value="">Select Player</option>
                            @foreach($players as $player)
                                <option value="{{ $player->id }}">{{ $player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Doctor</label>
                        <select class="form-control" name="doctor_id" required>
                            <option value="">Select Doctor</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Injury Type</label>
                        <input type="text" class="form-control" name="injury_type" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Severity</label>
                        <select class="form-control" name="severity" required>
                            <option value="Minor">Minor</option>
                            <option value="Moderate">Moderate</option>
                            <option value="Severe">Severe</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Injury Date</label>
                        <input type="date" class="form-control" name="injury_date" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Expected Recovery Date</label>
                        <input type="date" class="form-control" name="expected_recovery_date" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea class="form-control" name="notes" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Injury</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Injury Modal -->
<div class="modal fade" id="editInjuryModal" tabindex="-1" aria-labelledby="editInjuryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Injury</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editInjuryForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="injury_id" id="edit_injury_id">
                    <div class="mb-3">
                        <label class="form-label">Player</label>
                        <select class="form-control" name="player_id" id="edit_player_id" required>
                            @foreach($players as $player)
                                <option value="{{ $player->id }}">{{ $player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Doctor</label>
                        <select class="form-control" name="doctor_id" id="edit_doctor_id" required>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Injury Type</label>
                        <input type="text" class="form-control" name="injury_type" id="edit_injury_type" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Severity</label>
                        <select class="form-control" name="severity" id="edit_severity" required>
                            <option value="Minor">Minor</option>
                            <option value="Moderate">Moderate</option>
                            <option value="Severe">Severe</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Injury Date</label>
                        <input type="date" class="form-control" name="injury_date" id="edit_injury_date" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Expected Recovery Date</label>
                        <input type="date" class="form-control" name="expected_recovery_date" id="edit_expected_recovery_date" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea class="form-control" name="notes" id="edit_notes" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Injury</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Populate the edit form with injury data
    $('.edit-btn').click(function() {
        var injuryId = $(this).data('id');
        var playerId = $(this).data('player_id');
        var injuryType = $(this).data('injury_type');
        var severity = $(this).data('severity');
        var injuryDate = $(this).data('injury_date');
        var recoveryDate = $(this).data('expected_recovery_date');
        var notes = $(this).data('notes');
        var doctorId = $(this).data('doctor_id');
        
        var formAction = "{{ route('injuries.update', ['injury' => '__ID__']) }}".replace('__ID__', injuryId);
        $('#editInjuryForm').attr('action', formAction);
        $('#edit_injury_id').val(injuryId);
        $('#edit_player_id').val(playerId);
        $('#edit_injury_type').val(injuryType);
        $('#edit_severity').val(severity);
        $('#edit_injury_date').val(injuryDate);
        $('#edit_expected_recovery_date').val(recoveryDate);
        $('#edit_notes').val(notes);
        $('#edit_doctor_id').val(doctorId);
    });
</script>

@endsection
