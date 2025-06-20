@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="text-center mb-4">Add New Ticket</h3>
    <form action="{{ route('tickets.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="event" class="form-label">Event Name</label>
        <input type="text" class="form-control" id="event" name="event" value="{{ old('event') }}" required>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
    </div>

    <div class="mb-3">
        <label for="seats" class="form-label">Available Seats</label>
        <input type="number" class="form-control" id="seats" name="seats" value="{{ old('seats') }}" required>
    </div>

    <!-- Home Team -->
    <div class="mb-3">
        <label for="home_team_id" class="form-label">Home Team</label>
        <select class="form-control" id="home_team_id" name="home_team_id" required>
            @foreach($teams as $team)
                <option value="{{ $team->id }}" {{ old('home_team_id', $ticket->home_team_id ?? '') == $team->id ? 'selected' : '' }}>
                    {{ $team->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Away Team -->
    <div class="mb-3">
        <label for="away_team_id" class="form-label">Away Team</label>
        <select class="form-control" id="away_team_id" name="away_team_id" required>
            @foreach($teams as $team)
                <option value="{{ $team->id }}" {{ old('away_team_id', $ticket->away_team_id ?? '') == $team->id ? 'selected' : '' }}>
                    {{ $team->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Status -->
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-control" id="status" name="status" required>
            <option value="Active" {{ old('status', $ticket->status ?? 'Active') == 'Active' ? 'selected' : '' }}>Active</option>
            <option value="Sold Out" {{ old('status', $ticket->status ?? '') == 'Sold Out' ? 'selected' : '' }}>Sold Out</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Save Ticket</button>
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