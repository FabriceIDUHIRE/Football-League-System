<?php
    use Illuminate\Support\Str;
?>



<!DOCTYPE html>
<html lang="en">
<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Page - My Team</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <style>
        .team-logo { height: 60px; width: 60px; object-fit: contain; }
        .badge { padding: 5px 10px; border-radius: 5px; color: white; font-weight: bold; }
        .video-thumbnail { height: 180px; object-fit: cover; }
        .player-card { border: 1px solid #ddd; border-radius: 10px; padding: 20px; text-align: center; background-color: white; }
    </style>
</head>

<body class="bg-gray-100">
<!-- Mobile Hamburger Menu -->
<div class="lg:hidden">
    <button id="menu-btn" class="text-white p-4 focus:outline-none">
        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>
</div>


<!-- Navbar -->
<nav class="bg-white text-black py-4 px-6 shadow-md">
    <div class="container mx-auto flex items-center justify-between">
        <!-- Team Logo -->
        <img src="<?php echo e(asset('storage/' . $team->logo)); ?>" alt="Team Logo" class="h-16 w-auto">
        
        <!-- Desktop Menu -->
        <div class="hidden lg:flex space-x-6 text-lg font-medium">
        <a href="<?php echo e(route ('select.team')); ?>" class="hover:text-gray-500">Home</a>
            <a href="#team-news" class="hover:text-gray-500">News</a>
            <a href="#team-history" class="hover:text-gray-500">History</a>
            <a href="#latest-videos" class="hover:text-gray-500">Videos</a>
            <a href="#team-roster" class="hover:text-gray-500">Roster</a>
            <a href="#sponsors" class="hover:text-gray-500">Sponsors</a>
            <a href="#fan-club" class="hover:text-gray-500">Fan Club</a>
            <a href="#events" class="hover:text-gray-500">Events</a>
            <a href="#ticket-purchase" class="hover:text-gray-500">Tickets</a>
            <a href="#contact" class="hover:text-gray-500">Contact</a>
        </div>
        <!-- Mobile Menu Button -->
        <div class="lg:hidden">
            <button id="menu-btn" class="text-black p-4 focus:outline-none">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>
</nav>

<!-- Mobile Menu -->
<div id="mobile-menu" class="lg:hidden bg-white text-black py-4 space-y-4 hidden text-center shadow-md">
    <a href="#team-news" class="block">News</a>
    <a href="#team-history" class="block">History</a>
    <a href="#latest-videos" class="block">Videos</a>
    <a href="#team-roster" class="block">Roster</a>
    <a href="#sponsors" class="block">Sponsors</a>
    <a href="#fan-club" class="block">Fan Club</a>
    <a href="#events" class="block">Events</a>
    <a href="#ticket-purchase" class="block">Tickets</a>
    <a href="#contact" class="block">Contact</a>
</div>

<!-- Team Header -->
<header class="relative w-full h-80 bg-cover bg-center flex items-center justify-center" style="background-image: url('<?php echo e($team->logo); ?>');">
    <div class="text-center text-white">
        <img src="<?php echo e(asset('storage/' . $team->logo)); ?>" alt="<?php echo e($team->name); ?>" class="mx-auto h-24 w-auto mb-4">
        <h1 class="text-4xl font-bold"><?php echo e($team->name); ?></h1>
        <p class="text-lg"><?php echo e($team->location); ?></p>
    </div>
</header>





<!-- Team News Section -->
<section class="team-news py-16 bg-gray-100" id="team-news">
    <div class="container mx-auto text-center">
        <h2 class="text-5xl font-extrabold uppercase tracking-widest text-blue-700">Latest News</h2>
        <div class="mt-10 grid grid-cols-1 lg:grid-cols-2 gap-10">
            <?php if($team->posts->count() > 0): ?>
            <!-- First Post (BIG) -->
            <div class="col-span-1 lg:col-span-2">
                <div class="bg-white shadow-lg p-8 rounded-md">
                <img src="<?php echo e(asset('storage/' . $team->posts->first()->image)); ?>" 
     alt="<?php echo e($team->posts->first()->title); ?>" 
     class="w-full h-[500px] object-cover rounded-lg">

                    <h3 class="text-4xl font-bold mt-6 text-blue-800"><?php echo e($team->posts->first()->title); ?></h3>
                    <p class="mt-4 text-lg text-gray-700"><?php echo e(\Illuminate\Support\Str::limit($team->posts->first()->content, 300)); ?></p>
                    <a href="#" class="mt-4 inline-block bg-blue-600 text-white py-2 px-6 rounded-full hover:bg-blue-800 transition duration-300">Read More</a>
                </div>
            </div>

            <!-- Remaining Posts (Smaller Grid) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <?php $__currentLoopData = $team->posts->skip(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white shadow-md p-5 rounded-md">
                <img src="<?php echo e(asset('storage/' . $post->image)); ?>" alt="<?php echo e($post->title); ?>" class="w-full h-48 object-cover rounded-md">
                <h3 class="text-2xl font-semibold mt-4"><?php echo e($post->title); ?></h3>
                    <p class="mt-2 text-gray-600"><?php echo e(Str::limit($post->content, 150)); ?></p>
                    <a href="#" class="text-blue-600 mt-2 inline-block hover:underline">Read More</a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php else: ?>
            <p class="text-2xl text-gray-600">No news posted yet for <?php echo e($team->name); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>


<!-- Team History Section -->
<section class="team-history py-10 bg-gray-50" id="team-history">
    <h2 class="text-3xl font-bold text-center">Our History</h2>
    <div class="container mx-auto text-center mt-6">
    <p class="text-lg"><?php echo e($team->history); ?></p>
    </div>
</section>




<!-- Latest Video Highlights -->
<section class="latest-videos py-10" id="latest-videos">
    <h2 class="text-3xl font-bold text-center">Latest Videos</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-6 container mx-auto">
        <div class="video-card">
            <img src="video-thumbnail.jpg" alt="Video Thumbnail" class="video-thumbnail w-full">
            <h3 class="text-xl font-semibold mt-4 text-center">APR FC vs Mukura FC Highlights</h3>
            <a href="#" class="text-blue-600 mt-2 inline-block text-center">Watch Video</a>
        </div>
        <!-- Repeat for more videos -->
    </div>
</section>

<!-- Team Roster Section -->
<section class="team-roster py-10 bg-gray-50" id="team-roster">
    <h2 class="text-3xl font-bold text-center text-gray-800">Team Roster - <?php echo e($team->name); ?></h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-6 container mx-auto">
        <?php $__currentLoopData = $players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="player-card bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
        <img src="<?php echo e(asset('storage/' . $player->image)); ?>" alt="<?php echo e($player->name); ?>" class="w-32 h-32 object-cover mx-auto rounded-full">
        <h3 class="text-xl font-semibold text-center mt-4 text-gray-900"><?php echo e($player->name); ?></h3>
            <p class="text-center text-gray-600"><?php echo e($player->position); ?></p>
            <p class="text-center text-gray-500 mt-2">Country: <?php echo e($player->nationality); ?></p>
            <p class="text-center text-gray-500">Jersey Number#: <?php echo e($player->jersey_number); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>



<!-- Fan Club Section -->
<section class="fan-club py-10" id="fan-club">
    <h2 class="text-3xl font-bold text-center">Join Our Fan Club</h2>
    <div class="container mx-auto text-center mt-6">
        <p class="text-lg">Become a part of the APR FC family by joining our fan club and receiving exclusive updates and benefits!</p>
        <a href="#" class="text-blue-600 mt-2 inline-block">Join Now</a>
    </div>
</section>




<!-- Upcoming Match Section -->
<section class="events py-10 bg-gray-50" id="events">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center text-gray-800 mb-10">Upcoming Match</h2>

        <?php if($match): ?>
            <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6 border border-gray-200">
                <div class="text-center">
                    <h3 class="text-2xl font-semibold text-gray-800">
                        <?php echo e($match->homeTeam->name ?? 'TBD'); ?>

                        <span class="text-gray-500">vs</span>
                        <?php echo e($match->awayTeam->name ?? 'TBD'); ?>

                    </h3>

                    <p class="text-lg text-gray-700 mt-4">
                        📅 
                        <span class="font-medium"><?php echo e(\Carbon\Carbon::parse($match->match_date)->format('l, F j, Y')); ?></span>
                    </p>

                    <p class="text-lg text-gray-700">
                        🏟️ 
                        <span class="font-medium"><?php echo e($match->stadium->name ?? 'Unknown Stadium'); ?></span>
                    </p>

                    <a href="#" class="inline-block mt-6 text-blue-600 hover:text-blue-800 font-medium transition">
                        Learn More →
                    </a>
                </div>
            </div>
        <?php else: ?>
            <p class="text-center text-lg text-gray-600">No upcoming match scheduled for this team.</p>
        <?php endif; ?>
    </div>
</section>





<!-- Ticket Purchase Section -->
<section class="ticket-purchase py-10" id="ticket-purchase">
    <h2 class="text-3xl font-bold text-center">Buy Tickets</h2>
    <div class="container mx-auto text-center mt-6">
        <p class="text-lg">Get your tickets for the upcoming matches. Don't miss out on the action!</p>
        <a href="https://www.ticqet.rw/" class="text-blue-600 mt-2 inline-block">Purchase Tickets</a>
    </div>
</section>





<!-- Sponsors Section -->
<section class="sponsors py-12 bg-gray-100" id="sponsors">
    <h2 class="text-4xl font-bold text-center text-gray-800">Our Sponsors</h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-12 mt-8 container mx-auto px-6">
        <?php $__empty_1 = true; $__currentLoopData = $sponsors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sponsor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="sponsor-card bg-white flex items-center justify-center h-52 w-52 text-center rounded-full border-4 border-gray-400 shadow-lg">
                <h3 class="text-2xl font-bold text-gray-700"><?php echo e($sponsor->sponsor_name); ?></h3>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-center text-gray-600">No sponsors available for this team.</p>
        <?php endif; ?>
    </div>
</section>




<!-- Fan Club Section -->
<section class="fan-club py-10" id="fan-club">
    <h2 class="text-3xl font-bold text-center">Join the <span id="team-name"> Team</span> Fan Club</h2>
    <div class="container mx-auto text-center mt-6">
        <p class="text-lg">Become a part of the <span id="team-name-text">Selected Team</span> family by joining our fan club and receiving exclusive updates and benefits!</p>
        <form action="#" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="team_id" id="team_id" value="">
            <button type="submit" class="text-blue-600 mt-2 inline-block">Join Now</button>
        </form>
    </div>
</section>

<!-- Fan Feedback Form -->
<section class="fan-feedback py-10 bg-gray-100" id="fan-feedback">
    <h2 class="text-3xl font-bold text-center">We Value Your Feedback</h2>
    <div class="container mx-auto max-w-lg bg-white p-6 rounded-lg shadow-md mt-6">
    <form action="<?php echo e(route('feedback.store', ['team_id' => $team->id])); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="team_id" value="<?php echo e($team->id); ?>">

    <div class="mb-4">
        <label for="name" class="block text-gray-700 font-bold">Your Name</label>
        <input type="text" id="name" name="name" required class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
    </div>

    <div class="mb-4">
        <label for="email" class="block text-gray-700 font-bold">Your Email</label>
        <input type="email" id="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
    </div>

    <div class="mb-4">
        <label for="message" class="block text-gray-700 font-bold">Your Feedback</label>
        <textarea id="message" name="message" rows="4" required class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300"></textarea>
    </div>

    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-800 transition">Submit Feedback</button>
</form>

    </div>
</section>




<!-- Player Stats Section 
<section class="player-stats py-10 bg-gray-100" id="player-stats">
    <h2 class="text-3xl font-bold text-center">Player Stats</h2>
    <div class="container mx-auto text-center mt-6">
        <p class="text-lg">See the performance stats for your favorite players including goals scored, assists, and more...</p>
    </div>
</section>-->

<!-- Social Media Section -->
<section class="social-media py-10 bg-gray-900 text-white">
    <div class="container mx-auto text-center">
        <h3 class="text-2xl font-bold">Follow Us</h3>
        <div class="mt-4">
            <a href="#" class="text-blue-500 mx-2">Facebook</a>
            <a href="#" class="text-blue-400 mx-2">Twitter</a>
            <a href="#" class="text-red-500 mx-2">Instagram</a>
            <a href="#" class="text-blue-600 mx-2">YouTube</a>
        </div>
    </div>
</section>




<!-- Contact Section -->
<section class="contact py-10 bg-gray-50" id="contact">
    <h2 class="text-3xl font-bold text-center">Contact Us</h2>
    <div class="container mx-auto text-center mt-6">
        <p class="text-lg">Got a question or comment? Reach out to the team.</p>
        <a href="mailto:info@realmadrid.com" class="text-blue-600 mt-2 inline-block">Contact Us</a>
    </div>
</section>



<script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
<script>
    document.getElementById('menu-btn').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
<script>
    function updateTeam() {
        var selectedTeam = document.getElementById("team").value;
        document.getElementById("team-name").innerText = selectedTeam ? selectedTeam : "Selected Team";
        document.getElementById("team-name-text").innerText = selectedTeam ? selectedTeam : "Selected Team";
        document.getElementById("team_id").value = selectedTeam;
    }
</script>
</body>
</html><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/welcome.blade.php ENDPATH**/ ?>