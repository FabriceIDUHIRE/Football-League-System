@extends('layouts.team_dashboard')

@section('content')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .card {
            border-radius: 1rem;
        }
        .table th, .table td {
            text-align: center;
        }
        .table th {
            background-color: #f8f9fa;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn-print {
            font-size: 16px;
            background-color: #4e73df;
            color: white;
            border-radius: 25px;
        }
        .btn-print:hover {
            background-color: #2e59d9;
            text-decoration: none;
        }
        .performance-stats ul {
            list-style: none;
            padding: 0;
        }
        .performance-stats li {
            margin-bottom: 10px;
        }
    </style>

    <script>
        function printReport() {
            window.print();
        }
    </script>
</head>

<div class="container py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Team Report: {{ $team->name }}</h1>
    
    <div class="card shadow-lg border-0 rounded-3 bg-white p-4">
        <div class="row">
            <!-- Team Stats -->
            <div class="col-md-6 mb-4">
                <h3 class="text-lg font-semibold">Performance Overview</h3>
                <div class="performance-stats">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between">Total Matches: <span class="font-weight-bold">{{ $totalMatches }}</span></li>
                        <li class="list-group-item d-flex justify-content-between">Goals Scored: <span class="font-weight-bold">{{ $goalsScored }}</span></li>
                        <li class="list-group-item d-flex justify-content-between">Goals Conceded: <span class="font-weight-bold">{{ $goalsConceded }}</span></li>
                        <li class="list-group-item d-flex justify-content-between">Yellow Cards: <span class="font-weight-bold">{{ $yellowCards }}</span></li>
                        <li class="list-group-item d-flex justify-content-between">Red Cards: <span class="font-weight-bold">{{ $redCards }}</span></li>
                        <li class="list-group-item d-flex justify-content-between">Injuries: <span class="font-weight-bold">{{ $injuries }}</span></li>
                    </ul>
                </div>
            </div>
            
            <!-- Match Results -->
            <div class="col-md-6 mb-4">
                <h3 class="text-lg font-semibold">Recent Matches</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Opponent</th>
                                <th>Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentMatches as $match)
                                <tr>
                                    <td>{{ $match->match_date->format('F j, Y') }}</td>
                                    <td>
                                        @if ($match->home_team_id == $team->id)
                                            {{ $match->awayTeam->name }}
                                        @else
                                            {{ $match->homeTeam->name }}
                                        @endif
                                    </td>
                                    <td>{{ $match->result }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Print Button -->
    <div class="mt-4 text-center">
        <button onclick="printReport()" class="btn btn-print">
            <i class="fa fa-print"></i> Print Report
        </button>
    </div>

</div>

@endsection
