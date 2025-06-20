@extends('layouts.team_dashboard')

@section('content')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Feedback Details for Team: {{ $feedback->team->name }}</h1>

    <!-- Feedback Card -->
    <div class="card shadow-lg border-0 rounded-3 bg-white mb-4">
        <div class="card-body p-6">
            <h5 class="card-title text-dark font-semibold">{{ $feedback->name }}</h5>
            <p class="card-text text-muted small">{{ $feedback->email }}</p>
            <p class="card-text text-gray-600 mt-4">{{ $feedback->message }}</p>
            <p class="card-footer text-muted small mt-4">Submitted on {{ $feedback->created_at->format('d M Y, H:i') }}</p>
        </div>
    </div>

    <!-- Back Button Section -->
    <div class="d-flex justify-content-between mt-4">
        <!-- Back Button -->
        <a href="{{ route('team.feedback') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Back to Feedback List
        </a>

        <!-- Optional: Close button (if you prefer an alternative navigation method) -->
        <a href="{{ route('team.dashboard') }}" class="btn btn-outline-secondary">
            <i class="fas fa-home"></i> Dashboard
        </a>
    </div>
</div>

@endsection
