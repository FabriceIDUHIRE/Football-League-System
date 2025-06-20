@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">All Stadiums</h3>
        <a href="{{ route('stadiums.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Stadium
        </a>
    </div>

    <!-- Check if there are stadiums -->
    @if($stadiums->isEmpty())
        <div class="alert alert-warning">
            No stadiums found. Click "Add Stadium" to create one.
        </div>
    @else
        <!-- Stadiums List -->
        <div class="list-group">
            @foreach($stadiums as $stadium)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">{{ $stadium->name }}</h5> <!-- Display the stadium name -->
                        <small class="text-muted">{{ $stadium->location ?? 'Location not available' }}</small>
                    </div>
                    <div>
                        <!-- Action Buttons -->
                        <a href="{{ route('stadiums.show', $stadium->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('stadiums.edit', $stadium->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('stadiums.destroy', $stadium->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this stadium?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $stadiums->links() }}
    </div>
</div>
@endsection
