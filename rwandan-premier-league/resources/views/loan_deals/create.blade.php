<!-- resources/views/loan_deals/create.blade.php -->
@extends('layouts.team_dashboard') <!-- or your layout file -->

@section('content')
    <h2>Create a Loan Deal</h2>

    <form method="POST" action="{{ url('/loan-deals') }}">
        @csrf
        <input type="text" name="player_id" placeholder="Player ID" required>
        
        <!-- Hidden field for team ID (auto-filled with the logged-in team's ID) -->
        <input type="hidden" name="team_id" value="{{ $teamId }}" required>
        
        <input type="date" name="loan_start_date" required>
        <input type="date" name="loan_end_date" required>
        <input type="checkbox" name="has_buy_clause"> Has Buy Clause
        <input type="number" name="buy_clause_fee" placeholder="Buy Clause Fee" min="0">
        
        <button type="submit">Create Loan Deal</button>
    </form>
@endsection

