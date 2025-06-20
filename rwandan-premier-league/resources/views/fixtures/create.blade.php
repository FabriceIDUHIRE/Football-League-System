@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Add New Fixture</h1>

    <!-- Display success or error messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Form to Add Fixture -->
    <form action="{{ route('fixtures.store') }}" method="POST">
        @csrf
        <!-- Match Date -->
        <div class="mb-3">
            <label for="match_date" class="form-label">Match Date</label>
            <input type="datetime-local" id="match_date" name="match_date" class="form-control" value="{{ old('match_date') }}" required>
        </div>

        <!-- Home Team -->
        <div class="mb-3">
            <label for="home_team_id" class="form-label">Home Team</label>
            <select id="home_team_id" name="home_team_id" class="form-control" required>
                <option value="" disabled selected>Select Home Team</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}" {{ old('home_team_id') == $team->id ? 'selected' : '' }}>
                        {{ $team->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Away Team -->
        <div class="mb-3">
            <label for="away_team_id" class="form-label">Away Team</label>
            <select id="away_team_id" name="away_team_id" class="form-control" required>
    <option value="" disabled selected>Select Away Team</option>
    @foreach($teams as $team)
        <option value="{{ $team->id }}">{{ $team->name }}</option>
    @endforeach
</select>

        </div>

        <!-- Stadium -->
        <div class="mb-3">
            <label for="stadium_id" class="form-label">Stadium</label>
            <select id="stadium_id" name="stadium_id" class="form-control" required>
            <option value="" disabled selected>Select Stadium</option>
                @foreach($stadiums as $stadium)
                    <option value="{{ $stadium->id }}" {{ old('stadium_id') == $stadium->id ? 'selected' : '' }}>
                        {{ $stadium->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Match Category -->
<div class="mb-3">
    <label for="match_category_id" class="form-label">Match Category</label>
    <select id="match_category_id" name="match_category_id" class="form-control" required>
        <option value="" disabled selected>Select Match Category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('match_category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>


        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary" style="border-radius: 20px;">Add Fixture</button>
    </form>
</div>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const homeTeamSelect = document.getElementById('home_team_id');
        const awayTeamSelect = document.getElementById('away_team_id');

        homeTeamSelect.addEventListener('change', function () {
            const selectedHomeTeam = homeTeamSelect.value;
            Array.from(awayTeamSelect.options).forEach(option => {
                option.disabled = (option.value === selectedHomeTeam);
            });
        });

        awayTeamSelect.addEventListener('change', function () {
            const selectedAwayTeam = awayTeamSelect.value;
            Array.from(homeTeamSelect.options).forEach(option => {
                option.disabled = (option.value === selectedAwayTeam);
            });
        });
    });
</script>
