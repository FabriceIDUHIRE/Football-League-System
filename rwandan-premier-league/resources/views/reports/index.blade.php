@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-4 text-center">
            <h2 class="display-4 text-uppercase font-weight-bold">League Report</h2>
            <p class="lead text-muted">Generated on {{ now()->format('d M Y') }}</p>
            <hr>
        </div>
    </div>

    <!-- Filtering Options -->
    <div class="row mb-4">
        <div class="col-md-12">
            <form method="GET" action="{{ route('reports.index') }}">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="show_teams" checked> Teams
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="show_punishments" checked> Punishments
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="show_matches" checked> Match Results
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="show_goals" checked> Goals Scored
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Filter</button>
            </form>
        </div>
    </div>

    <!-- Report Data -->
    <div class="row">
        <!-- Total Teams -->
        <div class="col-md-4 mb-4">
            <div class="card border-primary h-100">
                <div class="card-header bg-primary text-white text-center">Total Teams</div>
                <div class="card-body text-center">
                    <h2>{{ $teamCount }}</h2>
                </div>
            </div>
        </div>



    <!-- Goals Scored (Top Scorers) -->
    @if(request()->has('show_goals'))
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card border-success">
                <div class="card-header bg-success text-white text-center">Top Scorers</div>
                <div class="card-body">
                    <ul>
                        @foreach($topScorers as $scorer)
                        <li>{{ $scorer->name }} - {{ $scorer->total_goals }} Goals</li>

                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(request()->has('show_matches'))
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card border-info">
            <div class="card-header bg-info text-white text-center">Match Results</div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Home Team</th>
                            <th>Away Team</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($matches as $match)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($match->match_date)->format('d M Y') }}</td>
                            <td>{{ $match->home_team }}</td>
                            <td>{{ $match->away_team }}</td>
                            <td>{{ $match->home_goals }} - {{ $match->away_goals }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif


@if(request()->has('show_punishments'))
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card border-dark">
            <div class="card-header bg-dark text-white text-center">Punishments</div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Entity</th>
                            <th>Type</th>
                            <th>Reason</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($punishments as $punishment)
                            <tr>
                                <!-- Display Player Name, Team Name, Coach, or Referee Name -->
                                <td>
                                    @if($punishment->player_id)
                                        {{ $punishment->player->name ?? 'Player Not Found' }} <!-- Display player name -->
                                    @elseif($punishment->team_id)
                                        {{ $punishment->team->name ?? 'Team Not Found' }} <!-- Display team name -->
                                    @elseif($punishment->coach_id)
                                        {{ $punishment->coach->name ?? 'Coach Not Found' }} <!-- Display coach name -->
                                    @elseif($punishment->referee_id)
                                        {{ $punishment->referee->name ?? 'Referee Not Found' }} <!-- Display referee name -->
                                    @else
                                        N/A <!-- If none of the above exist -->
                                    @endif
                                </td>
                                <td>{{ $punishment->type }}</td>
                                <td>{{ $punishment->reason }}</td>
                                <td>{{ $punishment->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif




    <!-- Print Button -->
    <div class="text-center mt-4">
        <button onclick="window.print()" class="btn btn-primary">Print Report</button>
    </div>
</div>
@endsection
