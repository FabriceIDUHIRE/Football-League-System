@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Page Header with Create Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-center" style="font-weight: bold; color: #343a40;">Announcements</h3>
        <a href="{{ route('announcements.create') }}" class="btn btn-primary" style="border-radius: 20px;">
            + Create Announcement
        </a>
    </div>

    <!-- Announcements Grid -->
    <div class="row g-4">
        @foreach($announcements as $announcement)
        <div class="col-md-6 col-lg-4 d-flex justify-content-center">
            <div class="card shadow-lg border-0"
                 style="width: 100%; border-radius: 15px; overflow: hidden; transition: transform 0.3s, box-shadow 0.3s;"
                 onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0px 10px 20px rgba(0, 0, 0, 0.2)';"
                 onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0px 4px 10px rgba(0, 0, 0, 0.1)';">
                <div class="card-header bg-primary text-white text-center"
                     style="font-size: 1.2rem; font-weight: bold;">
                    {{ $announcement->title }}
                </div>
                <div class="card-body" style="padding: 20px;">
                    <p class="card-text text-muted" style="font-size: 0.9rem;">
                        <strong>Date:</strong> {{ \Carbon\Carbon::parse($announcement->created_at)->format('M d, Y') }}
                    </p>
                    <p class="card-text" style="font-size: 1rem; line-height: 1.6;">
                        {{ Str::limit($announcement->content, 120, '...') }}
                    </p>
                    
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <a href="{{ route('announcements.edit', $announcement->id) }}" 
                           class="btn btn-sm btn-warning" style="border-radius: 20px;">Edit</a>
                        
                        <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this announcement?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" style="border-radius: 20px;">Delete</button>
                        </form>
                        
                        <a href="{{ route('announcements.show', $announcement->id) }}" 
                           class="btn btn-sm btn-outline-primary" style="border-radius: 20px;">Read More</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
