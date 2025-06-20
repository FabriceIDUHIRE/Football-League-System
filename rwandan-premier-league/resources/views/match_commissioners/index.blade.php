{{-- resources/views/match_commissioners/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1>Match Commissioners</h1>

    <!-- Button to add a new commissioner -->
    <a href="{{ route('match_commissioners.create') }}" class="btn btn-primary mb-3">Add New Commissioner</a>

    <!-- Display Match Commissioners in a Table -->
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($matchCommissioners as $commissioner)
                <tr>
                    <td>{{ $commissioner->name }}</td>
                    <td>{{ $commissioner->email }}</td>
                    <td>{{ $commissioner->phone }}</td>
                    <td>
                        <a href="{{ route('match_commissioners.edit', $commissioner->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('match_commissioners.destroy', $commissioner->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
