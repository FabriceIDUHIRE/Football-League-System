@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Referee: {{ $referee->name }}</h3>

    <form action="{{ route('referees.update', $referee->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Referee Name -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $referee->name) }}" required>
        </div>

        <!-- Nationality -->
        <div class="form-group mt-3">
            <label for="nationality">Nationality</label>
            <input type="text" name="nationality" id="nationality" class="form-control" value="{{ old('nationality', $referee->nationality) }}">
        </div>

        <!-- Experience Years -->
        <div class="form-group mt-3">
            <label for="experience_years">Experience Years</label>
            <input type="number" name="experience_years" id="experience_years" class="form-control" value="{{ old('experience_years', $referee->experience_years) }}" min="0">
        </div>

        <!-- Qualification -->
        <div class="form-group mt-3">
            <label for="qualification">Qualification</label>
            <input type="text" name="qualification" id="qualification" class="form-control" value="{{ old('qualification', $referee->qualification) }}">
        </div>

        <!-- Profile Photo -->
        <div class="form-group mt-3">
            <label for="profile_photo">Profile Photo</label>
            @if($referee->profile_photo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $referee->profile_photo) }}" alt="Profile Photo" class="img-thumbnail" style="max-width: 150px;">
                </div>
            @endif
            <input type="file" name="profile_photo" id="profile_photo" class="form-control">
        </div>

        <!-- Submit Button -->
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Update Referee</button>
            <a href="{{ route('referees.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
