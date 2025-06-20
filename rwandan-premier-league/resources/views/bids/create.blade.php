@extends('layouts.team_dashboard')

@section('content')

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>


    <div class="container mt-4">
        <h2>Create Bid Request</h2>


        @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
       </div>
    @endif

    <!-- Flash Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    

        <!-- Form to create a bid request -->
        <form action="{{ route('bids.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="player_id">Select Player</label>
                <select name="player_id" id="player_id" class="form-control" required>
                    @foreach($players as $player)
                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="bid_amount">Bid Amount(RWF)</label>
                <input type="number" name="bid_amount" id="bid_amount" class="form-control" required min="0">
            </div>

            <div class="form-group">
                <label>Select Teams to Bid</label>
                <div class="form-check">
                    <!-- Checkbox to select all teams -->
                    <input type="checkbox" id="select_all_teams" class="form-check-input">
                    <label class="form-check-label" for="select_all_teams">Select All Teams</label>
                </div>

                <!-- Multi-select dropdown for selecting specific teams -->
                <select name="buying_team_ids[]" id="buying_team_ids" class="form-control" multiple>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit Bid</button>
        </form>
    </div>

    
                <a href="{{ route('bids.index') }}" class="btn btn-success px-4" style="margin-top:4rem; margin-left:9rem;">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>

    <!-- Script to toggle selecting all teams -->
    <script>
        document.getElementById('select_all_teams').addEventListener('change', function() {
            var teamsSelect = document.getElementById('buying_team_ids');
            if (this.checked) {
                // If "Select All" is checked, select all options
                Array.from(teamsSelect.options).forEach(function(option) {
                    option.selected = true;
                });
            } else {
                // If "Select All" is unchecked, deselect all options
                Array.from(teamsSelect.options).forEach(function(option) {
                    option.selected = false;
                });
            }
        });
    </script>
@endsection
