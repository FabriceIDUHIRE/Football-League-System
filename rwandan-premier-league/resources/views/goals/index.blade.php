@extends('layouts.app')

@section('content')

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<div class="container">

        <!-- DEBUG INFO (You can remove this later) -->
        <p><strong>Time:</strong> {{ now()->format('Y-m-d H:i:s') }}</p>
        <p><strong>Matches Date:</strong></p>
        <ul>
            @foreach($matches as $m)
                <li>
                    {{ $m->homeTeam->name }} vs {{ $m->awayTeam->name }} -
                    {{ \Carbon\Carbon::parse($m->match_date)->format('Y-m-d H:i:s') }}
                </li>
            @endforeach
        </ul>

    <h1 style="margin-top:2rem;">Manage Your Team's Events</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

        <!-- Display errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#goalModal">
    Add New Event
</button>

    <!-- Events Table -->
    <table class="table" style="margin-top:2rem;">
    <thead>
        <tr>
            <th>Player</th>
            <th>Minute</th>
            <th>Card</th>
            <th>Injury</th>
            <th>Goal Scored</th>
            <th>Team</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($goals as $goal)
            <tr>
                <td>{{ $goal->player->name ?? 'Unknown Player' }}</td>
                <td>{{ $goal->minute }}</td>
                <td>{{ $goal->card ?? 'N/A' }}</td>
                <td>{{ $goal->injury ?? 'N/A' }}</td>
                <td>{{ $goal->goal_scored }}</td>
                <td>
                    @if($goal->team_type == 'home')
                        {{ $goal->match->homeTeam->name ?? 'N/A' }}
                    @else
                        {{ $goal->match->awayTeam->name ?? 'N/A' }}
                    @endif
                </td>
                <td>
                    <form action="{{ route('goals.destroy', $goal->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
                    </form>

                    <button type="button" class="btn btn-warning btn-sm">
                        <a href="{{ route('goals.edit', ['goal' => $goal->id]) }}" class="text-white">
                            Edit
                        </a>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>







</div>

<!-- Event Modal -->
<div class="modal fade" id="goalModal" tabindex="-1" aria-labelledby="goalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="goalModalLabel">Add New Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('goals.store') }}" method="POST">
                    @csrf

<!-- Match Selection (Today Only) -->
<div class="mb-3">
    <label for="match_id" class="form-label">Today's Matches</label>
    <select name="match_id" id="match_id" class="form-select" required>
        <option value="">Select Match</option>
        @forelse($matches as $match)
            <option value="{{ $match->id }}" 
                    data-home-team="{{ $match->home_team_id }}" 
                    data-away-team="{{ $match->away_team_id }}">
                {{ $match->homeTeam->name }} vs {{ $match->awayTeam->name }} 
                ({{ \Carbon\Carbon::parse($match->match_date)->format('H:i') }})
            </option>
        @empty
            <option value="">No matches scheduled for today.</option>
        @endforelse
    </select>
</div>


                    <!-- Team Type Selection -->
                    <div class="mb-3">
                        <label for="team_type" class="form-label">Team Type</label>
                        <select name="team_type" id="team_type" class="form-select" required>
                            <option  style="color:dark;">-- select Team --</option>
                            <option value="home">Home Team</option>
                            <option value="away">Away Team</option>
                        </select>
                    </div>

                    <!-- Event Type Selection -->
                    <div class="mb-3">
                        <label for="event_type" class="form-label">Event Type</label>
                        <select name="event_type" id="event_type" class="form-select" required>
                            <option value="goal">Goal</option>
                            <option value="card">Card</option>
                            <option value="injury">Injury</option>
                        </select>
                    </div>

                    <!-- Player Selection (dynamically populated) -->
                    <div class="mb-3">
                        <label for="player_id" class="form-label">Player</label>
                        <select name="player_id" id="player_id" class="form-select" required>
                            <option value="">Select Player</option>
                        </select>
                    </div>

                    <!-- Common Fields (Minute) -->
                    <div class="mb-3">
                        <label for="minute" class="form-label">Minute</label>
                        <input type="number" class="form-control" id="minute" name="minute" required>
                    </div>

                    <!-- Goal-related fields -->
                    <div id="goalFields" style="display:none;">
                        <div class="mb-3">
                            <label for="goal_scored" class="form-label">Goals Scored</label>
                            <input type="number" class="form-control" id="goal_scored" name="goal_scored" value="1" required>
                        </div>
                    </div>

                    <!-- Card-related fields -->
                    <div id="cardFields" style="display:none;">
                        <div class="mb-3">
                            <label for="card" class="form-label">Card (if any)</label>
                            <select name="card" id="card" class="form-select">
                                <option value="yellow">Yellow</option>
                                <option value="red">Red</option>
                                <option value="">No Card</option>
                            </select>
                        </div>
                    </div>

                    <!-- Injury-related fields -->
                    <div id="injuryFields" style="display:none;">
                        <div class="mb-3">
                            <label for="injury" class="form-label">Injury (if any)</label>
                            <input type="text" class="form-control" id="injury" name="injury">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Event</button>
                </form>
            </div>
        </div>
    </div>
</div>





