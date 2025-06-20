@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <a href="{{ route('fixtures.create') }}" class="btn btn-primary mb-3">Add New Fixture</a>
    <h1 class="text-center">Fixtures</h1>

    @if($fixtures->isEmpty())
    <div class="alert alert-warning text-center">
        No fixtures available for your team at the moment.
    </div>
    @else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Home Team</th>
                <th>Away Team</th>
                <th>Match Date</th>
                <th>Stadium</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fixtures as $fixture)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $fixture->homeTeam->name }}</td>
                    <td>{{ $fixture->awayTeam->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($fixture->match_date)->format('d M Y - H:i') }}</td>
                    <td>{{ $fixture->stadium->name ?? 'TBD' }}</td>
                    <td>
                        <a href="{{ route('fixtures.edit', $fixture->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('fixtures.destroy', $fixture->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
