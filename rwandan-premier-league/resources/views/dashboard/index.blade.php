@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:10rem;">
@php
    $cards = [
        ['Players', 'user-friends', 'success', 'playerCount', 'admin.players', 'players'],
        ['Referees', 'users', 'warning', 'refereeCount', 'referees.index', 'referees'],
        ['Stadiums', 'building', 'primary', 'stadiumCount', 'stadiums.index', 'stadiums'],
        ['Sponsors', 'handshake', 'danger', 'sponsorCount', 'admin.sponsors', 'sponsors'],
        ['Users', 'user', 'dark', 'userCount', 'users.index', 'users'],
        ['Transfers Approved', 'exchange-alt', 'info', 'transferApproved', 'Windowtransfers.index', 'approved'],
        ['Transfers Rejected', 'times-circle', 'danger', 'transferRejected', 'Windowtransfers.index', 'rejected'],
        ['Transfers Pending', 'hourglass-half', 'warning', 'transferPending', 'Windowtransfers.index', 'pending'],
    ];
@endphp

<div class="row">
    @foreach ($cards as $card)
        <div class="col-md-3 mb-4">
            <a href="{{ route($card[4], ['type' => $card[5]]) }}" class="text-decoration-none">
                <div class="card shadow-lg border-{{ $card[2] }} h-100 animated fadeInUp hover-scale">
                    <div class="card-header bg-{{ $card[2] }} text-white text-center">
                        <h4 class="mb-0"><i class="fas fa-{{ $card[1] }}"></i> {{ $card[0] }}</h4>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <h2 class="display-4 font-weight-bold text-{{ $card[2] }}">{{ ${$card[3]} }}</h2>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>

</div>

<style>
    .hover-scale {
        transition: transform 0.3s ease-in-out;
    }
    .hover-scale:hover {
        transform: scale(1.05);
    }
</style>
@endsection
