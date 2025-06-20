@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Add Team Form -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Create New Team</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('teams.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Team Name -->
                        <div class="form-group">
                            <label for="name">Team Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <!-- Manager Name (Text Input) -->
                        <div class="form-group">
                            <label for="manager">Manager Name</label>
                            <input type="text" class="form-control" id="manager" name="manager" required>
                        </div>

                        <!-- Captain Selection -->
                        <div class="form-group">
                            <label for="captain_id">Captain</label>
                            <select class="form-control" id="captain_id" name="captain_id" required>
                                <option value="">Select Captain</option>
                                @foreach($players as $player)
                                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Username -->
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Add Team</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



