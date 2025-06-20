@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit User</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active</option>
                <option value="blocked" {{ $user->status === 'blocked' ? 'selected' : '' }}>Blocked</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>

    <!-- Back Button -->
    <a href="{{ route('users.show', $user->id) }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
