@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Create Match</h3>

    <!-- Display Validation Errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form for creating a new match -->
    <form action="{{ route('matches.store') }}" method="POST">
        @csrf

        <div class="mb-3">
        <label for="category_id" class="form-label">Match Category</label>
        <select class="form-control" id="category_id" name="category_id" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

        <!-- Match Date -->
        <div class="mb-3">
            <label for="match_date" class="form-label">Match Date</label>
            <input type="date" class="form-control" id="match_date" name="match_date" required>
        </div>

        <!-- Stadium Selection -->
        <div class="mb-3">
            <label for="stadium" class="form-label">Stadium</label>
            <select class="form-control" id="stadium_id" name="stadium_id" required>
    @foreach($stadiums as $stadium)
        <option value="{{ $stadium->id }}">{{ $stadium->name }}</option>
    @endforeach
</select>

        </div>

        <!-- Teams Selection -->
        <div class="mb-3">
            <label for="home_team_id" class="form-label">Home Team</label>
            <select class="form-control" id="home_team_id" name="home_team_id" required>
                <option value="" disabled selected>Select Home Team</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="away_team_id" class="form-label">Away Team</label>
            <select class="form-control" id="away_team_id" name="away_team_id" required>
                <option value="" disabled selected>Select Away Team</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Referee -->
        <div class="form-group">
        <label for="referee_id">Referee</label>
        <select name="referee_id" id="referee_id" class="form-control">
            @foreach($referees as $referee)
                <option value="{{ $referee->id }}">{{ $referee->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Match Category -->
    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" class="form-control">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Create Match</button>
    </form>
</div>
@endsection
