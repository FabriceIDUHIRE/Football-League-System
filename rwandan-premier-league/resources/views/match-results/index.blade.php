@extends('layouts.team_dashboard')

@section('content')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<div class="container">
    <h1>Match Results</h1>
    <a href="{{ route('match-results.create') }}" class="btn btn-primary mb-3">Register New Match Result</a>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach ($matchResults as $result)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header" data-bs-toggle="collapse" data-bs-target="#collapseMatch{{ $result->id }}" aria-expanded="false" aria-controls="collapseMatch{{ $result->id }}">
                    <strong>
                        @if($result->homeTeam && $result->awayTeam)
                            {{ $result->homeTeam->name }} vs {{ $result->awayTeam->name }}
                        @else
                            Teams not found
                        @endif
                    </strong>
                    </div>
                    <div id="collapseMatch{{ $result->id }}" class="collapse">
                        <div class="card-body">
                            <strong>
                                {{ $result->match ? $result->match->id : 'No match available' }}
                            </strong>
                            <p><strong>Status:</strong> {{ $result->match_status }}</p>
                            <p><strong>Scores:</strong> {{ $result->home_team_score }} - {{ $result->away_team_score }}</p>
                            <p><strong>Goals:</strong></p>
                            <ul>
                                <li><strong>Home Team:</strong> {{ $result->goals_home_team }} goals</li>
                                <li><strong>Away Team:</strong> {{ $result->goals_away_team }} goals</li>
                            </ul>
                            <p><strong>Yellow Cards:</strong></p>
                            <ul>
                                <li><strong>Home Team:</strong> {{ $result->yellow_cards_home_team }} yellow cards</li>
                                <li><strong>Away Team:</strong> {{ $result->yellow_cards_away_team }} yellow cards</li>
                            </ul>
                            <p><strong>Red Cards:</strong></p>
                            <ul>
                                <li><strong>Home Team:</strong> {{ $result->red_cards_home_team }} red cards</li>
                                <li><strong>Away Team:</strong> {{ $result->red_cards_away_team }} red cards</li>
                            </ul>
                            <p><strong>Injuries:</strong></p>
                            <ul>
                                <li><strong>Home Team Injuries:</strong> {{ $result->injured_players_home_team }} injured players</li>
                                <li><strong>Away Team Injuries:</strong> {{ $result->injured_players_away_team }} injured players</li>
                            </ul>
                            <p><strong>Substitutions:</strong></p>
                            <ul>
                                <li><strong>Home Team:</strong> {{ $result->substitutions_home_team }} substitutions</li>
                                <li><strong>Away Team:</strong> {{ $result->substitutions_away_team }} substitutions</li>
                            </ul>
                            <p><strong>Assists:</strong></p>
                            <ul>
                                <li><strong>Home Team:</strong> {{ $result->assists_home_team }} assists</li>
                                <li><strong>Away Team:</strong> {{ $result->assists_away_team }} assists</li>
                            </ul>
                            <p><strong>Referees:</strong></p>
                            <ul>
                                <li><strong>Main Referee:</strong> {{ $result->referee ? $result->referee->name : 'Not Assigned' }}</li>
                                <li><strong>Assistant Referee 1:</strong> {{ $result->assistant_referee_1 ? $result->assistant_referee_1->name : 'Not Assigned' }}</li>
                                <li><strong>Assistant Referee 2:</strong> {{ $result->assistant_referee_2 ? $result->assistant_referee_2->name : 'Not Assigned' }}</li>
                                <li><strong>Fourth Referee:</strong> {{ $result->fourthReferee ? $result->fourthReferee->name : 'Not Assigned' }}</li>
                                <li><strong>Referee Assessor:</strong> {{ $result->refereeAssessor ? $result->refereeAssessor->name : 'Not Assigned' }}</li>
                                <li><strong>Match Commissioner:</strong> {{ $result->match_commissioner ? $result->match_commissioner->name : 'Not Assigned' }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('match-results.edit', $result->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
