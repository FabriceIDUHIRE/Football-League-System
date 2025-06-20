<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Dashboard</title>
</head>
<body>
$user = session('user');
    <h1>Welcome to the Team Dashboard</h1>
    <p>Hello, {{ $user}}</p>
    <a href="{{ route('team.logout') }}">Logout</a>
</body>
</html>
