{{-- resources/views/matches/partials/matches-list.blade.php --}}
@foreach ($matches as $match)
    <div class="col-md-4 mb-4">
        <a href="{{ route('matches.show', $match->id) }}" style="text-decoration: none; color: inherit;">
            <div class="card shadow-lg">
                @if ($match->homeTeam)
                    <img src="{{ asset('storage/' . $match->homeTeam->logo) }}" class="card-img-top" alt="{{ $match->homeTeam->name }}">
                @else
                    <img src="{{ asset('storage/logos/default.png') }}" class="card-img-top" alt="Default Team Logo">
                @endif
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $match->homeTeam ? $match->homeTeam->name : 'No Team' }} vs 
                        {{ $match->awayTeam ? $match->awayTeam->name : 'No Team' }}
                    </h5>
                    <p class="card-text">
                        <strong>Date:</strong> {{ \Carbon\Carbon::parse($match->match_date)->format('M d, Y') }} <br>
                        <strong>Time:</strong> {{ \Carbon\Carbon::parse($match->match_date)->format('H:i') }}
                    </p>
                </div>
            </div>
        </a>
    </div>
@endforeach
