<!-- resources/views/sponsors/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Sponsor Details</h3>

    <div class="mb-3">
        <strong>Sponsor Name:</strong> {{ $sponsor->sponsor_name }}
    </div>
    <div class="mb-3">
        <strong>League Sponsor:</strong> {{ $sponsor->league_sponsor ? 'Yes' : 'No' }}
    </div>
    <div class="mb-3">
        <strong>Contract Start Date:</strong> {{ $sponsor->contract_start_date }}
    </div>
    <div class="mb-3">
        <strong>Contract End Date:</strong> {{ $sponsor->contract_end_date }}
    </div>
    <div class="mb-3">
        <strong>Amount:</strong> ${{ number_format($sponsor->amount, 2) }}
    </div>

    <div class="mb-3">
        <strong>Logo:</strong><br>
        @if($sponsor->logo)
        <img src="{{ asset($sponsor->logo) }}" alt="Sponsor Logo" class="img-fluid" style="width: 150px;">
        @else
            <p>No logo uploaded</p>
        @endif
    </div>

    <a href="{{ route('sponsors.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
