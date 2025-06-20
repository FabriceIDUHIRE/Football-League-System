<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NewPerformanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\FixtureController;
use App\Http\Controllers\FinancialController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\StadiumController;
use App\Http\Controllers\RefereeController;
use App\Http\Controllers\MatchCategoryController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StandingsController;
use App\Http\Controllers\TeamAuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TeamDashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PunishmentController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PlayerPerformanceController;
use App\Http\Controllers\SelectController;
use App\Http\Controllers\TeamDetailsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MatchCommissionerController;
use App\Http\Controllers\LineupController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\InjuryController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\MatchResultController;
use App\Http\Controllers\TransferWindowController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\TeamMatchResultController;







Route::get('/test-time', function () {
    return [
        'Laravel timezone' => config('app.timezone'),
        'Now' => now()->toDateTimeString(),
        'Now in UTC' => now()->setTimezone('UTC')->toDateTimeString(),
        'Now in Kigali' => now()->setTimezone('Africa/Kigali')->toDateTimeString(),
    ];
});








Route::get('/session-check', function () {
    if (Auth::check()) {
        return 'Logged in as: ' . Auth::user()->email;
    } else {
        return 'Not logged in';
    }
});






/* Root route, redirect to the user login page by default
Route::get('/', function () {
    return redirect()->route('users.login'); // ✅ Default to user login
});
*/


// Team authentication routes
Route::middleware(['web'])->group(function () {
    Route::get('/team/login', [TeamAuthController::class, 'showLoginForm'])->name('team.login');
    Route::post('/team/login', [TeamAuthController::class, 'login'])->name('team.login.submit');
    Route::post('/team/logout', [TeamAuthController::class, 'logout'])->name('team.logout');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/match/{match}/edit', [MatchController::class, 'MatchEdit'])->name('match.edit');
    Route::put('/match/{match}', [MatchController::class, 'MatchUpdate'])->name('match.update');
    Route::delete('matches/{match}', [MatchController::class, 'destroy'])->name('match.destroy');
});




// Team Dashboard Route (only accessible if logged in)
Route::middleware(['auth:team'])->group(function () {
    Route::get('/team/dashboard', [TeamDashboardController::class, 'index'])->name('team.dashboard');
    Route::get('/team/profile', [TeamDashboardController::class, 'profile'])->name('team.profile');
    Route::put('/team/profile/update', [TeamDashboardController::class, 'update'])->name('team.profile.update');
    Route::get('/team/players', [TeamDashboardController::class, 'players'])->name('team.players');
    Route::get('/team/match/{id}', [MatchController::class, 'show'])->name('match.details');
    // Add route for editing match



    Route::get('/team/player/{id}/stats', [PlayerController::class, 'showStats'])->name('player.stats');
    // Other protected routes...
});

Route::middleware(['auth'])->group(function () {
    Route::get('/team/match-management', [TeamDashboardController::class, 'matchManagement'])
        ->name('team.match-management');
});


Route::get('/match/create', [MatchController::class, 'create'])->name('match.create');


Route::middleware(['auth:team'])->group(function () {
    Route::get('/team/doctor-management', [TeamDashboardController::class, 'doctorManagement'])->name('team.doctor-management');
});






// Password Reset Routes
Route::get('password/reset', function () {
    return view('auth.passwords.email'); // This is the forgot password form
})->name('password.request');

Route::post('password/email', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'resetPassword'])->name('password.update');




// Team Dashboard Routes without Authentication Middleware

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [TeamAuthController::class, 'dashboard']);
});




use App\Http\Controllers\LoanDealController;

Route::middleware(['auth'])->group(function () {
    Route::get('/loan-deals', [LoanDealController::class, 'index'])->name('loan-deals.index');
    Route::get('/loan-deals/create', [LoanDealController::class, 'create'])->name('loan-deals.create');
    Route::post('/loan-deals', [LoanDealController::class, 'createLoanDeal']);
    Route::delete('loan-deals/{id}', [LoanDealController::class, 'destroy'])->name('loan-deals.destroy');
    Route::put('loan-deals/{id}', [LoanDealController::class, 'update'])->name('loan-deals.update');

});








//Report

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');





Route::middleware('auth')->group(function () {
    // Define the route for managing doctors in the team
    Route::get('/team/standings', [TeamDashboardController::class, 'standings'])->name('team.standings');
    Route::get('team/doctor-management', [DoctorController::class, 'index'])->name('team.doctors');
    Route::post('/team/doctors', [DoctorController::class, 'store'])->name('doctors.store');
    Route::delete('/team/doctors/{doctor}', [DoctorController::class, 'destroy'])->name('doctors.destroy');
    Route::get('/doctors/{doctor}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');
    Route::put('/doctors/{id}', [DoctorController::class, 'update'])->name('doctors.update');

});





