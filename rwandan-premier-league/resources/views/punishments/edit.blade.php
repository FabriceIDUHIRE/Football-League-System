@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Punishment</h2>

    <form action="{{ route('punishments.update', $punishment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Display Punished Name (read-only) -->
        <div class="mb-3">
            <label class="form-label">Punished Name</label>
            <input type="text" class="form-control" value="{{ $punishment->team->name ?? $punishment->player->name ?? $punishment->coach->name ?? $punishment->referee->name ?? 'No Name Available' }}" disabled>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Punishment Type</label>
            <input type="text" name="type" class="form-control" value="{{ $punishment->type }}" required>
        </div>

        <div class="mb-3">
            <label for="reason" class="form-label">Reason</label>
            <textarea name="reason" class="form-control" required>{{ $punishment->reason }}</textarea>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control" value="{{ $punishment->start_date }}" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" name="end_date" class="form-control" value="{{ $punishment->end_date }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Punishment</button>
    </form>
</div>
@endsection
