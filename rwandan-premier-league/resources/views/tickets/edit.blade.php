@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="text-center mb-4">Edit Ticket</h3>
    <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Used for the update method -->
        <div class="mb-3">
            <label for="event" class="form-label">Event Name</label>
            <input type="text" class="form-control" id="event" name="event" value="{{ $ticket->event }}" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $ticket->price }}" required>
        </div>

        <div class="mb-3">
    <label for="home_team_id" class="form-label">Home Team</label>
    <select class="form-control" id="home_team_id" name="home_team_id" required>
        <option value="">-- Select Home Team --</option>
        @foreach($teams as $team)
            <option value="{{ $team->id }}" {{ $ticket->home_team_id == $team->id ? 'selected' : '' }}>
                {{ $team->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="away_team_id" class="form-label">Away Team</label>
    <select class="form-control" id="away_team_id" name="away_team_id" required>
        <option value="">-- Select Away Team --</option>
        @foreach($teams as $team)
            <option value="{{ $team->id }}" 
                {{ $ticket->away_team_id == $team->id ? 'selected' : '' }}
                {{ $team->id == $ticket->home_team_id ? 'disabled' : '' }}>
                {{ $team->name }}
            </option>
        @endforeach
    </select>
</div>




        <div class="mb-3">
            <label for="seats" class="form-label">Available Seats</label>
            <input type="number" class="form-control" id="seats" name="seats" value="{{ $ticket->seats }}" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Active" {{ $ticket->status == 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Inactive" {{ $ticket->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="Sold Out" {{ $ticket->status == 'Sold Out' ? 'selected' : '' }}>Sold Out</option>
                <!-- Add other status options if needed -->
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update Ticket</button>
    </form>
</div>
@endsection


<script>
    document.addEventListener("DOMContentLoaded", function () {
        let homeTeamSelect = document.getElementById("home_team_id");
        let awayTeamSelect = document.getElementById("away_team_id");

        function updateAwayTeamOptions() {
            let selectedHomeTeam = homeTeamSelect.value;

            Array.from(awayTeamSelect.options).forEach(option => {
                option.disabled = (option.value === selectedHomeTeam);
            });
        }

        homeTeamSelect.addEventListener("change", updateAwayTeamOptions);
        updateAwayTeamOptions(); // Call on page load to disable already selected values
    });
</script>