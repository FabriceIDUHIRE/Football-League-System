@php
    use Illuminate\Support\Facades\Auth;
@endphp

@extends('layouts.team_dashboard')

@section('content')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<div class="container mt-4">
    <h2 class="mb-4">Sponsorship Details</h2>

    <!-- Add Sponsor Button -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addSponsorModal">
        <i class="fas fa-plus"></i> Add New Sponsor
    </button>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Flash Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Sponsors Table -->
    <table class="table table-bordered shadow-sm">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Contract Start</th>
                <th>Contract End</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sponsors as $sponsor)
            <tr>
                <td>{{ $sponsor->sponsor_name }}</td>
                <td>{{ $sponsor->contract_start_date }}</td>
                <td>{{ $sponsor->contract_end_date }}</td>
                <td>{{ number_format($sponsor->amount, 2) }} RWF</td>
                <td>
                    <!-- Edit Button -->
                    <button class="btn btn-primary btn-sm editSponsorBtn" 
                        data-id="{{ $sponsor->id }}"
                        data-name="{{ $sponsor->sponsor_name }}"
                        data-start="{{ $sponsor->contract_start_date }}"
                        data-end="{{ $sponsor->contract_end_date }}"
                        data-amount="{{ $sponsor->amount }}"
                        data-bs-toggle="modal" 
                        data-bs-target="#editSponsorModal">
                        <i class="fas fa-edit"></i>
                    </button>

                    <!-- Delete Button -->
                    <form action="{{ route('team-sponsors.destroy', $sponsor->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add Sponsor Modal -->
<div class="modal fade" id="addSponsorModal" tabindex="-1" aria-labelledby="addSponsorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="addSponsorLabel">Add New Sponsor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('sponsors.store') }}" method="POST">
                @csrf
                <input type="hidden" name="team_id" value="{{ Auth::user()->team_id }}">

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Sponsor Name</label>
                        <input type="text" name="sponsor_name" class="form-control" placeholder="Sponsor Name" required>
                    </div>

                    <div class="mb-3">
                        <label>Contract Start Date</label>
                        <input type="date" name="contract_start_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Contract End Date</label>
                        <input type="date" name="contract_end_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Amount (RWF)</label>
                        <input type="number" name="amount" class="form-control" placeholder="1000000 RWF" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save Sponsor</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Sponsor Modal -->
<div class="modal fade" id="editSponsorModal" tabindex="-1" aria-labelledby="editSponsorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editSponsorLabel">Edit Sponsor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="editSponsorForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Sponsor Name</label>
                        <input type="text" name="sponsor_name" id="editSponsorName" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Contract Start Date</label>
                        <input type="date" name="contract_start_date" id="editStartDate" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Contract End Date</label>
                        <input type="date" name="contract_end_date" id="editEndDate" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Amount (RWF)</label>
                        <input type="number" name="amount" id="editAmount" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Sponsor</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript to Populate Edit Modal -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".editSponsorBtn").forEach(button => {
            button.addEventListener("click", function() {
                let id = this.getAttribute("data-id");
                let name = this.getAttribute("data-name");
                let start = this.getAttribute("data-start");
                let end = this.getAttribute("data-end");
                let amount = this.getAttribute("data-amount");

                document.getElementById("editSponsorName").value = name;
                document.getElementById("editStartDate").value = start;
                document.getElementById("editEndDate").value = end;
                document.getElementById("editAmount").value = amount;

                document.getElementById("editSponsorForm").setAttribute("action", `/sponsors/${id}`);
            });
        });
    });
</script>

@endsection
