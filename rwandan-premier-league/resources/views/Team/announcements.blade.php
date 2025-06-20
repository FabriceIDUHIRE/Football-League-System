@php use Illuminate\Support\Str; @endphp

@extends('layouts.team_dashboard')

@section('title', 'Announcements')

@section('header', 'Announcements')

@section('content')

<head>
    <style>
        /* Ensure that flexbox is applied correctly */
        .announcement-cards-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem; /* Adds space between cards */
        }

        .announcement-cards-container a {
            display: block;
            text-decoration: none;
            flex: 1 1 calc(33% - 1rem); /* Make each card take 33% of the width minus the gap */
            margin: 0.5rem; /* Adds margin around the card */
        }

        /* Make sure cards don't grow too large */
        .card {
            height: 100%;
        }
    </style>
</head>

<div class="announcements-container">
    <h2>Recent Announcements</h2>

    @if($announcements->isEmpty())
        <p>No announcements available.</p>
    @else
        <div class="announcement-cards-container">
            @foreach($announcements as $announcement)
                <a href="{{ route('announcement.show', $announcement->id) }}" class="text-decoration-none">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $announcement->title }}</h5>
                            <p class="card-text">{{ Str::limit($announcement->content, 100) }}</p>
                            <p class="text-muted small">Published on: {{ $announcement->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>


@endsection
