@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Stadium: {{ $stadium->name }}</h3>

    <form action="{{ route('stadiums.update', $stadium->id) }}" method="POST">
        @csrf
        @method('PUT')  <!-- Use PUT for update -->
        
        <div class="form-group">
            <label for="name">Stadium Name</label>
            <input type="text" class="form-control" name="name" value="{{ $stadium->name }}" required>
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" name="location" value="{{ $stadium->location }}" required>
        </div>

        <div class="form-group">
            <label for="capacity">Capacity</label>
            <input type="number" class="form-control" name="capacity" value="{{ $stadium->capacity }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Stadium</button>
    </form>
</div>
@endsection

