@extends('layouts.team_dashboard')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="text-center">Add New Doctor</h1>
        </div>
    </div>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form to add a new doctor -->
    <form action="{{ route('doctor.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Doctor Information</h4>
            </div>
            <div class="card-body">
                <!-- Hidden input for the team_id -->
                <input type="hidden" name="team_id" value="{{ $team->id }}">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="specialization">Specialization</label>
                    <input type="text" id="specialization" name="specialization" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="contact_info">Contact Info</label>
                    <input type="text" id="contact_info" name="contact_info" class="form-control" required>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success btn-lg">
                    <i class="fas fa-plus-circle"></i> Add Doctor
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
