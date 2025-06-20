@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Team</h1>

        @if ($errors->any())
          <div class="alert alert-danger">
           <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
             @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('teams.update', $team->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Team Name -->
            <div class="form-group">
                <label for="name">Team Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $team->name }}" required>
            </div>

            <!-- Location -->
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $team->location) }}" required>
            </div>

            <!-- Manager -->
            <div class="form-group">
                <label for="manager">Manager</label>
                <input type="text" class="form-control" id="manager" name="manager" value="{{ old('manager', $team->manager) }}" required>
            </div>

            <!-- Primary Color -->
            <div class="form-group">
                <label for="primary_color">Primary Color</label>
                <input type="color" class="form-control" id="primary_color" name="primary_color" value="{{ old('primary_color', $team->primary_color) }}" required>
            </div>

            <!-- Secondary Color -->
            <div class="form-group">
                <label for="secondary_color">Secondary Color</label>
                <input type="color" class="form-control" id="secondary_color" name="secondary_color" value="{{ old('secondary_color', $team->secondary_color) }}" required>
            </div>

            <!-- Logo -->
            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" class="form-control" id="logo" name="logo">
                @if($team->logo)
                    <div class="mt-3">
                        <img src="{{ asset('storage/' . $team->logo) }}" alt="Current Logo" class="img-fluid" style="max-width: 150px;">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-warning">Update Team</button>
        </form>
    </div>
@endsection
