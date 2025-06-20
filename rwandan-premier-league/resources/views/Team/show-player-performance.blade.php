@extends('layouts.team_dashboard')

@section('content')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>


    <div class="container">
        <h3>Edit Performance for {{ $player->name }}</h3>

        <div class="card">
            <div class="card-body">
            <form action="{{ route('player-performance.update', $performance->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="goals" class="form-label">Goals</label>
                        <input type="number" name="goals" class="form-control" value="{{ old('goals', $performance->goals) }}" required min="0">
                    </div>

                    <div class="mb-3">
                        <label for="assists" class="form-label">Assists</label>
                        <input type="number" name="assists" class="form-control" value="{{ old('assists', $performance->assists) }}" required min="0">
                    </div>

                    <div class="mb-3">
                        <label for="clean_sheets" class="form-label">Clean Sheets</label>
                        <input type="number" name="clean_sheets" class="form-control" value="{{ old('clean_sheets', $performance->clean_sheets) }}" required min="0">
                    </div>

                    <div class="mb-3">
                        <label for="matches_played" class="form-label">Matches Played</label>
                        <input type="number" name="matches_played" class="form-control" value="{{ old('matches_played', $performance->matches_played) }}" required min="0">
                    </div>

                    <div class="mb-3">
                        <label for="minutes_played" class="form-label">Minutes Played</label>
                        <input type="number" name="minutes_played" class="form-control" value="{{ old('minutes_played', $performance->minutes_played) }}" required min="0">
                    </div>

                    <div class="mb-3">
                        <label for="yellow_cards" class="form-label">Yellow Cards</label>
                        <input type="number" name="yellow_cards" class="form-control" value="{{ old('yellow_cards', $performance->yellow_cards) }}" required min="0">
                    </div>

                    <div class="mb-3">
                        <label for="red_cards" class="form-label">Red Cards</label>
                        <input type="number" name="red_cards" class="form-control" value="{{ old('red_cards', $performance->red_cards) }}" required min="0">
                    </div>

                    <button type="submit" class="btn btn-success">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection
