@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Edit Team Profile</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('team.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-bold">Team Name:</label>
            <input type="text" name="name" value="{{ $team->name }}" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold">Logo:</label>
            <input type="file" name="logo" class="w-full p-2 border rounded">
            @if($team->logo)
                <img src="{{ asset('storage/' . $team->logo) }}" class="w-24 h-24 mt-2">
            @endif
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold">Primary Color:</label>
            <input type="color" name="primary_color" value="{{ $team->primary_color }}" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold">Secondary Color:</label>
            <input type="color" name="secondary_color" value="{{ $team->secondary_color }}" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold">Manager:</label>
            <input type="text" name="manager" value="{{ $team->manager }}" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-bold">History:</label>
            <textarea name="history" class="w-full p-2 border rounded">{{ $team->history }}</textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save Changes</button>
    </form>
</div>
@endsection
