@php use Illuminate\Support\Str; @endphp

@extends('layouts.team_dashboard')

@section('content')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Feedback for {{ $team->name }}</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    @if($feedbacks->isEmpty())
        <p class="text-lg text-gray-600">No feedback shared yet for your team.</p>
    @else
        <h2 class="text-xl font-bold text-gray-800 mt-6 mb-4">Recent Feedback</h2>
        <div class="row g-4">
            @foreach($feedbacks as $feedback)
                <!-- Feedback Card wrapped in anchor tag for clicking -->
                <div class="col-md-4">
                    <a href="{{ route('feedback.show', $feedback->id) }}" class="text-decoration-none">
                        <div class="card shadow-sm border-0 rounded-3 bg-white hover-shadow-lg transition-shadow duration-300">
                            <div class="card-body p-4">
                                <h5 class="card-title text-dark font-semibold">{{ $feedback->name }}</h5>
                                <p class="card-text text-muted small">{{ $feedback->email }}</p>
                                <p class="card-text text-gray-600">{{ Str::limit($feedback->message, 100) }}</p>
                                <p class="card-footer text-muted small mt-3">Submitted on {{ $feedback->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection
