@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>{{ $announcement->title }}</h3>
    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($announcement->created_at)->format('M d, Y') }}</p>
    <p>{{ $announcement->content }}</p>
    <a href="{{ route('announcements.index') }}" class="btn btn-secondary mt-3">Back to Announcements</a>
</div>
@endsection
