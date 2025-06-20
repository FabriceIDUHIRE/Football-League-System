@extends('layouts.team_dashboard')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">All Fixtures</h2>

    <div class="row">
        @foreach($matches as $match)
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $match->homeTeam->name }} vs {{ $match->awayTeam->name }}</h5>
                    <p class="card-text">Date: {{ $match->match_date }}</p>
                    <p class="card-text">Stadium: {{ $match->stadium->name }}</p>
                    <span class="badge bg-info">{{ $match->category->name }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
