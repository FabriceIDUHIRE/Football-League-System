@php
    use Illuminate\Support\Facades\Auth;
@endphp

@extends('layouts.team_dashboard')

@section('content')

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    
</head>

<h2>Loan Deals</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Flash Message -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif



<div class="d-flex justify-content-between mb-4">
    <!-- Button to trigger modal -->
    <button class="btn btn-primary" 
            data-bs-toggle="modal" 
            data-bs-target="#createLoanModal" 
            @disabled(!$isOpen)>
        @if($isOpen)
            Create Loan Deal
        @else
            Transfer Window Closed - Loan Deals Unavailable
        @endif
    </button>

    <!-- Transfers Button (On the right side) -->
    <a href="{{ route('transfers.index') }}">
        <button class="btn btn-tertiary" disabled>Transfers</button>
    </a>
</div>






<!-- Loan Deals Table -->
<table class="table table-bordered mt-4">
    <thead>
        <tr>
            <th>Player Name</th>
            <th>Loan Start Date</th>
            <th>Loan End Date</th>
            <th>Receiving Team</th> 
            <th>Buy Clause</th>
            <th>Buy Clause Fee</th>
            <th>Actions</th> <!-- New Actions Column -->
        </tr>
    </thead>
    <tbody>
    @foreach($loanDealsCreated as $loanDeal)
    <tr>
        <td>{{ $loanDeal->player->name }}</td>
        <td>{{ $loanDeal->loan_start_date }}</td>
        <td>{{ $loanDeal->loan_end_date }}</td>
        <td>{{ $loanDeal->receivingTeam ? $loanDeal->receivingTeam->name : 'N/A' }}</td>
        <td>{{ $loanDeal->has_buy_clause ? 'Yes' : 'No' }}</td>
        <td>{{ $loanDeal->buy_clause_fee }}</td>
        <td>
            <!-- Edit Button triggers Modal -->
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $loanDeal->id }}">
                Edit
            </button>
            <!-- Delete Form -->
            <form action="{{ route('loan-deals.destroy', $loanDeal->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Delete</button>
            </form>
        </td>
    </tr>

    <!-- Modal for editing loan deal -->
    <div class="modal fade" id="editModal{{ $loanDeal->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $loanDeal->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('loan-deals.update', $loanDeal->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $loanDeal->id }}">Edit Loan Deal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Fields -->
                        <div class="mb-3">
                            <label>Loan Start Date</label>
                            <input type="date" name="loan_start_date" value="{{ $loanDeal->loan_start_date }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Loan End Date</label>
                            <input type="date" name="loan_end_date" value="{{ $loanDeal->loan_end_date }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Buy Clause</label>
                            <select name="has_buy_clause" class="form-control" required>
                                <option value="1" {{ $loanDeal->has_buy_clause ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ !$loanDeal->has_buy_clause ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Buy Clause Fee</label>
                            <input type="number" name="buy_clause_fee" value="{{ $loanDeal->buy_clause_fee }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Receiving Team</label>
                            <select name="receiving_team_id" class="form-control">
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}" {{ $loanDeal->receiving_team_id == $team->id ? 'selected' : '' }}>
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

    </tbody>
</table>




@if($loanDealsReceived->isNotEmpty())
<div class="container">
    <div class="row">
        @foreach($loanDealsReceived as $loanDeal)
        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm h-100 card-loan" style="min-height: 350px; transition: all 0.3s ease;">
                <img src="{{ asset('storage/' . $loanDeal->player->image) }}" 
                     class="mx-auto mt-3" 
                     alt="{{ $loanDeal->player->name }}" 
                     style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">

                <div class="card-body p-2">
                    <h6 class="card-title">{{ $loanDeal->player->name }}</h6>
                    <p class="card-text small">Team: {{ $loanDeal->player->team->name }}</p>

                    <button class="btn btn-sm btn-outline-primary toggle-btn" 
                            data-bs-toggle="collapse" 
                            href="#playerDetails{{ $loanDeal->id }}" 
                            role="button" 
                            aria-expanded="false" 
                            aria-controls="playerDetails{{ $loanDeal->id }}"
                            data-target="#playerDetails{{ $loanDeal->id }}"
                            data-button-id="btn{{ $loanDeal->id }}"
                            id="btn{{ $loanDeal->id }}">
                        View
                    </button>
                </div>

                <div class="collapse" id="playerDetails{{ $loanDeal->id }}">
                    <div class="card-body p-2 text-start" style="font-size: 12px;">
                        <hr>
                        <p><strong>Loan Start:</strong> {{ $loanDeal->loan_start_date }}</p>
                        <p><strong>Loan End:</strong> {{ $loanDeal->loan_end_date }}</p>
                        <p><strong>Buy Clause:</strong> {{ $loanDeal->has_buy_clause ? 'Yes' : 'No' }}</p>
                        <p><strong>Fee:</strong> {{ $loanDeal->buy_clause_fee }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- JS to toggle the View/Hide --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.toggle-btn');
        
        buttons.forEach(button => {
            const targetId = button.getAttribute('data-target');
            const target = document.querySelector(targetId);
            
            if (target) {
                target.addEventListener('shown.bs.collapse', () => {
                    button.innerText = 'Hide';
                });
                target.addEventListener('hidden.bs.collapse', () => {
                    button.innerText = 'View';
                });
            }
        });
    });
