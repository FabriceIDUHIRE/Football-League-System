<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Rwandan Premier League</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://source.unsplash.com/1600x900/?stadium,football') no-repeat center center/cover;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(15px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
            border-radius: 16px;
            transition: all 0.4s ease;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .glass-card:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.6);
        }
        .btn-glow {
            background: linear-gradient(to right, #ff416c, #ff4b2b);
            transition: 0.3s;
            box-shadow: 0 4px 15px rgba(255, 65, 108, 0.5);
        }
        .btn-glow:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(255, 65, 108, 0.8);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-center items-center text-white">
    
    <div class="text-center mb-12">
        <h1 class="text-5xl font-extrabold mb-4 animate-pulse">🏆 Welcome to Rwandan Premier League</h1>
        <p class="text-lg text-gray-300">Choose your favorite team and stay connected to every moment!</p>
    </div>

    <div class="container mx-auto flex flex-wrap justify-center gap-8">
        <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="glass-card p-8 text-center w-80 transform transition duration-500 hover:scale-105">
            <img src="<?php echo e(asset('storage/' . $team->logo)); ?>" alt="<?php echo e($team->name); ?>" class="w-32 h-32 mx-auto rounded-full border-4 border-white shadow-lg">
            <h2 class="text-2xl font-bold mt-4 text-gray-900"><?php echo e($team->name); ?></h2>
            <p class="text-gray-700 italic mb-4"><?php echo e($team->city); ?></p>
            
            <!-- Updated Link to Show Team Details -->
            <a href="<?php echo e(route('team.show', ['teamId' => $team->id])); ?>" class="text-blue-600 font-bold text-lg hover:text-blue-800">Select Your Team</a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/select_team.blade.php ENDPATH**/ ?>