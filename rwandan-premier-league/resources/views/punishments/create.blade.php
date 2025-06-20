@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Punishment</h2>
    
    <form action="{{ route('punishments.store') }}" method="POST">
        @csrf

        <!-- Role Dropdown: Player, Coach, Team, Referee -->
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-select" required>
                <option value="">Select a Role</option>
                <option value="player">Player</option>
                <option value="coach">Coach</option>
                <option value="team">Team</option>
                <option value="referee">Referee</option>
            </select>
        </div>

        <!-- User Dropdown: Dynamically load players, coaches, teams, or referees -->
        <div class="mb-3" id="user-dropdown" style="display:none;">
            <label for="user_id" class="form-label">Select Name</label>
            <select name="user_id" id="user_id" class="form-select">
                <option value="">Select a User</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Punishment Type</label>
            <input type="text" name="type" id="type" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="reason" class="form-label">Reason</label>
            <textarea name="reason" id="reason" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Create Punishment</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let roleDropdown = document.getElementById('role');
        let userDropdownDiv = document.getElementById('user-dropdown');
        let userSelect = document.getElementById('user_id');

        let players = @json($players);
        let coaches = @json($coaches);
        let teams = @json($teams);
        let referees = @json($referees);

        roleDropdown.addEventListener('change', function () {
            let role = this.value;
            userDropdownDiv.style.display = role ? 'block' : 'none';

            // Clear previous options
            userSelect.innerHTML = '<option value="">Select a User</option>';

            let selectedUsers = [];
            if (role === 'player') selectedUsers = players;
            if (role === 'coach') selectedUsers = coaches;
            if (role === 'team') selectedUsers = teams;
            if (role === 'referee') selectedUsers = referees;

            selectedUsers.forEach(function (user) {
                let option = document.createElement('option');
                option.value = user.id;
                option.textContent = user.name; // Ensure that your database has 'name' for players, coaches, and referees
                userSelect.appendChild(option);
            });
        });
    });
</script>


@endsection
