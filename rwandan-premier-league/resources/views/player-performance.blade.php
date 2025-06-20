@extends('layouts.team_dashboard')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Player Performance</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered shadow-sm">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Goals</th>
                <th>Assists</th>
                <th>Clean Sheets</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($players as $player)
            <tr>
                <td>{{ $player->name }}</td>
                <form action="{{ route('player-performance.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="player_id" value="{{ $player->id }}">
                    <td><input type="number" name="goals" value="{{ $player->performance->goals ?? 0 }}" class="form-control" min="0"></td>
                    <td><input type="number" name="assists" value="{{ $player->performance->assists ?? 0 }}" class="form-control" min="0"></td>
                    <td><input type="number" name="clean_sheets" value="{{ $player->performance->clean_sheets ?? 0 }}" class="form-control" min="0"></td>
                    <td><button type="submit" class="btn btn-primary btn-sm">Update</button></td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
