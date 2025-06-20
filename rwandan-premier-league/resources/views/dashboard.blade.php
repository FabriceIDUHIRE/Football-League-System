@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Rwandan Premier League Dashboard</h1>

    <!-- Dashboard Links -->
    <div class="row">
        <!-- Teams Section -->
        <div class="col-md-3">
            <h3>Teams</h3>
            <p><a href="{{ route('teams.index') }}">View All Teams</a></p>
            <p><a href="{{ route('teams.create') }}">Register New Team</a></p>
        </div>

        <!-- Fixtures Section -->
        <div class="col-md-3">
            <h3>Fixtures</h3>
            <p><a href="{{ route('fixtures.index') }}">View All Fixtures</a></p>
            <p><a href="{{ route('fixtures.create') }}">Create Fixture</a></p>
        </div>

        <!-- Standings Section -->
        <div class="col-md-3">
            <h3>Standings</h3>
            <p><a href="{{ route('standings.index') }}">View League Standings</a></p>
        </div>

        <!-- Announcements Section -->
        <div class="col-md-3">
            <h3>Announcements</h3>
            <p><a href="{{ route('announcements.index') }}">View Announcements</a></p>
            <p><a href="{{ route('announcements.create') }}">Add Announcement</a></p>
        </div>
    </div>
</div>
@endsection
