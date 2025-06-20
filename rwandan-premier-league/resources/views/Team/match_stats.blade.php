@extends('layouts.team_dashboard')

@section('content')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>


<div class="container">
    @if($matchResults) <!-- Check if match data exists -->
        <h2 class="mb-4">📊 Match Stats: {{ $matchResults->home_team_name }} vs {{ $matchResults->away_team_name }}</h2>

        <div class="row">
            {{-- Combined match-level stats --}}
            <div class="col-md-12">
                <h4>🏟️ Match Summary</h4>
                <p>Total Goals: {{ $matchResults->total_goals }}</p>
                <p>Total Injuries: {{ $matchResults->total_injuries }}</p>
                <p>Yellow Cards: {{ $matchResults->yellow_cards }}</p>
                <p>Red Cards: {{ $matchResults->red_cards }}</p>
            </div>
        </div>

        <hr>

        {{-- Goal Scorers --}}
        <h5>⚽ Goal Scorers:</h5>
        <ul>
            @foreach($groupedPerformances as $playerName => $stats)
                @if($stats['goals'] > 0) <!-- Only display players with goals -->
                    <li>{{ $playerName }} - Goals: {{ $stats['goals'] }}</li>
                @endif
            @endforeach
        </ul>

        {{-- Injured Players --}}
        <h5>🩹 Injuries:</h5>
        <ul>
            @foreach($groupedPerformances as $playerName => $stats)
                @if($stats['injuries'] > 0) <!-- Only display players with injuries -->
                    <li>{{ $playerName }} - Injuries: {{ $stats['injuries'] }}</li>
                @endif
            @endforeach
        </ul>

        {{-- Yellow Cards --}}
        <h5>🟨 Yellow Cards:</h5>
        <ul>
            @foreach($groupedPerformances as $playerName => $stats)
                @if($stats['yellow_cards'] > 0) <!-- Only display players with yellow cards -->
                    <li>{{ $playerName }} - Yellow Cards: {{ $stats['yellow_cards'] }}</li>
                @endif
            @endforeach
        </ul>

        {{-- Red Cards --}}
        <h5>🟥 Red Cards:</h5>
        <ul>
            @foreach($groupedPerformances as $playerName => $stats)
                @if($stats['red_cards'] > 0) <!-- Only display players with red cards -->
                    <li>{{ $playerName }} - Red Cards: {{ $stats['red_cards'] }}</li>
                @endif
            @endforeach
        </ul>
    @else
        <p>No stats available for this match.</p>
    @endif
</div>
@endsection
