@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Create a New Referee</h3>

    <form action="{{ route('referees.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Referee Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="nationality">Nationality</label>
            <input type="text" name="nationality" id="nationality" class="form-control">
        </div>

        <div class="form-group">
            <label for="experience_years">Experience (Years)</label>
            <input type="number" name="experience_years" id="experience_years" class="form-control" min="0">
        </div>

        <div class="form-group">
            <label for="qualification">Qualification</label>
            <input type="text" name="qualification" id="qualification" class="form-control" placeholder="Enter the qualification">
        </div>

        <div class="form-group">
            <label for="profile_photo">Profile Photo</label>
            <input type="file" name="profile_photo" id="profile_photo" class="form-control">
        </div>

        <!-- Referee Type -->
<div class="form-group">
    <label for="type">Referee Type</label>
    <select name="type" id="type" class="form-control" required>
        <option value="central">Central</option>
        <option value="assistant">Assistant</option>
        <option value="fourth">Fourth</option>
    </select>
</div>


        <button type="submit" class="btn btn-primary">Save Referee</button>
    </form>
</div>
@endsection
