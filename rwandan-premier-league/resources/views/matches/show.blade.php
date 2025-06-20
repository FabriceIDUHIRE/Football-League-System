@extends('layouts.app') <!-- Or your parent layout file -->

@section('content')
<div class="container">
    <h3>Match Details</h3>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card shadow-lg">
        <div class="card-body text-center">
            <div class="d-flex justify-content-around align-items-center mb-3">
                <!-- Home Team Logo -->
                <div>
                    <img src="{{ asset('storage/' . ($match->homeTeam->logo ?? 'logos/default.png')) }}" 
                         alt="{{ $match->homeTeam->name ?? 'Default' }}" 
                         class="rounded-circle" style="width: 80px; height: 80px;">
                    <p class="mt-2">{{ $match->homeTeam->name ?? 'No Home Team' }}</p>
                </div>
                
                <strong>VS</strong>
                
                <!-- Away Team Logo -->
                <div>
                    <img src="{{ asset('storage/' . ($match->awayTeam->logo ?? 'logos/default.png')) }}" 
                         alt="{{ $match->awayTeam->name ?? 'Default' }}" 
                         class="rounded-circle" style="width: 80px; height: 80px;">
                    <p class="mt-2">{{ $match->awayTeam->name ?? 'No Away Team' }}</p>
                </div>
            </div>
            
            <!-- Match Details -->
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($match->match_date)->format('M d, Y H:i') }}</p>
            <p><strong>Stadium:</strong> {{ $match->stadium->name ?? 'No Stadium' }}</p>
            <p><strong>Referee:</strong> {{ $match->referee->name ?? 'No Referee' }}</p>
            <p><strong>Category:</strong> {{ $match->category->name ?? 'No Category' }}</p>

            <!-- Action Buttons -->
            <div class="mt-4 d-flex justify-content-end gap-3">
                <!-- Edit Button -->
                <a href="{{ route('matches.edit', $match->id) }}" class="btn btn-primary">
                    Edit
                </a>

                <!-- Delete Button -->
                <form action="{{ route('matches.destroy', $match->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this match?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Delete
                    </button>
                </form>
            </div>

        </div>        
    </div>
</div>
@endsection
