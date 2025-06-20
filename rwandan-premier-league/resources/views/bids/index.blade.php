@extends('layouts.team_dashboard')

@section('content')

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>



    <div class="container">
        <h1 class="mb-4">Bid Requests for {{ $team->name }}</h1>


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



        <a href="{{ route('bids.create') }}" class="btn btn-primary" style="margin-bottom:4rem;">Send New Bid Request</a>

        @if ($bids->isEmpty())
            <div class="alert alert-info">
                No bids have been made for your team at the moment.
            </div>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Player</th>
                        <th>Bid Amount</th>
                        <th>Status</th>
                        <th>Message</th>
                        <th>Expires In</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bids as $bid)
                        <tr>
                            <td>{{ $bid->player->name }}</td>
                            <td>${{ number_format($bid->bid_amount, 2) }}</td>
                            <td>
    <span class="badge 
        {{ $bid->status == 'Accepted' ? 'bg-success' : '' }}
        {{ $bid->status == 'Rejected' ? 'bg-danger' : '' }}
        {{ $bid->status == 'Negotiating' ? 'bg-warning' : '' }}
        {{ !in_array($bid->status, ['Accepted', 'Rejected', 'Negotiating']) ? 'bg-secondary' : '' }}">
        {{ $bid->status }}
    </span>
</td>

                            <td>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#messageModal{{ $bid->id }}">Message</button>

                                <!-- Modal for Message -->
                                <div class="modal fade" id="messageModal{{ $bid->id }}" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">

                                <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bid Messages</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Buying Team ({{ $bid->buyingTeam->name }}):</strong> {{ $bid->buying_team_message ?? 'No message yet' }}</p>
                <p><strong>Selling Team ({{ $bid->sellingTeam->name }}):</strong> {{ $bid->selling_team_message ?? 'No response yet' }}</p>
            </div>
            <div class="modal-footer w-100">
    <form action="{{ route('bids.updateMessage', $bid->id) }}" method="POST" class="w-100">
        @csrf
        @method('PUT')
        <div class="mb-3 w-100">
            <label for="message" class="form-label">Reply</label>
            <textarea name="message" id="message" class="form-control w-100" rows="5" required style="width: 100% !important;"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
</div>

        </div>
    </div>

                                </div>
                            </td>
                            <td>
                               <span id="countdown-{{ $bid->id }}" class="badge bg-danger"></span>
                            </td>

                            <td>
                                @if ($bid->status == 'Pending')
                                    <form action="{{ route('bids.accept', $bid->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                    </form>
                                    
                                    <form action="{{ route('bids.reject', $bid->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                @elseif ($bid->status == 'Negotiating')
                                    <button class="btn btn-warning btn-sm" disabled>Negotiating</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        
    </div>
@endsection


<script>
    function startCountdown(expiryTime, elementId) {
        let countdownElement = document.getElementById(elementId);

        function updateCountdown() {
            let now = new Date().getTime();
            let timeLeft = expiryTime - now;

            if (timeLeft <= 0) {
                countdownElement.innerHTML = "Expired";
                countdownElement.classList.remove('bg-danger');
                countdownElement.classList.add('bg-secondary');
                return;
            }

            let hours = Math.floor((timeLeft / (1000 * 60 * 60)) % 24);
            let minutes = Math.floor((timeLeft / (1000 * 60)) % 60);
            let seconds = Math.floor((timeLeft / 1000) % 60);

            countdownElement.innerHTML = `${hours}h ${minutes}m ${seconds}s`;
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    }

    document.addEventListener("DOMContentLoaded", function () {
        @foreach ($bids as $bid)
            @if ($bid->expiry_date)
                startCountdown(new Date("{{ $bid->expiry_date }}").getTime(), "countdown-{{ $bid->id }}");
            @endif
        @endforeach
    });
</script>
