<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rwandan Premier League Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    


    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #343a40;
            padding-top: 20px;
            height: 100vh; /* Make the sidebar take full height of the screen */
            overflow-y: auto; /* Enable vertical scrolling */
        }

        .sidebar .team-logo {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            margin-bottom: 10px;
            margin-left:3rem;
        }
        .sidebar a {
            color: white;
            padding: 10px;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        .sidebar a:hover {
            background-color: #575757;
        }
        .sidebar a i {
            margin-right: 10px;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
        }
        .navbar {
            margin-left: 250px;
            z-index: 1000;
        }
        .search-bar {
            margin-left: 250px;
            padding: 10px 20px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
            position: relative;
        }
        .search-results {
            position: absolute;
            top: 55px;
            left: 0;
            width: 100%;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            overflow-y: auto;
            max-height: 300px;
        }
        .search-result-item {
            padding: 10px;
            border-bottom: 1px solid #f1f1f1;
            cursor: pointer;
        }
        .search-result-item:last-child {
            border-bottom: none;
        }
        .search-result-item:hover {
            background-color: #f8f9fa;
        }

        .card {
    border-radius: 12px;
}

.card-body {
    padding: 20px;
    text-align: center;
}

.rounded-circle {
    border: 2px solid #ddd;
}

p {
    font-size: 14px;
    margin: 0;
}



        
    </style>
</head>
<body>



<!-- Search Bar -->
<div class="search-bar">
    <form id="searchForm">
        <div class="input-group">
            <input class="form-control" type="search" id="searchInput" placeholder="Search..." aria-label="Search">
            <button class="btn btn-outline-primary" type="button" id="searchButton">
                <i class="fas fa-search"></i>
            </button>
        </div>
        <div id="searchResults" class="search-results"></div>
    </form>
</div>



<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#" style="margin-left:5rem;">RPL Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-user-circle"></i> Profile</a>
                </li>
                <li class="nav-item">
                        <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                            <button type="submit" class="nav-link btn btn-link text-danger">
                               <i class="fas fa-sign-out-alt"></i> Logout
                             </button>
                       </form>
                   </li>

            </ul>
        </div>
    </div>
</nav>


<?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>



<div class="d-flex">
    
    <!-- Sidebar -->
    <div class="sidebar">
    <img src="<?php echo e(asset('storage/logos/ferwafa.jpg')); ?>" alt="ferwafa" class="team-logo">
        <h3 class="text-white text-center" style="font-size:20px; margin-bottom:30px;">Welcome, Admin!</h3>
        <a href="<?php echo e(route('dashboard')); ?>"><i class="fas fa-home"></i> Dashboard</a>
        <a href="<?php echo e(route('standings.index')); ?>"><i class="fas fa-trophy"></i> League Standings</a>
        <a href="<?php echo e(route('teams.index')); ?>"><i class="fas fa-users"></i> Teams</a>
        <a href="<?php echo e(route('matches.index')); ?>"><i class="fas fa-futbol"></i> Matches</a>
        <!--<a href="<?php echo e(route('financials.index')); ?>"><i class="fas fa-dollar-sign"></i> Financials</a>-->
        <a href="<?php echo e(route('announcements.index')); ?>"><i class="fas fa-bullhorn"></i> Announcements</a>
        <a href="<?php echo e(route('stadiums.index')); ?>"><i class="fas fa-building"></i> Stadiums</a>
        <a href="<?php echo e(route('referees.index')); ?>">    <i class="fas fa-user-tie"></i> Referees</a>
        <a href="<?php echo e(route('match_commissioners.index')); ?>"><i class="fas fa-user-shield"></i> Match Commissioners</a>
        <a href="<?php echo e(route('match_categories.index')); ?>"><i class="fas fa-tags"></i> Match Categories</a>
        <a href="<?php echo e(route('admin.players')); ?>"><i class="fas fa-user-circle"></i> All Players</a>
        <a href="<?php echo e(route('Windowtransfers.index')); ?>"><i class="fas fa-exchange-alt"></i> <span>Transfers</span></a>
        <a href="<?php echo e(route('admin.sponsors')); ?>"><i class="fas fa-handshake"></i> Sponsors</a>
        <!--<a href="<?php echo e(route('fixtures.index')); ?>"><i class="fas fa-calendar-alt"></i> Fixtures</a>-->
        <!--<a href="<?php echo e(route('tickets.index')); ?>"><i class="fas fa-ticket-alt"></i> Tickets</a>-->
        <a href="<?php echo e(route('users.index')); ?>"><i class="fas fa-user"></i> Users</a>
        <a href="<?php echo e(route('punishments.index')); ?>"><i class="fas fa-gavel"></i> Punishments</a>
        <a href="<?php echo e(route('goals.index')); ?>"><i class="fas fa-bolt"></i> <span>Match Events</span></a>
        <a href="<?php echo e(route('results.index')); ?>"><i class="fas fa-trophy"></i> <span>Match Results</span></a>
        <a href="<?php echo e(route('reports.index')); ?>" style="margin-bottom:7rem;"><i class="fas fa-chart-line"></i> Reports</a> 
        
    </div>
</div>


    <!-- Content Area -->
    <div class="content">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');

        searchInput.addEventListener('input', () => {
            const query = searchInput.value.trim();
            if (!query) {
                searchResults.innerHTML = '';
                return;
            }

            fetch(`/search?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    searchResults.innerHTML = data.map(result => `
                        <div class="search-result-item">
                            <a href="${result.url}" class="d-block text-dark">
                                <strong>${result.title}</strong><br>
                                <small>${result.description}</small>
                            </a>
                        </div>
                    `).join('');
                })
                .catch(error => {
                    searchResults.innerHTML = '<p>Error fetching results.</p>';
                    console.error('Error:', error);
                });
        });
    });
</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/layouts/app.blade.php ENDPATH**/ ?>