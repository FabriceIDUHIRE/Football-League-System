<!-- resources/views/managers/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Manager</title>
</head>
<body>
    <h1>Add New Manager</h1>

    <form action="{{ route('managers.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Manager Name" required>
        <input type="email" name="email" placeholder="Manager Email" required>
        <input type="text" name="phone" placeholder="Manager Phone">
        <select name="team_id" required>
            @foreach ($teams as $team)
                <option value="{{ $team->id }}">{{ $team->name }}</option>
            @endforeach
        </select>
        <button type="submit">Add Manager</button>
    </form>

</body>
</html>
