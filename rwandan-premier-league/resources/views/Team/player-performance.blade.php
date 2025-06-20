@extends('layouts.team_dashboard')

@section('content')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Player Performance and Statistics</h3>

            <div class="d-flex justify-content-between mb-3">
                <!-- Button to trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerPerformanceModal">
                    Register Performance
                </button>
            </div>

            <div class="card">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card-body">
                    <!-- Table to display player stats -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Player Name</th>
                                <th>Goals</th>
                                <th>Assists</th>
                                <th>Clean Sheets</th>
                                <th>Matches Played</th>
                                <th>Minutes Played</th>
                                <th>Yellow Cards</th>
                                <th>Red Cards</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($performances as $performance)
                                <tr>
                                    <td>{{ $performance->player->name ?? 'Unknown' }}</td>
                                    <td>{{ $performance->goals }}</td>
                                    <td>{{ $performance->assists }}</td>
                                    <td>{{ $performance->clean_sheets }}</td>
                                    <td>{{ $performance->matches_played ?? 0 }}</td>
                                    <td>{{ $performance->minutes_played ?? 0 }}</td>
                                    <td>{{ $performance->yellow_cards }}</td>
                                    <td>{{ $performance->red_cards }}</td>
                                    <td>
                                        <a href="{{ route('team.show-player-performance', $performance->id) }}" class="btn btn-primary">Edit</a>



    <form action="{{ route('player-performance.delete', $performance->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
            Delete
        </button>
    </form>
</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Register Performance Modal -->
<div class="modal fade" id="registerPerformanceModal" tabindex="-1" aria-labelledby="registerPerformanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerPerformanceModalLabel">Register Player Performance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="performanceForm" action="{{ route('player-performance.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="player_id" class="form-label">Select Player</label>
                        <select name="player_id" class="form-control" required>
                            <option value="">-- Select Player --</option>
                            @foreach ($players as $player)
                                <option value="{{ $player->id }}">{{ $player->name ?? 'Unknown' }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Goals</label>
                        <input type="number" name="goals" class="form-control" required min="0">
                    </div>
                    <div class="mb-3">
                        <label>Assists</label>
                        <input type="number" name="assists" class="form-control" required min="0">
                    </div>
                    <div class="mb-3">
                        <label>Clean Sheets</label>
                        <input type="number" name="clean_sheets" class="form-control" required min="0">
                    </div>
                    <div class="mb-3">
                        <label>Matches Played</label>
                        <input type="number" name="matches_played" class="form-control" required min="0">
                    </div>
                    <div class="mb-3">
                        <label>Minutes Played</label>
                        <input type="number" name="minutes_played" class="form-control" required min="0">
                    </div>
                    <div class="mb-3">
                        <label>Yellow Cards</label>
                        <input type="number" name="yellow_cards" class="form-control" required min="0">
                    </div>
                    <div class="mb-3">
                        <label>Red Cards</label>
                        <input type="number" name="red_cards" class="form-control" required min="0">
                    </div>
                    <button type="submit" class="btn btn-success">Save Performance</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