<script>
    $(document).ready(function() {
        // Handle team selection and load players dynamically
        $('#team_id').on('change', function() {
            var teamId = $(this).val();
            if (teamId) {
                $.ajax({
                    url: '/get-players/' + teamId,  // Assuming you have a route to fetch players
                    type: 'GET',
                    success: function(data) {
                        $('#player_id').empty();
                        $('#player_id').append('<option value="">Select Player</option>');
                        $.each(data.players, function(index, player) {
                            $('#player_id').append('<option value="' + player.id + '">' + player.name + '</option>');
                        });
                    }
                });
            } else {
                $('#player_id').empty();
                $('#player_id').append('<option value="">Select Player</option>');
            }
        });

        // Event type change handling to toggle additional fields
        $('#event_type').on('change', function() {
            var eventType = $(this).val();
            toggleEventFields(eventType);
        });

        function toggleEventFields(eventType) {
            // Hide all additional fields
            $('#goalFields').hide();
            $('#cardFields').hide();
            $('#injuryFields').hide();

            // Show fields based on event type
            if (eventType === 'goal') {
                $('#goalFields').show();
            } else if (eventType === 'card') {
                $('#cardFields').show();
            } else if (eventType === 'injury') {
                $('#injuryFields').show();
            }
        }

        // Handle edit event modal and pre-fill data
        $('#editEventModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var eventData = button.data('event'); // Extract event data from data-* attributes
            var modal = $(this);

            modal.find('#edit_team_id').val(eventData.team_id);
            modal.find('#edit_player_id').val(eventData.player_id);
            modal.find('#edit_event_type').val(eventData.event_type);
            modal.find('#edit_minute').val(eventData.minute);
            
            // Show the appropriate fields for the selected event type
            toggleEventFields(eventData.event_type);

            if (eventData.event_type === 'goal') {
                modal.find('#edit_goal_scored').val(eventData.goal_scored);
            } else if (eventData.event_type === 'card') {
                modal.find('#edit_card').val(eventData.card);
            } else if (eventData.event_type === 'injury') {
                modal.find('#edit_injury').val(eventData.injury);
            }
        });
    });



    document.getElementById('match_id').addEventListener('change', function() {
        const matchId = this.value;
        const teamType = document.getElementById('team_type').value;
        const selectedMatch = this.options[this.selectedIndex];
        const teamId = teamType === 'home' ? selectedMatch.dataset.homeTeam : selectedMatch.dataset.awayTeam;

        // Clear previous player options
        const playerSelect = document.getElementById('player_id');
        playerSelect.innerHTML = '<option value="">Select Player</option>';

        // Fetch players based on the selected team
        fetch(`/get-players/${teamId}`)
            .then(response => response.json())
            .then(players => {
                players.forEach(player => {
                    const option = document.createElement('option');
                    option.value = player.id;
                    option.textContent = player.name;
                    playerSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching players:', error));
    });


    $(document).ready(function() {
    // When Match is selected
    $('#match_id').on('change', function() {
        loadPlayers();
    });

    // When Team Type is selected
    $('#team_type').on('change', function() {
        loadPlayers();
    });

    // Function to load players dynamically
    function loadPlayers() {
        var matchId = $('#match_id').val();
        var teamType = $('#team_type').val();
        
        if (matchId && teamType) {
            var teamId = (teamType === 'home') 
                ? $('#match_id option:selected').data('home-team') 
                : $('#match_id option:selected').data('away-team');
            
            // Make the AJAX request to get players for the selected team
            $.ajax({
                url: '/get-players/' + teamId,  // Assuming this route fetches players by team
                type: 'GET',
                success: function(data) {
                    $('#player_id').empty();
                    $('#player_id').append('<option value="">Select Player</option>');
                    $.each(data.players, function(index, player) {
                        $('#player_id').append('<option value="' + player.id + '">' + player.name + '</option>');
                    });
                }
            });
        } else {
            // Clear the player dropdown if no team is selected
            $('#player_id').empty();
            $('#player_id').append('<option value="">Select Player</option>');
        }
    }



    // Similar logic for team_type dropdown to update player selection
    $('#event_type').on('change', function() {
        var eventType = $(this).val();
        toggleEventFields(eventType);
    });



    function toggleEventFields(eventType) {
        // Hide all additional fields
        $('#goalFields').hide();
        $('#cardFields').hide();
        $('#injuryFields').hide();

        // Show fields based on event type
        if (eventType === 'goal') {
            $('#goalFields').show();
        } else if (eventType === 'card') {
            $('#cardFields').show();
        } else if (eventType === 'injury') {
            $('#injuryFields').show();
        }
    }

    // Initialize player load when page loads (if match and team are selected)
    loadPlayers();
});



// AJAX to fetch players based on selected team
function fetchPlayersByTeam(teamId) {
    $.ajax({
        url: '/get-players/' + teamId,  // Assuming a route exists to fetch players by team
        type: 'GET',
        success: function(data) {
            $('#player_id').empty();
            $('#player_id').append('<option value="">Select Player</option>');
            $.each(data.players, function(index, player) {
                $('#player_id').append('<option value="' + player.id + '">' + player.name + '</option>');
            });
        },
        error: function() {
            console.error('Error fetching players.');
        }
    });
}

// AJAX to fetch players based on selected match and team type
function fetchPlayersByMatchAndTeam(matchId, teamType) {
    $.ajax({
        url: '/get-players/' + matchId + '/' + teamType,  // Adjusted URL for match and team type
        type: 'GET',
        success: function(data) {
            $('#player_id').empty();
            $('#player_id').append('<option value="">Select Player</option>');
            $.each(data.players, function(index, player) {
                $('#player_id').append('<option value="' + player.id + '">' + player.name + '</option>');
            });
        },
        error: function() {
            console.error('Error fetching players.');
        }
    });
}



</script>

@endsection