Route::middleware(['auth'])->group(function () {
Route::get('/team/profile', [TeamDashboardController::class, 'profile'])->name('team.profile');
Route::put('/team/profile/update', [TeamDashboardController::class, 'update'])->name('team.profile.update');
//Route::middleware('auth')->get('/team/profile', [TeamDashboardController::class, 'profile'])->name('team.profile');
//Route::middleware('auth')->put('/team/profile/update', [TeamDashboardController::class, 'update'])->name('team.profile.update');

Route::get('/team/matches', [MatchController::class, 'matches'])->name('team.matches');
Route::get('/team/fixtures', [MatchController::class, 'fixtures'])->name('fixtures');
Route::get('/team/player-management', [PlayerController::class, 'playerManagement'])->name('team.player-management');
Route::get('/team/players/{id}', [PlayerController::class, 'showPlayer'])->name('team.playerDetails');
Route::post('/players/store', [PlayerController::class, 'store'])->name('players.store');
Route::get('/team/sponsorship', [TeamDashboardController::class, 'sponsorship'])->name('team.sponsorship');
Route::get('/team/notifications', [TeamDashboardController::class, 'notifications'])->name('team.notifications');
Route::put('/team/players/{id}', [PlayerController::class, 'update'])->name('players.update');







Route::get('team/performance', [NewPerformanceController::class, 'index'])->name('team.performance');
Route::get('team/performance/edit/{id}', [NewPerformanceController::class, 'edit'])->name('performance.edit');
Route::put('team/performance/update/{id}', [NewPerformanceController::class, 'update'])->name('performance.update');


Route::get('/team/announcements', [TeamDashboardController::class, 'announcements'])->name('team.announcements');
Route::get('/team/announcement/{id}', [TeamDashboardController::class, 'show'])->name('announcement.show');

Route::get('/teams/staff', [StaffController::class, 'index'])->name('teams.staff');
Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
Route::put('/staff/{staff}', [StaffController::class, 'update'])->name('staff.update');
Route::delete('/staff/{staff}', [StaffController::class, 'destroy'])->name('staff.destroy');






Route::get('/team/player-performance', [PlayerPerformanceController::class, 'index'])->name('player-performance.index');
Route::post('/player-performance', [PlayerPerformanceController::class, 'store'])->name('player-performance.store');
Route::get('/team/player-performance', [PlayerPerformanceController::class, 'index'])->name('team.player-performance');
Route::delete('/player-performance/{id}', [PlayerPerformanceController::class, 'destroy'])->name('player-performance.delete');
Route::get('/team/player-performance/{id}/edit', [PlayerPerformanceController::class, 'edit'])->name('team.show-player-performance');




Route::get('/player-performance/{player}', [PlayerPerformanceController::class, 'show'])->name('player.show-player-performance');
});


// Team Dashboard Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/team/dashboard', [TeamDashboardController::class, 'index'])->name('team.dashboard');

    Route::get('/team/doctors', [DoctorController::class, 'index'])->name('team.doctor-management');
    Route::get('/team/doctors/create', [DoctorController::class, 'create'])->name('team.doctor-create');
    Route::post('/team/doctors/store', [DoctorController::class, 'store'])->name('team.doctor-store');
    Route::delete('doctor/{doctor}', [DoctorController::class, 'destroy'])->name('doctor.delete');

    Route::post('/team/logout', function () {
        Auth::logout();
        return redirect()->route('login');
    })->name('team.logout');
});




Route::middleware(['auth'])->group(function () {
Route::get('/team/security', [TeamDashboardController::class, 'security'])->name('team.security');
Route::get('/team/staff', [TeamDashboardController::class, 'staff'])->name('team.staff');
Route::get('/team/punishments', [TeamDashboardController::class, 'punishments'])->name('team.punishments');
Route::get('/team/announcements', [TeamDashboardController::class, 'announcements'])->name('team.announcements');

Route::get('/team/injuries', [TeamDashboardController::class, 'injuries'])->name('team.injuries');
});

//Magic Link
Route::post('/team/magic-login', [TeamAuthController::class, 'sendMagicLink'])->name('team.magic.login');
Route::get('/team/magic-login/{token}', [TeamAuthController::class, 'magicLogin']);




Route::middleware(['auth'])->group(function () {
//Teams Post
Route::get('/team/posts', [PostController::class, 'index'])->name('team.posts');
Route::get('/team/posts/create', [PostController::class, 'create'])->name('team.posts.create');
Route::post('/team/posts', [PostController::class, 'store'])->name('team.posts.store');
Route::get('/team/posts/{post}', [PostController::class, 'show'])->name('team.posts.show');
Route::get('/team/posts/{post}/edit', [PostController::class, 'edit'])->name('team.posts.edit');
Route::put('/team/posts/{post}', [PostController::class, 'update'])->name('team.posts.update');
Route::delete('/team/posts/{post}', [PostController::class, 'destroy'])->name('team.posts.destroy');
});







Route::middleware(['auth'])->group(function () {
Route::get('/All-players', [DashboardController::class, 'allPlayers'])->name('admin.players');
Route::get('/players/{id}', [DashboardController::class, 'showPlayer'])->name('players.show');

// Sponsors route
Route::get('/All-sponsors', [DashboardController::class, 'sponsorsIndex'])->name('admin.sponsors');
Route::get('/sponsors/{id}/edit', [DashboardController::class, 'edit'])->name('sponsors.edit');
Route::put('/sponsors/{id}', [DashboardController::class, 'update'])->name('sponsors.update');
Route::delete('/sponsors/{id}', [DashboardController::class, 'destroy'])->name('sponsors.destroy');
});



Route::middleware(['auth'])->group(function () {
Route::get('/team/sponsors', [TeamDashboardController::class, 'sponsorsIndex'])->name('team.sponsors');
Route::get('/team/sponsors', [TeamDashboardController::class, 'store'])->name('team.sponsors');
Route::get('/team/sponsors/{id}/edit', [SponsorController::class, 'edit'])->name('team-sponsors.edit');
Route::put('/team/sponsors/{id}', [SponsorController::class, 'update'])->name('team-sponsors.update');
Route::delete('/team/sponsors/{id}', [SponsorController::class, 'destroy'])->name('team-sponsors.destroy');


Route::get('/team/details/{id}', [MatchController::class, 'showDetails'])->name('team.details');
});

//TRANSFER WINDOW
// Admin routes for TransferWindowController
Route::get('/admin/transfers', [TransferWindowController::class, 'index'])->name('Windowtransfers.index');
Route::post('/admin/transfers/open', [TransferWindowController::class, 'open'])->name('transfers.open');
Route::post('/admin/transfers/close', [TransferWindowController::class, 'close'])->name('transfers.close');




use App\Http\Controllers\BidController;

Route::middleware(['auth'])->group(function () {
    Route::get('/bids', [BidController::class, 'index'])->name('bids.index');
    Route::get('/bids/create', [BidController::class, 'create'])->name('bids.create');
    Route::post('/bids', [BidController::class, 'store'])->name('bids.store');
    Route::post('/bids/{id}/accept', [BidController::class, 'accept'])->name('bids.accept');
    Route::post('/bids/{id}/reject', [BidController::class, 'reject'])->name('bids.reject');
    Route::put('/bids/{bid}/message', [BidController::class, 'updateMessage'])->name('bids.updateMessage');

});



Route::middleware(['auth'])->group(function () {
    Route::get('/team/match-results', [TeamMatchResultController::class, 'index'])->name('team.match-results');
    Route::get('/team/match-stats/{match_id}', [TeamMatchResultController::class, 'showStats'])->name('team.match-stats');

});







//TRANSFER PART
Route::middleware(['auth'])->group(function () {
    Route::get('/transfers', [TransferController::class, 'index'])->name('transfers.index');
    Route::get('/transfers/create', [TransferController::class, 'create'])->name('transfers.create');
    Route::post('/transfers', [TransferController::class, 'store'])->name('transfers.store');
    Route::get('/transfers/{transfer}', [TransferController::class, 'show']);
    Route::patch('/transfers/{id}/approve', [TransferController::class, 'approveTransfer'])->name('transfers.approve');
    Route::patch('/transfers/{id}/reject', [TransferController::class, 'rejectTransfer'])->name('transfers.reject');


});



Route::middleware(['auth'])->group(function () {
    Route::get('/injuries', [InjuryController::class, 'index'])->name('injuries.index');
    Route::post('/injuries', [InjuryController::class, 'store'])->name('injuries.store');
    Route::put('/injuries/{id}', [InjuryController::class, 'update'])->name('injuries.update');

});


// Contract page route
Route::middleware(['auth'])->group(function () {
    Route::get('/team/contracts', [ContractController::class, 'index'])->name('contracts.index');
    Route::get('/team/contracts/create', [ContractController::class, 'create'])->name('contracts.create');
    Route::post('/team/contracts', [ContractController::class, 'store'])->name('contracts.store');
    Route::get('/team/contracts/{contract}/edit', [ContractController::class, 'edit'])->name('contracts.edit');
    Route::put('/team/contracts/{contract}', [ContractController::class, 'update'])->name('contracts.update');
    Route::delete('/team/contracts/{contract}', [ContractController::class, 'destroy'])->name('contracts.destroy');
    Route::post('contracts/{contract}/terminate', [ContractController::class, 'terminate'])->name('contracts.terminate');

});


