{{-- resources/views/match_commissioners/create.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1>Add New Match Commissioner</h1>

    <form action="{{ route('match_commissioners.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
