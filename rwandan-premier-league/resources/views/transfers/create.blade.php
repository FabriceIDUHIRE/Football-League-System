<!-- resources/views/transfers/create.blade.php -->

@extends('layouts.team_dashboard')

@section('content')

<head>
    <!-- jQuery and Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<div class="container">
    <h1>Create New Transfer</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('transfers.store') }}" method="POST">
        @csrf

        <!-- Player Selection -->
        <div class="form-group">
            <label for="player_id">Player</label>
            <select name="player_id" id="player_id" class="form-control">
                @foreach($players as $player)
                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                @endforeach
            </select>
        </div>


        <!-- From Team -->
        <div class="form-group">
            <label for="from_team_id">From Team</label>
            <input type="text" class="form-control" value="{{ auth()->user()->team->name }}" disabled>
            <input type="hidden" name="from_team_id" value="{{ $loggedTeamId }}">
        </div>

        <!-- To Team -->
        <div class="form-group">
            <label for="to_team_id">To Team</label>
            <select name="to_team_id" id="to_team_id" class="form-control">
                @foreach($teams as $team)
                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Transfer Fee -->
        <div class="form-group">
            <label for="transfer_fee">Transfer Fee</label>
            <input type="text" name="transfer_fee" id="transfer_fee" class="form-control" value="{{ old('transfer_fee') }}">
        </div>

        <!-- Contract Start Date -->
        <div class="form-group">
            <label for="contract_start_date">Contract Start Date</label>
            <input type="date" name="contract_start_date" id="contract_start_date" class="form-control" value="{{ old('contract_start_date') }}">
        </div>

        <!-- Contract End Date -->
        <div class="form-group">
            <label for="contract_end_date">Contract End Date</label>
            <input type="date" name="contract_end_date" id="contract_end_date" class="form-control" value="{{ old('contract_end_date') }}">
        </div>

        <!-- Transfer Date -->
        <div class="form-group">
            <label for="transfer_date">Transfer Date</label>
            <input type="date" name="transfer_date" id="transfer_date" class="form-control" value="{{ old('transfer_date') }}" required>
        </div>

        <!-- Contract Duration -->
<div class="form-group">
    <label for="contract_duration">Contract Duration (in years)</label>
    <input type="number" name="contract_duration" id="contract_duration" class="form-control" value="{{ old('contract_duration') }}" required>
</div>

<!-- Status -->
<div class="form-group">
    <label for="status">Status</label>
    <select name="status" id="status" class="form-control" required>
        <option value="Active">Active</option>
        <option value="Inactive">Inactive</option>
        <option value="Pending">Pending</option>
        <option value="Completed">Completed</option>
    </select>
</div>


        <button type="submit" class="btn btn-success mt-3">Save Transfer</button>
    </form>
</div>

@endsection
