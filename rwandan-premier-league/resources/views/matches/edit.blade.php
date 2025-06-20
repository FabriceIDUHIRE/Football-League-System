@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Match</h3>

    <!-- Display Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops! Something went wrong:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('matches.update', $match->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Match Date -->
        <div class="form-group">
            <label for="match_date">Match Date</label>
            <input 
                type="datetime-local" 
                name="match_date" 
                id="match_date" 
                class="form-control" 
                value="{{ old('match_date', $match->match_date instanceof \Carbon\Carbon ? $match->match_date->format('Y-m-d\TH:i') : $match->match_date) }}">
        </div>

        <!-- Stadium -->
        <div class="form-group">
            <label for="stadium_id">Stadium</label>
            <select name="stadium_id" id="stadium_id" class="form-control">
                @foreach($stadiums as $stadium)
                    <option value="{{ $stadium->id }}" {{ $match->stadium_id == $stadium->id ? 'selected' : '' }}>
                        {{ $stadium->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Referee -->
        <div class="form-group">
            <label for="referee_id">Referee</label>
            <select name="referee_id" id="referee_id" class="form-control">
                @foreach($referees as $referee)
                    <option value="{{ $referee->id }}" {{ $match->referee_id == $referee->id ? 'selected' : '' }}>
                        {{ $referee->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Assistant Referee 1 -->
        <div class="form-group">
            <label for="assistant_referee1_id">Assistant Referee 1</label>
            <select name="assistant_referee1_id" id="assistant_referee1_id" class="form-control">
                @foreach($referees as $referee)
                    <option value="{{ $referee->id }}" {{ $match->assistant_referee1_id == $referee->id ? 'selected' : '' }}>
                        {{ $referee->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Assistant Referee 2 -->
        <div class="form-group">
            <label for="assistant_referee2_id">Assistant Referee 2</label>
            <select name="assistant_referee2_id" id="assistant_referee2_id" class="form-control">
                @foreach($referees as $referee)
                    <option value="{{ $referee->id }}" {{ $match->assistant_referee2_id == $referee->id ? 'selected' : '' }}>
                        {{ $referee->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Fourth Referee -->
        <div class="form-group">
            <label for="fourth_referee_id">Fourth Referee</label>
            <select name="fourth_referee_id" id="fourth_referee_id" class="form-control">
                @foreach($referees as $referee)
                    <option value="{{ $referee->id }}" {{ $match->fourth_referee_id == $referee->id ? 'selected' : '' }}>
                        {{ $referee->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Match Commissioner -->
        <div class="form-group">
            <label for="match_commissioner_id">Match Commissioner</label>
            <select name="match_commissioner_id" id="match_commissioner_id" class="form-control">
                @foreach($commissioners as $commissioner)
                    <option value="{{ $commissioner->id }}" {{ $match->match_commissioner_id == $commissioner->id ? 'selected' : '' }}>
                        {{ $commissioner->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Home Team -->
        <div class="form-group">
            <label for="home_team_id">Home Team</label>
            <select name="home_team_id" id="home_team_id" class="form-control">
                @foreach($teams as $team)
                    <option value="{{ $team->id }}" {{ $match->home_team_id == $team->id ? 'selected' : '' }}>
                        {{ $team->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Away Team -->
        <div class="form-group">
            <label for="away_team_id">Away Team</label>
            <select name="away_team_id" id="away_team_id" class="form-control">
                @foreach($teams as $team)
                    <option value="{{ $team->id }}" {{ $match->away_team_id == $team->id ? 'selected' : '' }}>
                        {{ $team->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Match Category -->
        <div class="form-group">
            <label for="category_id">Match Category</label>
            <select name="category_id" id="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $match->match_category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Submit Button -->
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Update Match</button>
        </div>

    </form>
</div>
@endsection
