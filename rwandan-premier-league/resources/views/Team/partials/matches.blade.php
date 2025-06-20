<!-- resources/views/Team/partials/matches.blade.php -->
@extends('layouts.team_dashboard')

@section('title', 'Match Management')

@section('header', 'Match Management')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold mb-4">Upcoming Matches</h3>
        @if($matches->isEmpty())
            <p>No upcoming matches scheduled.</p>
        @else
            <ul>
                @foreach($matches as $match)
                    <li class="mb-2">
                        <strong>{{ $match->homeTeam->name }}</strong> vs <strong>{{ $match->awayTeam->name }}</strong>
                        on {{ $match->date->format('F j, Y, g:i a') }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
