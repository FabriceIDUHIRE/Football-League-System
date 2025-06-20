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
    <h1>Add New Contract</h1>

    <!-- Displaying Errors if There Are Any -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('contracts.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="player_id" class="form-label">Player</label>
        <select name="player_id" id="player_id" class="form-control" required>
            <option value="">Select a Player</option>
            @foreach ($players as $player)
                <option value="{{ $player->id }}" data-start-date="{{ $player->start_date }}" data-end-date="{{ $player->end_date }}">
                    {{ $player->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
    <label for="start_date" class="form-label">Contract Start Date</label>
    <input type="date" name="start_date" id="start_date" class="form-control" required>
</div>

<div class="mb-3">
    <label for="end_date" class="form-label">Contract End Date</label>
    <input type="date" name="end_date" id="end_date" class="form-control" required>
</div>


    <div class="mb-3">
        <label for="salary" class="form-label">Salary (RWF)</label>
        <input type="number" name="salary" id="salary" class="form-control" step="0.01" min="0">
    </div>

    <button type="submit" class="btn btn-primary">Add Contract</button>
</form>

</div>

<script>
    // When a player is selected, automatically fill the contract start and end dates from the player's registration details
    $('#player_id').change(function() {
    var selectedOption = $(this).find(':selected');
    var startDate = selectedOption.data('start-date');
    var endDate = selectedOption.data('end-date');

    // Pre-fill the contract start and end dates if they are not empty
    if (startDate) {
        $('#start_date').val(startDate);  // Match the ID
    }

    if (endDate) {
        $('#end_date').val(endDate);  // Match the ID
    }
});


</script>

@endsection
