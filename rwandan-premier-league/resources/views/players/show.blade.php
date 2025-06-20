@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Player Details</h3>

    <div class="card">
        <div class="row g-0">
            <!-- Player Image -->
            <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
                @if($player->image)
                    <img src="{{ asset('storage/' . $player->image) }}" alt="{{ $player->name }}" class="img-fluid rounded" style="max-width: 100%; border-radius:100%;">
                @else
                    <p>No image available</p>
                @endif
            </div>

            <!-- Player Details -->
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title">{{ $player->name }}</h4>
                    <p><strong>Team:</strong> {{ $player->team->name }}</p>
                    <p><strong>Position:</strong> {{ $player->position }}</p>
                    <p><strong>Date of Birth:</strong> {{ $player->dob }}</p>
                    <p><strong>Nationality:</strong> {{ $player->nationality }}</p>
                    <p><strong>Jersey Number:</strong> {{ $player->jersey_number }}</p>

                    <a href="{{ route('admin.players') }}" class="btn btn-secondary mt-3">Back to Players List</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Player Statistics -->
    <div class="row mt-4">
        <!-- Goals & Assists -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-futbol text-success"></i> Performance</h5>
                    <p><strong>Goals Scored:</strong> {{ $goals }}</p>
                </div>
            </div>
        </div>

        <!-- Cards Received -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-exclamation-triangle text-danger"></i> Disciplinary</h5>
                    <p><strong>Yellow Cards:</strong> {{ $yellowCards }}</p>
                    <p><strong>Red Cards:</strong> {{ $redCards }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Injuries -->
    <div class="card mt-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-user-injured text-warning"></i> Injury History</h5>
            @if($injuries->isEmpty())
                <p class="text-muted">No recorded injuries.</p>
            @else
                <ul class="list-group">
                    @foreach($injuries as $injury)
                        <li class="list-group-item">
                            <strong>{{ $injury->injury }}</strong> - 
                            <small>Occurred at minute {{ $injury->minute }}</small>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

</div>
@endsection
