@extends('layouts.app')

@section('content')

<head>
    
</head>
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <h1>Transfer Window</h1>
    <p>Status: {{ $window ? ($window->is_open ? 'Open' : 'Closed') : 'No window available' }}</p>

    @if($window && $window->is_open)
    <form action="{{ route('transfers.close') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Close Transfer Window</button>
    </form>
    @elseif($window)
    <form action="{{ route('transfers.open') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Open Transfer Window</button>
    </form>
    @endif

    <h3 style="margin-top:5rem;">Transfers Made</h3>
    @if(!$transfers->isEmpty())
    <table class="table" style="margin-top:2rem;">
    <thead>
        <tr>
            <th>Player</th>
            <th>From Team</th>
            <th>To Team</th>
            <th>Transfer Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transfers as $transfer)
            <tr>
                <td>{{ $transfer->player ? $transfer->player->name : 'N/A' }}</td>
                <td>{{ $transfer->fromTeam ? $transfer->fromTeam->name : 'N/A' }}</td>
                <td>{{ $transfer->toTeam ? $transfer->toTeam->name : 'N/A' }}</td>
                <td>{{ $transfer->transfer_date ? $transfer->transfer_date->format('Y-m-d') : 'N/A' }}</td>
                <td>
                    <!-- Debugging the raw status -->
                    {{ $transfer->status }} <!-- This will display the raw status value from the database -->
                    
                    <!-- Display transfer status with color-coded badges -->
                    @if($transfer->status == 'pending')
                        <span class="badge badge-warning">Pending</span>
                    @elseif($transfer->status == 'approved')
                        <span class="badge badge-success">Approved</span>
                    @elseif($transfer->status == 'rejected')
                        <span class="badge badge-danger">Rejected</span>
                    @else
                        <span class="badge badge-secondary">N/A</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

        
    @endif
</div>
@endsection
