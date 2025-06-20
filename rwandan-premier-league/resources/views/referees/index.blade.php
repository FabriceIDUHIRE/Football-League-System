@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">All Referees</h3>
        <a href="{{ route('referees.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Referee
        </a>
    </div>

    <!-- Check if there are referees -->
    @if($referees->isEmpty())
        <div class="alert alert-warning">
            No referees found. Click "Add Referee" to create one.
        </div>
    @else
        <!-- Referees List -->
        <div class="list-group">
            @foreach($referees as $referee)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">{{ $referee->name }}</h5> <!-- Display the referee's name -->
                        <small class="text-muted">{{ $referee->qualification ?? 'Qualification not available' }}</small>
                    </div>
                    <div>
                        <!-- Action Buttons -->
                        <a href="{{ route('referees.show', $referee->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('referees.edit', $referee->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('referees.destroy', $referee->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this referee?')">
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
        {{ $referees->links() }}
    </div>
</div>
@endsection
