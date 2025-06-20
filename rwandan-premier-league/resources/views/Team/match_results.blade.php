@extends('layouts.team_dashboard')

@section('content')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>


<div class="container">
    <h2 class="mb-4">📋 All Match Results</h2>

    {{-- Match Results Table --}}
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Match Day</th>
                <th>Home Team</th>
                <th>Score</th>
                <th>Away Team</th>
                <th>View Stats</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($results) && count($results) > 0)
                @foreach($results as $match)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($match['match_day'])->format('d M Y') }}</td>
                        <td>{{ $match['home_team'] }}</td>
                        <td>{{ $match['home_goals'] }} - {{ $match['away_goals'] }}</td>
                        <td>{{ $match['away_team'] }}</td>
                        <td>
                            <a href="{{ route('team.match-stats', $match['match_id']) }}" class="btn btn-sm btn-outline-primary">
                                📊 View Stats
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center text-muted">No match results available yet.</td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- Standings --}}
    
</div>
@endsection
