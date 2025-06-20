<!-- resources/views/financials/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Financial Records</h3>
    <div class="row">
        @foreach($financials as $financial)
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title">Transaction: {{ $financial->transaction_type }}</h5>
                        <p class="card-text">
                            <strong>Amount:</strong> {{ $financial->amount }} <br>
                            <strong>Date:</strong> {{ \Carbon\Carbon::parse($financial->transaction_date)->format('M d, Y') }} <br>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
