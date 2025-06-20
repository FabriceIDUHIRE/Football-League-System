@php
    use Illuminate\Support\Facades\Auth;
@endphp

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0">{{ $match->homeTeam->name }} <span class="fw-bold">vs</span> {{ $match->awayTeam->name }}</h3>
        </div>

        
        <div class="card-body">
            <!-- Match Information -->
            <div class="row">
                <div class="col-md-6 text-center">
                    <img src="{{ asset('storage/' . ($match->homeTeam->logo ?? 'logos/default.png')) }}" 
                         alt="{{ $match->homeTeam->name }}" class="rounded-circle" 
                         style="width: 100px; height: 100px;">
                    <h5 class="mt-2">{{ $match->homeTeam->name }}</h5>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('storage/' . ($match->awayTeam->logo ?? 'logos/default.png')) }}" 
                         alt="{{ $match->awayTeam->name }}" class="rounded-circle" 
                         style="width: 100px; height: 100px;">
                    <h5 class="mt-2">{{ $match->awayTeam->name }}</h5>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>📅 Match Date:</strong> {{ \Carbon\Carbon::parse($match->match_date)->format('M d, Y H:i') }}</p>
                    <p><strong>🏆 Category:</strong> {{ $match->matchCategory->name }}</p>
                    <p><strong>🏟 Venue:</strong> {{ $match->stadium->name }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="mt-3">Match Officials</h5>
                    <p><strong>⚖ Referee:</strong> {{ $match->referee->name }}</p>
                    <p><strong>🛑 Assistant Referee 1:</strong> {{ $match->assistantReferees[0]->name ?? 'Not Assigned' }}</p>
                    <p><strong>🛑 Assistant Referee 2:</strong> {{ $match->assistantReferees[1]->name ?? 'Not Assigned' }}</p>
                    <p><strong>👨‍⚖ Fourth Referee:</strong> {{ $match->fourthReferee->name ?? 'Not Assigned' }}</p>
                    <p><strong>📝 Match Commissioner:</strong> {{ $match->matchCommissioner->name }}</p>
                </div>
            </div>

            <hr>

            <!-- Action Buttons -->
            <div class="text-center mt-4">
                
                    <a href="{{ route('match.edit', $match->id) }}" class="btn btn-warning px-4">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('matches.destroy', $match->id) }}" method="POST" class="d-inline" 
                            onsubmit="return confirm('Are you sure you want to delete this match?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger px-4">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </form>

               

                <a href="{{ route('matches.index') }}" class="btn btn-dark px-4">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
