@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Register New Stadium</h3>

    <form action="{{ route('stadiums.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Stadium Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="location">Location</label>
        <input type="text" name="location" id="location" class="form-control">
    </div>
    <div class="form-group">
        <label for="capacity">Capacity</label>
        <input type="number" name="capacity" id="capacity" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>

</div>
@endsection
