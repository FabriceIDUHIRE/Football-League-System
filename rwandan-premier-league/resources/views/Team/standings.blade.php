@extends('layouts.team_dashboard')

@section('content')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>


    <div class="container">
        <h1 class="page-title">Rwandan Premier League Standings</h1>

        @if(!empty($standings) && count($standings) === 0)
        <p class="no-data">No standings data available.</p>
        @else
            <table class="standings-table table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Team</th>
                        <th>Matches Played</th>
                        <th>Wins</th>
                        <th>Draws</th>
                        <th>Losses</th>
                        <th>Goals For</th>
                        <th>Goals Against</th>
                        <th>Goal Difference</th>
                        <th>Points</th> <!-- Points column based on Wins + Draws -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($standings as $index => $standing)
                        @php
                            // Calculate Points as Wins + Draws
                            $points = $standing->stats->wins + $standing->stats->draws;
                            // Calculate Matches Played as Wins + Draws + Losses
                            $matchesPlayed = $standing->stats->wins + $standing->stats->draws + $standing->stats->losses;
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $standing->team->name }}</td>
                            <td>{{ $matchesPlayed }}</td> <!-- Matches Played -->
                            <td>{{ $standing->stats->wins }}</td>
                            <td>{{ $standing->stats->draws }}</td>
                            <td>{{ $standing->stats->losses }}</td>
                            <td>{{ $standing->stats->goals_for }}</td>
                            <td>{{ $standing->stats->goals_against }}</td>
                            <td>{{ $standing->stats->goal_difference }}</td>
                            <td>{{ $points }}</td> <!-- Points calculated from Wins + Draws -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

@section('styles')
    <style>
        .container {
            margin: 20px;
        }

        .page-title {
            font-size: 36px;
            font-weight: bold;
            color: #4CAF50;
            text-align: center;
            margin-bottom: 30px;
        }

        .no-data {
            text-align: center;
            font-size: 18px;
            color: #f44336;
            font-weight: bold;
        }

        .standings-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .standings-table th,
        .standings-table td {
            padding: 12px 20px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .standings-table th {
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            font-weight: bold;
        }

        .standings-table td {
            font-size: 14px;
            color: #333;
        }

        .standings-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .standings-table tr:hover {
            background-color: #e9e9e9;
        }

        @media screen and (max-width: 768px) {
            .standings-table th,
            .standings-table td {
                padding: 8px;
            }

            .standings-table {
                font-size: 12px;
            }

            .page-title {
                font-size: 28px;
            }
        }
    </style>
@endsection
