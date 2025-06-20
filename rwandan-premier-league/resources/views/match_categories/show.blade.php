@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-primary">Category Details</h3>
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">{{ $category->name }}</h5>
            <p class="card-text">{{ $category->description ?? 'No description available.' }}</p>
            <a href="{{ route('match_categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Categories
            </a>
        </div>
    </div>
</div>
@endsection

