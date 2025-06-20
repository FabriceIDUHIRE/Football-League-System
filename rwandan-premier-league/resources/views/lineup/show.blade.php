@extends('layouts.team_dashboard')

@if($lineup)
    <div class="card mt-4">
        <div class="card-header">
            Lineup for Match: {{ $lineup->match->homeTeam->name }} vs {{ $lineup->match->awayTeam->name }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Formation: {{ $lineup->formation }}</h5>

            <h6>Starting 11:</h6>
            <ul>
                @foreach($lineup->players->where('pivot.position_type', 'Starting') as $player)
                    <li>{{ $player->name }} - {{ $player->position }}</li>
                @endforeach
            </ul>

            <h6>Substitutes:</h6>
            <ul>
                @foreach($lineup->players->where('pivot.position_type', 'Substitute') as $substitute)
                    <li>{{ $substitute->name }} - {{ $substitute->position }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@endsection
