@extends('layouts.team_dashboard')

@section('content')

<head>
    <!-- jQuery and Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
    <h1>Add Injury</h1>

    <form method="POST" action="{{ route('injuries.store') }}">
        @csrf
        
        <div class="form-group">
            <label for="player_id">Player</label>
            <select name="player_id" id="player_id" class="form-control" required>
                <option value="">Select Player</option>
                @foreach($players as $player)
                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="injury_type">Injury Type</label>
            <input type="text" name="injury_type" id="injury_type" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="severity">Severity</label>
            <input type="text" name="severity" id="severity" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="injury_date">Injury Date</label>
            <input type="date" name="injury_date" id="injury_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="expected_recovery_date">Expected Recovery Date</label>
            <input type="date" name="expected_recovery_date" id="expected_recovery_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea name="notes" id="notes" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add Injury</button>
    </form>
@endsection
