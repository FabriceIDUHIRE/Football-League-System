@extends('layouts.team_dashboard')

@section('content')

<head>
    <!-- jQuery and Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<div class="container">
    <h2 class="mb-4">Contracts</h2>

    <!-- Success message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add Contract Button -->
    <a href="{{ route('contracts.create') }}" class="btn btn-primary mb-3">Add New Contract</a>

    <!-- Contracts Table -->
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Player</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Salary</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contracts as $contract)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $contract->player->name }}</td>
                            <td>{{ $contract->start_date }}</td>
                            <td>{{ $contract->end_date }}</td>
                            <td>{{ number_format($contract->salary, 2) }} Rwf</td>
                            <td>
                                <span class="badge 
                                    @if($contract->contract_status == 'active') bg-success text-dark
                                    @elseif($contract->contract_status == 'expired') bg-warning text-dark
                                    @elseif($contract->contract_status == 'terminated') bg-danger text-light
                                    @endif">
                                    {{ ucfirst($contract->contract_status) }}
                                </span>
                            </td>
                            <td>
                            <button type="button"
        class="btn btn-warning btn-sm"
        data-bs-toggle="modal"
        data-bs-target="#editContractModal"
        data-contract='@json($contract)'>
    Edit
</button>

                                <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this contract?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                
                                <!-- Add Terminate Contract Button (Only if the contract is active) -->
                                @if($contract->contract_status == 'active')
                                    <form action="{{ route('contracts.terminate', $contract->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to terminate this contract?');">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Terminate Contract</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if($contracts->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">No new Contracts Made yet!.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Edit Contract Modal -->
<div class="modal fade" id="editContractModal" tabindex="-1" aria-labelledby="editContractModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="editContractForm">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Contract</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="edit_contract_id">

                    <div class="mb-3">
                        <label>Player</label>
                        <select name="player_id" id="edit_player_id" class="form-select" required>
                            @foreach($contracts->pluck('player')->unique('id') as $player)
                                <option value="{{ $player->id }}">{{ $player->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Start Date</label>
                        <input type="date" name="start_date" id="edit_start_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>End Date</label>
                        <input type="date" name="end_date" id="edit_end_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Salary</label>
                        <input type="number" name="salary" id="edit_salary" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="contract_status" id="edit_status" class="form-select" required>
                            <option value="active">Active</option>
                            <option value="expired">Expired</option>
                            <option value="terminated">Terminated</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>



@endsection


<script>
    const editModal = document.getElementById('editContractModal');
    const editForm = document.getElementById('editContractForm');

    editModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const contract = JSON.parse(button.getAttribute('data-contract'));

        // Fill input fields
        document.getElementById('edit_player_id').value = contract.player_id;
        document.getElementById('edit_start_date').value = contract.start_date;
        document.getElementById('edit_end_date').value = contract.end_date;
        document.getElementById('edit_salary').value = contract.salary;
        document.getElementById('edit_status').value = contract.contract_status;

        // Set the form action URL
        editForm.action = `/contracts/${contract.id}`;
    });
</script>