</script>
@endif











<!-- Modal for creating loan deal -->
<div class="modal fade" id="createLoanModal" tabindex="-1" aria-labelledby="createLoanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLoanModalLabel">Create a Loan Deal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('/loan-deals') }}">
                    @csrf
                    
                    <!-- Player selection dropdown -->
                    <div class="mb-3">
                        <label for="player_id" class="form-label">Player</label>
                        <select class="form-select" name="player_id" id="player_id" required>
                            <option value="" disabled selected>Select Player</option>
                            @foreach($players as $player)
                                <option value="{{ $player->id }}">{{ $player->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Hidden field for team ID (auto-filled with the logged-in team's ID) -->
                    <input type="hidden" name="team_id" value="{{ Auth::user()->team_id }}" required>

                    <div class="mb-3">
                        <label for="loan_start_date" class="form-label">Loan Start Date</label>
                        <input type="date" class="form-control" id="loan_start_date" name="loan_start_date" required>
                    </div>

                    <div class="mb-3">
                        <label for="loan_end_date" class="form-label">Loan End Date</label>
                        <input type="date" class="form-control" id="loan_end_date" name="loan_end_date" required>
                    </div>

                    <!-- Receiving Team Selection -->
                    <div class="mb-3">
                    <label for="receiving_team_id" class="form-label">Receiving Team</label>
                    <select class="form-select" name="receiving_team_id" id="receiving_team_id" required>
                    <option value="" disabled selected>Select Receiving Team</option>
                       @foreach(App\Models\Team::where('id', '!=', Auth::user()->team_id)->get() as $receivingTeam)
                         <option value="{{ $receivingTeam->id }}">{{ $receivingTeam->name }}</option>
                       @endforeach
                    </select>
                    </div>


                    <div class="mb-3">
                        <label for="has_buy_clause" class="form-label">Has Buy Clause</label>
                        <input type="checkbox" name="has_buy_clause" value="1" {{ old('has_buy_clause') ? 'checked' : '' }}>
                    </div>

                    <div class="mb-3">
                        <label for="buy_clause_fee" class="form-label">Buy Clause Fee</label>
                        <input type="number" class="form-control" id="buy_clause_fee" name="buy_clause_fee" placeholder="Buy Clause Fee" min="0">
                    </div>

                    <button type="submit" class="btn btn-primary">Create Loan Deal</button>
                </form>
            </div>
        </div>
    </div>
</div>





@endsection

<!-- Bootstrap JS (required for modal to function) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        // Open the modal when the button is clicked
        $('.btn-primary').click(function() {
            var target = $(this).data('bs-target');
            $(target).modal('show');
        });
    });
</script>

