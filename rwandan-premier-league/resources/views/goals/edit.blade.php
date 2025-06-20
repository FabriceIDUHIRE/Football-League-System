<!-- resources/views/goals/edit.blade.php -->
@extends('layouts.app)

@section('content')

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<div class="container">
    <h1>Edit Goal Event</h1>

    <form method="POST" action="{{ route('goals.update', $goal->id) }}">
        @csrf
        @method('PUT') <!-- Ensure we're using the PUT method for updating -->

        <!-- Display errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Team Selection -->

        <div class="mb-3">
    <label for="team_type" class="form-label">Team Type</label>
    <select class="form-select @error('team_type') is-invalid @enderror" id="team_type" name="team_type" required>
        <option value="home" {{ $goal->team_type == 'home' ? 'selected' : '' }}>Home</option>
        <option value="away" {{ $goal->team_type == 'away' ? 'selected' : '' }}>Away</option>
    </select>
    @error('team_type')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>




        <!-- Player Selection -->
        <div class="mb-3">
            <label for="player_id" class="form-label">Select Player</label>
            <select class="form-select @error('player_id') is-invalid @enderror" id="player_id" name="player_id" required>
                @foreach ($players as $player)
                    <option value="{{ $player->id }}" {{ $goal->player_id == $player->id ? 'selected' : '' }}>
                        {{ $player->name }}
                    </option>
                @endforeach
            </select>
            @error('player_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Minute Input -->
        <div class="mb-3">
            <label for="minute" class="form-label">Minute</label>
            <input type="number" class="form-control @error('minute') is-invalid @enderror" id="minute" name="minute" value="{{ old('minute', $goal->minute) }}" required>
            @error('minute')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Event Type (Goal, Card, Injury) -->
        <div class="mb-3">
            <label for="event_type" class="form-label">Event Type</label>
            <select class="form-select @error('event_type') is-invalid @enderror" id="event_type" name="event_type" required>
                <option value="goal" {{ $goal->event_type == 'goal' ? 'selected' : '' }}>Goal</option>
                <option value="card" {{ $goal->event_type == 'card' ? 'selected' : '' }}>Card</option>
                <option value="injury" {{ $goal->event_type == 'injury' ? 'selected' : '' }}>Injury</option>
            </select>
            @error('event_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Goal Scored (Only for Goal Event) -->
        <div class="mb-3" id="goalFields" style="display: none;">
            <label for="goal_scored" class="form-label">Goals Scored</label>
            <input type="number" class="form-control @error('goal_scored') is-invalid @enderror" id="goal_scored" name="goal_scored" value="{{ old('goal_scored', $goal->goal_scored) }}">
            @error('goal_scored')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Card Type (Only for Card Event) -->
        <div class="mb-3" id="cardFields" style="display: none;">
            <label for="card" class="form-label">Card Type</label>
            <select class="form-select @error('card') is-invalid @enderror" id="card" name="card">
                <option value="yellow" {{ $goal->card == 'yellow' ? 'selected' : '' }}>Yellow</option>
                <option value="red" {{ $goal->card == 'red' ? 'selected' : '' }}>Red</option>
            </select>
            @error('card')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Injury Details (Only for Injury Event) -->
        <div class="mb-3" id="injuryFields" style="display: none;">
            <label for="injury" class="form-label">Injury Details</label>
            <input type="text" class="form-control @error('injury') is-invalid @enderror" id="injury" name="injury" value="{{ old('injury', $goal->injury) }}">
            @error('injury')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        // Initially hide/show fields based on event type
        var eventType = $('#event_type').val();
        toggleEventFields(eventType);

        // When event type changes, toggle fields accordingly
        $('#event_type').on('change', function() {
            var eventType = $(this).val();
            toggleEventFields(eventType);
        });

        function toggleEventFields(eventType) {
            $('#goalFields').hide();
            $('#cardFields').hide();
            $('#injuryFields').hide();

            if (eventType === 'goal') {
                $('#goalFields').show();
            } else if (eventType === 'card') {
                $('#cardFields').show();
            } else if (eventType === 'injury') {
                $('#injuryFields').show();
            }
        }
    });
</script>

@endsection
