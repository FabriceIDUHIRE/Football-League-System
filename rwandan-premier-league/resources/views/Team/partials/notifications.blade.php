<!-- resources/views/Team/partials/notifications.blade.php -->
@extends('layouts.team_dashboard')

@section('title', 'Notifications & Announcements')

@section('header', 'Notifications & Announcements')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold mb-4">Recent Notifications</h3>
        @if($notifications->isEmpty())
            <p>No notifications at this time.</p>
        @else
            <ul>
                @foreach($notifications as $notification)
                    <li class="mb-2">
                        <strong>{{ $notification->title }}</strong><br>
                        <span>{{ $notification->message }}</span><br>
                        <small class="text-gray-500">{{ $notification->created_at->format('F j, Y, g:i a') }}</small>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
