<!-- resources/views/layouts/team_dashboard.blade.php -->
@php
    use Illuminate\Support\Facades\Auth;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Team Dashboard')</title>

    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            @if(Auth::check() && Auth::user()->team)
            <img src="{{ asset('storage/' . Auth::user()->team->logo) }}" alt="Team Logo" class="team-logo">

                <p>Welcome!  {{ Auth::user()->team->name }}</p>
            @else
                <p>No team assigned</p>
            @endif
        </div>

<nav>
    <ul>
        <li><a href="{{ route('team.dashboard') }}"><i class="fas fa-chart-line"></i> <span>Dashboard</span></a></li>
        <li><a href="{{ route('team.profile') }}"><i class="fas fa-user"></i> <span>Team Profile</span></a></li>
        <li><a href="{{ route('team.standings') }}"><i class="fas fa-trophy"></i> Table Standings</a></li>
        <li><a href="{{ route('teams.staff') }}"><i class="fas fa-users"></i> <span>Staff</span></a></li>
        <li><a href="{{ route('team.match-results') }}"><i class="fas fa-table"></i> <span>Match Results</span></a></li>
        <li><a href="{{ route('team.match-management') }}"><i class="fas fa-futbol"></i> <span>Upcoming Matches</span></a></li>
        <!--<li><a href="{{ route('fixtures') }}"><i class="fas fa-calendar-alt"></i> <span>View All Fixtures</span></a></li>-->
        <li><a href="{{ route('team.player-management') }}"><i class="fas fa-users"></i> <span>Players</span></a></li>
        <li><a href="{{ route('team.sponsorship') }}"><i class="fas fa-handshake"></i> <span>Sponsors</span></a></li>
        <!--<li><a href="{{ route('team.notifications') }}"><i class="fas fa-bell"></i> <span>Notifications</span></a></li>-->
        <!--<li><a href="{{ route('team.performance') }}"><i class="fas fa-chart-line"></i> <span>Performance Tracking</span></a></li>-->
        <li><a href="{{ route('team.doctor-management') }}"><i class="fas fa-user-md"></i> <span>Doctors</span></a></li>
        <!--<li><a href="{{ route('player-performance.index') }}"><i class="fas fa-chart-line"></i> <span>Player Performance</span></a></li>-->
        <li><a href="{{ route('transfers.index') }}"><i class="fas fa-exchange-alt"></i> <span>Transfers</span></a></li>
        <li><a href="{{ route('contracts.index') }}"><i class="fas fa-file-contract"></i> <span>Contracts</span></a></li>
        <li><a href="{{ route('injuries.index') }}"><i class="fas fa-briefcase-medical"></i> <span>Injuries</span></a></li>
        <li><a href="{{ route('lineup.index') }}"><i class="fas fa-th-list"></i> <span>Line-Up</span></a></li>
        <li><a href="{{ route('team.posts') }}"><i class="fas fa-pencil-alt"></i> <span>Posts</span></a></li>
        <li><a href="{{ route('team.announcements') }}"><i class="fas fa-bullhorn"></i> <span>Announcements</span></a></li>
        <li><a href="{{ route('team.feedback') }}"><i class="fas fa-comments"></i> <span>Fan Engagement</span></a></li>
        <li><a href="{{ route('bids.index') }}"><i class="fas fa-handshake"></i> <span>Bids</span></a></li>
        <li><a href="{{ route('team.report', ['id' => $team->id]) }}" style="margin-bottom:7rem;"><i class="fas fa-chart-line"></i>View Reports</a></li> 
    </ul>
</nav>


        <div class="logout-section">
            <form method="POST" action="{{ route('team.logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <header class="navbar">
            <h2>@yield('header', 'Dashboard')</h2>
            <div class="profile-info">
                <button class="notification-button"><i class="fas fa-bell"></i></button>
                <div class="profile-picture">
                <img src="{{ asset('storage/' . Auth::user()->team->logo) }}" alt="Profile Picture" class="small-img">

                </div>
            </div>
        </header>

        <main class="content">
            @yield('content')
        </main>
    </div>

    <!-- Custom Scripts -->
    <script>
        document.querySelector(".notification-button").addEventListener("click", function() {
            alert("No new notifications");
        });
    </script>
</body>
</html>