//GOALS PART
Route::middleware('auth')->group(function () {
    // Routes that require authentication

    // Display all goals
    Route::get('/goals', [GoalController::class, 'index'])->name('goals.index');
    
    // Store a new goal
    Route::post('/goals', [GoalController::class, 'store'])->name('goals.store');
    
    // Delete a goal
    Route::delete('/goals/{goal}', [GoalController::class, 'destroy'])->name('goals.destroy');
    
    // Update a goal
    Route::put('/goals/{goal}', [GoalController::class, 'update'])->name('goals.update');
    
    // Get players based on team ID
    Route::get('/get-players/{teamId}', [GoalController::class, 'getPlayers']);
    
    // Get players for a specific team
    Route::get('/players/{teamId}', function($teamId) {
        $players = \App\Models\Player::where('team_id', $teamId)->get();
        return response()->json(['players' => $players]);
    });

    // Edit a goal (Edit page)
    Route::get('/goals/{goal}/edit', [GoalController::class, 'edit'])->name('goals.edit');
});



Route::middleware('auth')->group(function () {
//LINE-UP 
Route::get('/team/lineup', [LineupController::class, 'index'])->name('lineup.index');
Route::post('/team/lineup/store', [LineupController::class, 'store'])->name('lineup.store');
Route::get('/team/lineup/{match_id}', [LineupController::class, 'show'])->name('lineup.show');


//MATCH RESULT
Route::get('/results', [MatchResultController::class, 'index'])->name('results.index');
});



// Login routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware('auth')->group(function () {
// Admin Dashboard Route with Middleware
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});


Route::middleware('auth')->group(function () {
// In your routes/web.php
Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});





// Resource routes
Route::resource('teams', TeamController::class);
Route::resource('matches', MatchController::class);
Route::resource('stadiums', StadiumController::class);
Route::resource('tickets', TicketController::class);
Route::resource('financials', FinancialController::class);
Route::resource('announcements', AnnouncementController::class);
Route::resource('sponsors', SponsorController::class);
Route::resource('referees', RefereeController::class);
Route::resource('match_categories', MatchCategoryController::class);
Route::resource('fixtures', FixtureController::class);
Route::resource('players', PlayerController::class);
Route::resource('teams.doctors', DoctorController::class);
Route::resource('teams.notifications', NotificationController::class);
Route::resource('users', UserController::class);
Route::resource('punishments', PunishmentController::class);
Route::resource('doctor', DoctorController::class);
Route::resource('player-performance', PlayerPerformanceController::class);
Route::resource('posts', PostController::class);
Route::resource('match-results', MatchResultController::class);
Route::resource('match_commissioners', MatchCommissionerController::class);
Route::resource('transfers', TransferController::class);
Route::resource('injuries', InjuryController::class); 

Route::resource('goals', GoalController::class);






Route::get('/select-team', [SelectController::class, 'index'])->name('select.team');
Route::get('/team/{teamId}', [SelectController::class, 'show'])->name('team.show');



Route::get('/feedback', [FeedbackController::class, 'index'])->name('team.feedback');
Route::post('/team/feedback', [FeedbackController::class, 'store'])->name('feedback.store'); // Store feedback
Route::get('/feedback/{id}', [FeedbackController::class, 'show'])->name('feedback.show');
use App\Http\Controllers\TeamReportController;

    Route::get('/team/{id}/report', [TeamReportController::class, 'index'])->name('team.report');
Route::get('/team/{id}/report/download', [TeamReportController::class, 'downloadReport'])->name('team.report.download');
















Route::middleware('auth')->group(function () {
// Other routes
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/standings', [StandingsController::class, 'index'])->name('standings.index');
Route::post('/managers', [ManagerController::class, 'store'])->name('managers.store');


//PUNISHMENTS
Route::get('/punishments', [PunishmentController::class, 'index'])->name('punishments.index');
Route::get('punishments/{punishment}/edit', [PunishmentController::class, 'edit'])->name('punishments.edit');
Route::post('/punishments', [PunishmentController::class, 'store'])->name('punishments.store');
Route::put('punishments/{punishment}/terminate', [PunishmentController::class, 'terminate'])->name('punishments.terminate');
Route::put('punishments/{id}/terminate', [PunishmentController::class, 'terminate'])->name('punishments.terminate'); // For terminating punishment
Route::delete('punishments/{id}', [PunishmentController::class, 'destroy'])->name('punishments.destroy'); // For deleting punishment

//USERS
Route::post('/users/{id}/block', [UserController::class, 'block'])->name('users.block');
Route::post('/users/{id}/unblock', [UserController::class, 'unblock'])->name('users.unblock');
Route::put('/users/{id}/update-password', [UserController::class, 'updatePassword'])->name('users.updatePassword');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
});