<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $team->name }} Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen">
    <!-- Sidebar -->
    <div class="flex h-full">
        <aside class="w-64 bg-blue-800 text-white flex flex-col">
            <div class="p-6 text-center border-b border-blue-700">
                <h1 class="text-xl font-bold">{{ $team->name }}</h1>
            </div>
            <nav class="flex-1 px-4 py-6">
                <ul>
                    <li class="mb-4">
                        <a href="#overview" class="block py-2 px-4 rounded hover:bg-blue-700">Overview</a>
                    </li>
                    <li class="mb-4">
                        <a href="#matches" class="block py-2 px-4 rounded hover:bg-blue-700">Matches</a>
                    </li>
                    <li class="mb-4">
                        <a href="#players" class="block py-2 px-4 rounded hover:bg-blue-700">Players</a>
                    </li>
                    <li class="mb-4">
                        <a href="#sponsors" class="block py-2 px-4 rounded hover:bg-blue-700">Sponsors</a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('team.logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left py-2 px-4 rounded hover:bg-red-700">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold">Dashboard</h2>
                <div class="flex items-center gap-4">
                    <button class="relative">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">3</span>
                    </button>
                    <div class="w-10 h-10 rounded-full bg-gray-300 overflow-hidden">
                        <img src="https://via.placeholder.com/150" alt="Profile Picture">
                    </div>
                </div>
            </header>

            <!-- Dynamic Content -->
            <main class="flex-1 p-6 overflow-y-auto">
                <section id="overview" class="mb-8">
                    @include('partials.team-overview', ['team' => $team])
                </section>

                <section id="matches" class="mb-8">
                    @include('partials.matches', ['matches' => $matches])
                </section>

                <section id="players" class="mb-8">
                    @include('partials.players', ['players' => $players])
                </section>

                <section id="sponsors" class="mb-8">
                    @include('partials.sponsors', ['sponsors' => $sponsors])
                </section>
            </main>
        </div>
    </div>
</body>
</html>