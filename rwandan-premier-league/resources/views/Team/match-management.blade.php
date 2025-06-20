
@php
    use Illuminate\Support\Facades\Auth;
@endphp
@extends('layouts.team_dashboard')

@section('content')

<head>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

@if(!Auth::check())
    <script>window.location.href = "{{ route('login') }}";</script>
@endif


<div class="container d-flex justify-content-center mt-8"> 
    <div class="col-md-6">
        <h1 class="text-center mb-4" style="margin-bottom: 5rem;">⚽ <strong>Match Management</strong></h1>

        @if($matches->isEmpty())
            <div class="alert alert-warning text-center">
                <strong>No upcoming matches available.</strong>
            </div>
        @else
            <div class="d-flex flex-column align-items-center" style="display: flex; justify-content: center;  gap: 10rem;">
                @foreach($matches as $match)
                    <a href="{{ route('team.details', $match->id) }}" class="text-decoration-none">
                        <div class="card shadow-lg border-0 mb-4 hover-effect" style="width: 100%; max-width: 450px; cursor: pointer;">
                            <div class="card-header bg-primary text-white text-center">
                                <h5 class="mb-0">
                                    @if ($match->home_team_id == $teamId)
                                        <strong>{{ optional($match->homeTeam)->name }}</strong> 
                                        <span class="text-warning">🆚</span> 
                                        {{ optional($match->awayTeam)->name }}
                                    @else
                                        {{ optional($match->homeTeam)->name }} 
                                        <span class="text-warning">🆚</span> 
                                        <strong>{{ optional($match->awayTeam)->name }}</strong>
                                    @endif
                                </h5>
                            </div>
                            <div class="card-body">
                                <p class="mb-2"><strong>📅 Date:</strong> {{ \Carbon\Carbon::parse($match->match_date)->format('d M Y, H:i') }}</p>
                                <p class="mb-2"><strong>🏆 Category:</strong> {{ optional($match->category)->name }}</p>
                                <p class="mb-2"><strong>📍 Venue:</strong> {{ optional($match->stadium)->name }}</p>
                                <p class="mb-0"><strong>⚖ Referee:</strong> {{ optional($match->referee)->name }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>

<style>
    /* Add hover effect for better UX */
    .hover-effect:hover {
        transform: scale(1.03);
        transition: all 0.3s ease-in-out;
    }
</style>

@endsection
