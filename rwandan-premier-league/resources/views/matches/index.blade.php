@extends('layouts.app')

@section('content')
<div class="container">
    <h3>All Matches</h3>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
    @endif
    
    <!-- Button to trigger the modal for registering a new match -->
    <button class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#addMatchModal" style="margin-bottom:4rem;">
        Register New Match
    </button>

    <!-- Filter Buttons
    <div class="btn-group mb-4">
        <button class="btn btn-primary btn-category" data-category-id="1">All Matches</button>
        <button class="btn btn-secondary btn-category" data-category-id="2">Super Cup</button>
        <button class="btn btn-success btn-category" data-category-id="3">CAF Champions League</button>
        <button class="btn btn-warning btn-category" data-category-id="4">CHAN Matches</button>
        <button class="btn btn-info btn-category" data-category-id="5">Friendly Matches</button> -->
    </div>

    <!-- Matches Cards Section -->
    <div class="row justify-content-center" id="matches-cards" style="margin-top:4rem;">
    @foreach($matches as $match)
    <div class="col-md-6 col-lg-5 mb-4">
        <a href="{{ route('matches.show', $match->id) }}" class="text-decoration-none" style="color: inherit;">
            <div class="card shadow-lg" style="width: 100%; max-width: 500px; margin: auto;">
                <div class="card-body text-center">
                    <div class="d-flex justify-content-around align-items-center mb-3">
                        <!-- Home Team Logo -->
                        <div>
                            <img src="{{ asset('storage/' . ($match->homeTeam->logo ?? 'logos/default.png')) }}" 
                                 alt="{{ $match->homeTeam->name ?? 'Default' }}" 
                                 class="rounded-circle" style="width: 60px; height: 60px;">
                            <p class="mt-2">{{ $match->homeTeam->name ?? 'No Home Team' }}</p>
                        </div>
                        
                        <strong>VS</strong>
                        
                        <!-- Away Team Logo -->
                        <div>
                            <img src="{{ asset('storage/' . ($match->awayTeam->logo ?? 'logos/default.png')) }}" 
                                 alt="{{ $match->awayTeam->name ?? 'Default' }}" 
                                 class="rounded-circle" style="width: 60px; height: 60px;">
                            <p class="mt-2">{{ $match->awayTeam->name ?? 'No Away Team' }}</p>
                        </div>
                    </div>
                    
                    <!-- Match Details -->
                    <p class="mb-1"><strong>Date:</strong> {{ \Carbon\Carbon::parse($match->match_date)->format('M d, Y H:i') }}</p>
                    <p><strong>Referee:</strong> {{ $match->referee->name ?? 'No Referee' }}</p>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>


    <!-- Modal for Registering New Match -->
    <div class="modal fade" id="addMatchModal" tabindex="-1" aria-labelledby="addMatchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMatchModalLabel">Register New Match</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('matches.store') }}" method="POST">
                        @csrf
                        <!-- Match Date -->
                        <div class="mb-3">
                            <label for="match_date" class="form-label">Match Date</label>
                            <input type="datetime-local" class="form-control" id="match_date" name="match_date" required>
                        </div>
                        
                        <!-- Stadium -->
                        <div class="mb-3">
                            <label for="stadium_id" class="form-label">Stadium</label>
                            <select class="form-control" id="stadium_id" name="stadium_id" required>
                                @foreach($stadiums as $stadium)
                                    <option value="{{ $stadium->id }}">{{ $stadium->name }}</option>
                                @endforeach
                            </select>
                        </div>

<!-- Main Referee -->
<div class="mb-3">
    <label for="referee_id" class="form-label">Main Referee</label>
    <select name="referee_id" class="form-control" required>
        <option value="">Select Main Referee</option>
        @foreach($mainReferees as $referee)
            <option value="{{ $referee->id }}">{{ $referee->name }}</option>
        @endforeach
    </select>
</div>

<!-- Assistant Referee 1 -->
<div class="mb-3">
    <label class="form-label">Assistant Referee 1</label>
    <select name="assistant_referee1_id" class="form-control select2" required>
        <option value="">Select Assistant Referee 1</option>
        @foreach($assistantReferees as $referee)
            <option value="{{ $referee->id }}">{{ $referee->name }}</option>
        @endforeach
    </select>
</div>

<!-- Assistant Referee 2 -->
<div class="mb-3">
    <label class="form-label">Assistant Referee 2</label>
    <select name="assistant_referee2_id" class="form-control select2" required>
        <option value="">Select Assistant Referee 2</option>
        @foreach($assistantReferees as $referee)
            <option value="{{ $referee->id }}">{{ $referee->name }}</option>
        @endforeach
    </select>
</div>


<!-- Fourth Referee -->
<div class="mb-3">
    <label for="fourth_referee_id" class="form-label">Fourth Referee</label>
    <select name="fourth_referee_id" class="form-control">
        <option value="">Select Fourth Referee</option>
        @foreach($fourthReferees as $referee)
            <option value="{{ $referee->id }}">{{ $referee->name }}</option>
        @endforeach
    </select>
</div>

<!-- Match Commissioner -->
<div class="mb-3">
    <label for="match_commissioner_id" class="form-label">Match Commissioner</label>
    <select name="match_commissioner_id" class="form-control" required>
        <option value="">Select Match Commissioner</option>
        @foreach($matchCommissioners as $commissioner)
            <option value="{{ $commissioner->id }}">{{ $commissioner->name }}</option>
        @endforeach
    </select>
</div>


                        <!-- Home Team -->
                        <div class="mb-3">
                            <label for="home_team_id" class="form-label">Home Team</label>
                            <select class="form-control" id="home_team_id" name="home_team_id" required>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Away Team -->
                        <div class="mb-3">
                            <label for="away_team_id" class="form-label">Away Team</label>
                            <select class="form-control" id="away_team_id" name="away_team_id" required>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Match Category -->
                        <div class="mb-3">
                            <label for="match_category_id" class="form-label">Match Category</label>
                            <select name="match_category_id" class="form-control" id="match_category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Register Match</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

<!-- JavaScript for AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        function filterTeams() {
            let homeTeam = $("#home_team_id").val();
            let awayTeam = $("#away_team_id").val();

            $("#away_team_id option").show();
            $("#home_team_id option").show();

            if (homeTeam) {
                $("#away_team_id option[value='" + homeTeam + "']").hide();
            }
            if (awayTeam) {
                $("#home_team_id option[value='" + awayTeam + "']").hide();
            }
        }

        // Run filter function when the dropdowns change
        $("#home_team_id, #away_team_id").on("change", function () {
            filterTeams();
        });

        // Initialize filtering when the modal is opened
        $("#addMatchModal").on("shown.bs.modal", function () {
            filterTeams();
        });
    });


    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select an Assistant Referee",
            allowClear: true
        });
    });
</script>

<!-- Include Select2 (for better UI) -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>





