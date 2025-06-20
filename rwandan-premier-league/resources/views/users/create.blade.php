@extends('layouts.app')

@section('content')
<div class="container">
    <h2>User Details</h2>

    <div class="card p-3">
        <h5>Email: {{ $user->email }}</h5>
        <h5>Username: {{ $user->username }}</h5>
        <h5>Status: 
            <span class="badge {{ $user->status === 'blocked' ? 'bg-danger' : 'bg-success' }}">
                {{ ucfirst($user->status) }}
            </span>
        </h5>

        <div class="mt-3">
            <!-- Edit Button -->
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>

            <!-- Delete Button -->
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>

            <!-- Block / Unblock Button -->
            @if ($user->status === 'active')
                <form action="{{ route('users.block', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-warning">Block</button>
                </form>
            @else
                <form action="{{ route('users.unblock', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">Unblock</button>
                </form>
            @endif

            <!-- Reset Password -->
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#resetPasswordModal">
                Reset Password
            </button>
        </div>
    </div>
</div>

<!-- Reset Password Modal -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('users.updatePassword', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reset Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="password" name="password" class="form-control" placeholder="New Password" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
