@extends('layouts.team_dashboard')

@section('content')

<head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </head>



<div class="container">
    <h1>Player Transfers</h1>

  

    <div class="d-flex justify-content-between mt-4">
        <div>
            @if($isOpen)
                <a href="{{ route('transfers.create') }}" class="btn btn-primary">Add New Transfer</a>
            @else
                <button class="btn btn-secondary" disabled>Transfer Window Closed</button>
            @endif
        </div>
        <div>
            <!-- Loan Deals Button on the right -->
            <a href="{{ route('loan-deals.index') }}">
                <button class="btn btn-tertiary" disabled>Loan Deals</button>
            </a>
        </div>
    </div>

    @if($transfers->isEmpty())
        <p>No Transfer Made so far.</p>
    @else
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Player</th>
                    <th>From Team</th>
                    <th>To Team</th>
                    <th>Transfer Fee</th>
                    <th>Transfer Date</th>
                    <th>Contract Duration</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transfers as $transfer)
                    <tr>
                        <td>{{ $transfer->player->name }}</td>
                        <td>{{ $transfer->fromTeam->name }}</td>
                        <td>{{ $transfer->toTeam->name }}</td>
                        <td>{{ number_format($transfer->transfer_fee, 2) }} Rwf</td>
                        <td>{{ $transfer->transfer_date }}</td>
                        <td>{{ $transfer->contract_duration }}</td>
                        <td>
                            @if ($transfer->status == 'pending' && auth()->user()->team_id == $transfer->to_team_id)
                                <form action="{{ route('transfers.approve', $transfer->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                </form>
    
                                <form action="{{ route('transfers.reject', $transfer->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                </form>
                            @else
                                {{ ucfirst($transfer->status) }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
