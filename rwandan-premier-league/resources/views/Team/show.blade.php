@extends('layouts.team_dashboard')

@section('title', 'Announcement Details')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $announcement->title }}</h5>
            <p class="card-text">{{ $announcement->content }}</p>
            <p class="text-muted small">Published on: {{ $announcement->created_at->format('d M Y') }}</p>

            
        </div>
        <!-- Back Button -->
        <a href="{{ url()->previous() }}" class="btn btn-primary mt-3" style="margin-top:10rem;">Go Back</a>
    </div>
@endsection
