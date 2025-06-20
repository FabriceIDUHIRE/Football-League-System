@extends('layouts.team_dashboard')

@section('content')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<!-- Content of the page -->
<div class="container mt-4">
    <h1 class="mb-4">Team Performance</h1>

    @if($performanceData->isEmpty())
        <div class="alert alert-warning">
            <p>No performance data found for your team.</p>
        </div>
    @else
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Performance Overview</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Team ID</th>
                            <th scope="col">Wins</th>
                            <th scope="col">Losses</th>
                            <th scope="col">Draws</th>
                            <th scope="col">Goals Scored</th>
                            <th scope="col">Goals Conceded</th>
                            <th scope="col">Yellow Cards</th>
                            <th scope="col">Red Cards</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $performanceData->first()->team_id }}</td>
                            <td>{{ $performanceData->first()->wins }}</td>
                            <td>{{ $performanceData->first()->losses }}</td>
                            <td>{{ $performanceData->first()->draws }}</td>
                            <td>{{ $performanceData->first()->goals_scored }}</td>
                            <td>{{ $performanceData->first()->goals_conceded }}</td>
                            <td>{{ $performanceData->first()->yellow_cards }}</td>
                            <td>{{ $performanceData->first()->red_cards }}</td>
                            <td>
                                <!-- Edit Button that opens the modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editPerformanceModal">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Modal -->
                <div class="modal fade" id="editPerformanceModal" tabindex="-1" aria-labelledby="editPerformanceModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editPerformanceModalLabel">Edit Team Performance</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form action="{{ route('performance.update', $performanceData->first()->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')


                                    <div class="mb-3">
                                        <label for="wins" class="form-label">Wins</label>
                                        <input type="number" class="form-control" id="wins" name="wins" value="{{ $performanceData->first()->wins }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="losses" class="form-label">Losses</label>
                                        <input type="number" class="form-control" id="losses" name="losses" value="{{ $performanceData->first()->losses }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="draws" class="form-label">Draws</label>
                                        <input type="number" class="form-control" id="draws" name="draws" value="{{ $performanceData->first()->draws }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="goals_scored" class="form-label">Goals Scored</label>
                                        <input type="number" class="form-control" id="goals_scored" name="goals_scored" value="{{ $performanceData->first()->goals_scored }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="goals_conceded" class="form-label">Goals Conceded</label>
                                        <input type="number" class="form-control" id="goals_conceded" name="goals_conceded" value="{{ $performanceData->first()->goals_conceded }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="yellow_cards" class="form-label">Yellow Cards</label>
                                        <input type="number" class="form-control" id="yellow_cards" name="yellow_cards" value="{{ $performanceData->first()->yellow_cards }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="red_cards" class="form-label">Red Cards</label>
                                        <input type="number" class="form-control" id="red_cards" name="red_cards" value="{{ $performanceData->first()->red_cards }}" required>
                                    </div>

                                    <button type="submit" class="btn btn-success">Update Performance</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endif
</div>

@endsection
