@extends('layouts.team_dashboard')

@section('title', 'Dashboard')

@section('header', 'Dashboard')

@section('content')

<!-- Check for new transfer notifications -->
@if(session('new_transfer_notification'))
    <script>
        alert("{{ session('new_transfer_notification') }}");
    </script>
@endif

<div class="card">
    <p>Here's a quick overview of your team's activities.</p>
</div>

<div class="grid grid-cols-4 gap-4">
    <a href="{{ route('team.matches') }}" class="card">
        <h3>Total Matches Played</h3>
        <p>{{ $matchesCount ?? 0 }}</p>
    </a>
    <a href="{{ route('team.players') }}" class="card">
        <h3>Number of Players</h3>
        <p>{{ $playersCount ?? 0 }}</p>
    </a>
    <a href="{{ route('team.staff') }}" class="card">
        <h3>Staff Members</h3>
        <p>{{ $staffCount ?? 0 }}</p>
    </a>
    <a href="{{ route('team.doctors') }}" class="card">
        <h3>Doctors</h3>
        <p>{{ $doctorsCount ?? 0 }}</p>
    </a>
    <a href="{{ route('team.sponsors') }}" class="card">
        <h3>Active Sponsors</h3>
        <p>{{ $sponsorsCount ?? 0 }}</p>
    </a>

    <a href="{{ route('team.announcements') }}" class="card">
        <h3>Announcements</h3>
        <p>{{ $announcementsCount ?? 0 }}</p>
    </a>
    <a href="{{ route('team.posts') }}" class="card">
        <h3>Number of Posts</h3>
        <p>{{ $postsCount ?? 0 }}</p>
    </a>
    <!-- Add the new "Number of Injuries" card -->
    <a href="{{ route('team.injuries') }}" class="card">
        <h3>Number of Injuries</h3>
        <p>{{ $injuriesCount ?? 0 }}</p>
    </a>
</div>

<div class="card">
    <h3>Quick Links</h3>
    <div class="grid grid-cols-2 gap-4">
        <a href="{{ route('team.match-management') }}" class="quick-link">Manage Matches</a>
        <a href="{{ route('team.player-management') }}" class="quick-link">Player Roster</a>
        <a href="{{ route('team.sponsorship') }}" class="quick-link">Sponsors</a>
    </div>
</div>

@endsection
