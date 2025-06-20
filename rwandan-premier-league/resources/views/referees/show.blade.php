@extends('layouts.app')

@section('content')
<div class="container">
    <h3>{{ $referee->name }}</h3>
    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong>Nationality:</strong> {{ $referee->nationality ?? 'Not specified' }}</p>
            <p><strong>Experience Years:</strong> {{ $referee->experience_years ?? 'Not specified' }}</p>
            <p><strong>Qualification:</strong> {{ $referee->qualification ?? 'Not specified' }}</p>
            @if($referee->profile_photo)
                <p><strong>Profile Photo:</strong></p>
                <img src="{{ asset('storage/' . $referee->profile_photo) }}" alt="{{ $referee->name }}" class="img-thumbnail" style="max-width: 200px;">
            @else
                <p><strong>Profile Photo:</strong> Not uploaded</p>
            @endif
        </div>
    </div>
    <div class="mt-3">
        <a href="{{ route('referees.index') }}" class="btn btn-secondary">Back to Referees</a>
        <a href="{{ route('referees.edit', $referee->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('referees.destroy', $referee->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this referee?')">Delete</button>
        </form>
    </div>
</div>
@endsection
