@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                {{-- Team Details Card --}}
                <div class="card shadow-lg rounded-lg" style="font-size: 1.5rem; padding: 3rem;">
                    <div class="card-header" 
                         style="background-color: {{ $team->primary_color }}; color: {{ $team->secondary_color }}; border-radius: 15px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="mb-0" style="font-size: 3rem; font-weight: bold;">{{ $team->name }}</h2>
                            {{-- Team Logo --}}
                            <img src="{{ asset('storage/' . $team->logo) }}" alt="{{ $team->name }} Logo" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                {{-- Team Location --}}
                                <h4><strong>Location:</strong></h4>
                                <p style="font-size: 1.25rem;">{{ $team->location }}</p>
                            </div>
                            <div class="col-md-6">
                                {{-- Team Manager --}}
                                <h4><strong>Manager:</strong></h4>
                                <p style="font-size: 1.25rem;">{{ $team->manager ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <hr>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                {{-- Primary Color --}}
                                <h4><strong>Primary Color:</strong></h4>
                                <div class="d-flex align-items-center">
                                    <span style="display: inline-block; width: 50px; height: 50px; background-color: {{ $team->primary_color }}; border-radius: 50%;"></span>
                                    <p style="font-size: 1.25rem; margin-left: 10px;">{{ $team->primary_color }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{-- Secondary Color --}}
                                <h4><strong>Secondary Color:</strong></h4>
                                <div class="d-flex align-items-center">
                                    <span style="display: inline-block; width: 50px; height: 50px; background-color: {{ $team->secondary_color }}; border-radius: 50%;"></span>
                                    <p style="font-size: 1.25rem; margin-left: 10px;">{{ $team->secondary_color }}</p>
                                </div>
                            </div>
                        </div>

                        <hr>

                        {{-- Team History --}}
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h4><strong>Team History:</strong></h4>
                                <p style="font-size: 1.25rem;">{{ $team->history ?? 'No history available.' }}</p>
                            </div>
                        </div>

                        <!-- Edit and Delete Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('teams.edit', $team->id) }}" class="btn btn-warning">Edit Team</a>

                            <form action="{{ route('teams.destroy', $team->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this team?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete Team</button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Additional Information --}}
                {{-- You can continue adding sections below if required --}}
            </div>
        </div>
    </div>
@endsection
