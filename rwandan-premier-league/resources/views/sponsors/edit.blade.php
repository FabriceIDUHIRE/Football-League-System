@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Sponsor</h3>

    <!-- Edit Sponsor Form -->
    <form action="{{ route('sponsors.update', $sponsor->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- This is important to tell Laravel it's an update request -->
        
        <div class="mb-3">
            <label for="sponsor_name" class="form-label">Sponsor Name</label>
            <input type="text" name="sponsor_name" class="form-control" id="sponsor_name" value="{{ $sponsor->sponsor_name }}" required>
        </div>

        <div class="mb-3">
            <label for="league_sponsor" class="form-label">League Sponsor</label>
            <select name="league_sponsor" id="league_sponsor" class="form-control" required>
                <option value="1" {{ $sponsor->league_sponsor == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ $sponsor->league_sponsor == 0 ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="contract_start_date" class="form-label">Contract Start Date</label>
            <input type="date" name="contract_start_date" class="form-control" id="contract_start_date" value="{{ $sponsor->contract_start_date }}" required>
        </div>

        <div class="mb-3">
            <label for="contract_end_date" class="form-label">Contract End Date</label>
            <input type="date" name="contract_end_date" class="form-control" id="contract_end_date" value="{{ $sponsor->contract_end_date }}" required>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" name="amount" class="form-control" id="amount" value="{{ $sponsor->amount }}" required>
        </div>



        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Update Sponsor</button>
        </div>
    </form>
</div>
@endsection
