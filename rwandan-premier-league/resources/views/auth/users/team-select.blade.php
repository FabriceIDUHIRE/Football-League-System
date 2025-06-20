<!-- resources/views/user/select.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <h1>Welcome to your Dashboard, {{ Auth::user()->name }}</h1>
    <h2>Select a Team to View Updates</h2>

    <!-- Display all teams -->
    <ul>
        @foreach ($teams as $team)
            <li>
                <a href="{{ route('team.details', $team->id) }}">
                    <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }} Logo" width="50">
                    {{ $team->name }}
                </a>
            </li>
        @endforeach
    </ul>

</body>
</html>
