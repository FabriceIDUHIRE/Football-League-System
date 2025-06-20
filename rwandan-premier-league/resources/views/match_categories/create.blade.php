@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-primary font-weight-bold">Create New Match Category</h3>
        <a href="{{ route('match_categories.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Categories
        </a>
    </div>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <strong>Whoops! Something went wrong.</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Create Category Form -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title text-secondary mb-4">Category Details</h5>
            <form action="{{ route('match_categories.store') }}" method="POST">
                @csrf
                
                <!-- Name Field -->
                <div class="form-group mb-4">
                    <label for="name" class="font-weight-bold">Category Name <span class="text-danger">*</span></label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        class="form-control border-primary" 
                        placeholder="Enter category name" 
                        required 
                        value="{{ old('name') }}">
                </div>

                <!-- Description Field -->
                <div class="form-group mb-4">
                    <label for="description" class="font-weight-bold">Category Description</label>
                    <textarea 
                        name="description" 
                        id="description" 
                        class="form-control border-primary" 
                        rows="4" 
                        placeholder="Enter category description (optional)">{{ old('description') }}</textarea>
                </div>

                <!-- Save Button -->
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
