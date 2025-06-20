@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Players List</h3>

    <!-- Team Filter Form -->
    <form method="GET" action="{{ route('admin.players') }}" class="d-flex justify-content-between align-items-center">
        <div class="form-group mb-2 d-flex align-items-center">
            <label for="team_id" class="mr-2 mb-7">Filter by Team:</label>
            <select name="team_id" id="team_id" class="form-control">
                <option value="">All Teams</option>
                @foreach($teams as $team)
                    <option value="{{ $team->id }}" {{ $team->id == $selectedTeam ? 'selected' : '' }}>
                        {{ $team->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary ml-3">Filter</button>
    </form>

    <!-- Players Table -->
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Team</th>
                <th>Position</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($players as $player)
            <tr>
                <td>
                    <img src="{{ asset('storage/' . $player->image) }}" alt="{{ $player->name }}" width="50" height="50" class="rounded-circle">
                </td>
                <td>{{ $player->name }}</td>
                <td>{{ $player->team->name }}</td> 
                <td>{{ $player->position }}</td>
                <td>
                    <a href="{{ route('players.show', $player->id) }}" class="btn btn-info">View</a>
                    <!--<form action="{{ route('players.destroy', $player->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    </form>-->
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
