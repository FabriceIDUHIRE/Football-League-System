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

<div class="container">
    <h1>Register Match Result</h1>
    <form action="{{ route('match-results.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="match_id">Match ID</label>
            <select name="match_id" id="match_id" class="form-control" required>
                @foreach($matches as $match)
                    <option value="{{ $match->id }}">{{ $match->homeTeam->name }} vs {{ $match->awayTeam->name }}</option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="home_team_id" id="home_team_id">
<input type="hidden" name="away_team_id" id="away_team_id">

        <div class="form-group">
            <label for="match_category_id">Match Category</label>
            <select name="match_category_id" id="match_category_id" class="form-control" required>
                @foreach($matchCategories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <h3>Home Team</h3>
        <div class="form-group">
            <label for="goals_home_team">Goals Scored</label>
            <input type="number" name="goals_home_team" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="yellow_cards_home_team">Yellow Cards</label>
            <input type="number" name="yellow_cards_home_team" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="red_cards_home_team">Red Cards</label>
            <input type="number" name="red_cards_home_team" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="shots_on_target_home_team">Shots on Target</label>
            <input type="number" name="shots_on_target_home_team" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="shots_off_target_home_team">Shots off Target</label>
            <input type="number" name="shots_off_target_home_team" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="possession_home_team">Possession (%)</label>
            <input type="number" name="possession_home_team" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="injured_players_home_team">Injured Players</label>
            <input type="number" name="injured_players_home_team" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="substitutions_home_team">Substitutions</label>
            <input type="number" name="substitutions_home_team" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="assists_home_team">Assists</label>
            <input type="number" name="assists_home_team" class="form-control" required>
        </div>

        <h3>Away Team</h3>
        <div class="form-group">
            <label for="goals_away_team">Goals Scored</label>
            <input type="number" name="goals_away_team" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="yellow_cards_away_team">Yellow Cards</label>
            <input type="number" name="yellow_cards_away_team" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="red_cards_away_team">Red Cards</label>
            <input type="number" name="red_cards_away_team" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="shots_on_target_away_team">Shots on Target</label>
            <input type="number" name="shots_on_target_away_team" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="shots_off_target_away_team">Shots off Target</label>
            <input type="number" name="shots_off_target_away_team" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="possession_away_team">Possession (%)</label>
            <input type="number" name="possession_away_team" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="injured_players_away_team">Injured Players</label>
            <input type="number" name="injured_players_away_team" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="substitutions_away_team">Substitutions</label>
            <input type="number" name="substitutions_away_team" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="assists_away_team">Assists</label>
            <input type="number" name="assists_away_team" class="form-control" required>
        </div>

        <div class="form-group">
    <label for="goals_home_team">Goals Scored</label>
    <input type="number" name="goals_home_team" class="form-control" required value="{{ old('goals_home_team') }}">
</div>

<h3>Away Team</h3>

        <div class="form-group">
            <label for="referee_id">Main Referee</label>
            <select name="referee_id" id="referee_id" class="form-control" required>
                @foreach($referees as $referee)
                    <option value="{{ $referee->id }}">{{ $referee->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
    <label for="assistant_referee_1_id">Assistant Referee 1</label>
    <select name="assistant_referee_1_id" id="assistant_referee_1_id" class="form-control" required>
        @foreach($referees as $referee)
            <option value="{{ $referee->id }}">{{ $referee->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="assistant_referee_2_id">Assistant Referee 2</label>
    <select name="assistant_referee_2_id" id="assistant_referee_2_id" class="form-control" required>
        @foreach($referees as $referee)
            <option value="{{ $referee->id }}">{{ $referee->name }}</option>
        @endforeach
    </select>
</div>


        <div class="form-group">
            <label for="fourth_referee_id">Fourth Referee</label>
            <select name="fourth_referee_id" id="fourth_referee_id" class="form-control">
                <option value="">None</option>
                @foreach($referees as $referee)
                    <option value="{{ $referee->id }}">{{ $referee->name }}</option>
                @endforeach
            </select>
        </div>

<div class="form-group">
    <label for="referee_assessor_id">Referee Assessor</label>
    <select name="referee_assessor_id" id="referee_assessor_id" class="form-control">
        <option value="">None</option>
        @foreach($referees as $referee)
            <option value="{{ $referee->id }}">{{ $referee->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="match_commissioner_id">Match Commissioner</label>
    <select name="match_commissioner_id" id="match_commissioner_id" class="form-control">
        <option value="">None</option>
        @foreach($commissioners as $commissioner)
            <option value="{{ $commissioner->id }}">{{ $commissioner->name }}</option>
        @endforeach
    </select>
</div>



        

        <button type="submit" class="btn btn-primary">Register Match Result</button>
    </form>
</div>

@endsection



<script>
    document.getElementById('match_id').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        document.getElementById('home_team_id').value = selectedOption.getAttribute('data-home-team');
        document.getElementById('away_team_id').value = selectedOption.getAttribute('data-away-team');
    });
</script>
