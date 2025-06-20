

<?php $__env->startSection('content'); ?>

<head>
    <!-- jQuery, Bootstrap, and FontAwesome -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Match Lineup Setup</h2>

    <!-- Match Selection -->
    <form id="matchForm" class="mb-4">
        <label for="match" class="form-label">Select Match:</label>
        <select id="match" name="match_id" class="form-select">
            <option value="">-- Choose a Match --</option>
            <?php $__currentLoopData = $matches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $match): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($match->id); ?>"><?php echo e($match->homeTeam->name); ?> vs <?php echo e($match->awayTeam->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </form>

    <!-- Lineup Form (Hidden Initially) -->
    <div id="lineupForm" class="mt-4" style="display: none;">
        <form action="<?php echo e(route('lineup.store')); ?>" method="POST" class="shadow p-4 rounded border">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="match_id" id="selectedMatch">

            <div class="mb-3">
                <label for="formation" class="form-label">Formation:</label>
                <select name="formation" class="form-select">
                    <option value="4-4-2">4-4-2</option>
                    <option value="4-3-3">4-3-3</option>
                    <option value="3-5-2">3-5-2</option>
                    <option value="4-2-3-1">4-2-3-1</option>
                </select>
            </div>

            <div class="row">
                <!-- Starting 11 -->
                <div class="col-md-4 mb-3">
                    <label for="starting11" class="form-label">Starting 11:</label>
                    <select id="starting11" name="players[starting][]" class="form-select" multiple size="6">
                        <?php $__currentLoopData = $players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($player->id); ?>"><?php echo e($player->name); ?> - <?php echo e($player->position); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <button type="button" id="moveToSubstitutes" class="btn btn-warning w-100 mt-2">Move to Substitutes</button>
                </div>

                <!-- Substitutes -->
                <div class="col-md-4 mb-3">
                    <label for="substitutes" class="form-label">Substitutes:</label>
                    <select id="substitutes" name="players[substitute][]" class="form-select" multiple size="6">
                        <?php $__currentLoopData = $players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($player->id); ?>"><?php echo e($player->name); ?> - <?php echo e($player->position); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <button type="button" id="moveToStarting11" class="btn btn-warning w-100 mt-2">Move to Starting 11</button>
                    <button type="button" id="removeFromSubstitutes" class="btn btn-danger w-100 mt-2">Remove from Substitutes</button>
                </div>

                <!-- Players Not Selected -->
                <div class="col-md-4 mb-3">
                    <label for="notSelected" class="form-label">Not Selected:</label>
                    <select id="notSelected" class="form-select" multiple size="6">
                        <?php $__currentLoopData = $players; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($player->id); ?>"><?php echo e($player->name); ?> - <?php echo e($player->position); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <button type="button" id="removePlayer" class="btn btn-danger w-100 mt-2">Remove</button>
                </div>
            </div>

            <button type="submit" class="btn btn-success w-auto mt-3">Submit Lineup</button>
        </form>
    </div>

    <!-- Display Stored Lineups -->
    <div class="mt-5">
    <?php $__currentLoopData = $lineups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lineup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($lineup->team_id == $team->id): ?> <!-- Check if the lineup belongs to the current team -->
        <div class="card mb-3 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Lineup for: <?php echo e($lineup->match->homeTeam->name); ?> vs <?php echo e($lineup->match->awayTeam->name); ?></span>
                <button class="btn btn-sm btn-primary toggle-lineup">View Details</button>
            </div>
            <div class="card-body">
                <h5 class="card-title">Formation: <?php echo e($lineup->formation); ?></h5>
                <div class="lineup-details d-none">
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h6>Starting 11:</h6>
                            <ul>
                                <?php $__currentLoopData = $lineup->players->where('pivot.position_type', 'Starting'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($player->name); ?> - <?php echo e($player->position); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6>Substitutes:</h6>
                            <ul>
                                <?php $__currentLoopData = $lineup->players->where('pivot.position_type', 'Substitute'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $player): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($player->name); ?> - <?php echo e($player->position); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

</div>

<script>
    $(document).ready(function() {
        // Toggle lineup details visibility
        $('.toggle-lineup').on('click', function() {
            var details = $(this).closest('.card').find('.lineup-details');
            details.toggleClass('d-none');
            // Change the button text when toggling
            if (details.hasClass('d-none')) {
                $(this).text('View Details');
            } else {
                $(this).text('Hide Details');
            }
        });
    });

    document.querySelector("form[action='<?php echo e(route('lineup.store')); ?>']").addEventListener("submit", function (e) {
        let starting11 = document.getElementById("starting11");
        if (starting11.selectedOptions.length < 11) {
            e.preventDefault(); // Prevent form submission
            alert("You must select exactly 11 players for the Starting 11.");
        }
    });

    document.addEventListener("DOMContentLoaded", function () {
        // Show lineup form when a match is selected
        document.getElementById("match").addEventListener("change", function () {
            let matchId = this.value;
            let lineupForm = document.getElementById("lineupForm");
            let selectedMatch = document.getElementById("selectedMatch");
            let matchForm = document.getElementById("matchForm");

            if (matchId) {
                lineupForm.style.display = "block";
                selectedMatch.value = matchId;
            } else {
                lineupForm.style.display = "none";
                matchForm.reset();  // Reset the match form when no match is selected
            }
        });

        // Move players manually between sections
        document.getElementById("moveToSubstitutes").addEventListener("click", function () {
            movePlayers("starting11", "substitutes");
            updateSubstitutesVisibility(); // Update visibility of substitutes
        });

        document.getElementById("moveToStarting11").addEventListener("click", function () {
            movePlayers("substitutes", "starting11");
            updateSubstitutesVisibility(); // Update visibility of substitutes
        });

        // Remove players from Substitutes to Not Selected
        document.getElementById("removeFromSubstitutes").addEventListener("click", function () {
            movePlayers("substitutes", "notSelected");
            updateNotSelectedVisibility(); // Update visibility
            updateSubstitutesVisibility(); // Update substitutes visibility
        });

        // Remove players from "Not Selected"
        document.getElementById("removePlayer").addEventListener("click", function () {
            removePlayers("notSelected");
            updateNotSelectedVisibility(); // Update visibility
        });

        // Initial check on page load
        updateNotSelectedVisibility();
        updateSubstitutesVisibility(); // Ensure the substitutes section is correctly displayed on load
    });

    // Function to move selected players between lists
    function movePlayers(fromId, toId) {
        let fromList = document.getElementById(fromId);
        let toList = document.getElementById(toId);

        let selectedPlayers = Array.from(fromList.selectedOptions);
        selectedPlayers.forEach(player => {
            toList.appendChild(player);
        });
    }

    // Function to remove selected players from a list
    function removePlayers(listId) {
        let list = document.getElementById(listId);
        let selectedPlayers = Array.from(list.selectedOptions);

        selectedPlayers.forEach(player => {
            player.remove();
        });
    }

    // Function to update visibility of "Not Selected" section
    function updateNotSelectedVisibility() {
        let notSelectedList = document.getElementById("notSelected");
        let removeButton = document.getElementById("removePlayer");

        // Hide the "Remove" button if there are no players in "Not Selected"
        if (notSelectedList.options.length === 0) {
            removeButton.style.display = "none";
        } else {
            removeButton.style.display = "block";
        }
    }

    // Function to update visibility of "Substitutes" section
    function updateSubstitutesVisibility() {
        let substitutesList = document.getElementById("substitutes");
        let moveToStarting11Button = document.getElementById("moveToStarting11");

        // Hide the "Move to Starting 11" button if there are no players in "Substitutes"
        if (substitutesList.options.length === 0) {
            moveToStarting11Button.style.display = "none";
        } else {
            moveToStarting11Button.style.display = "block";
        }
    }

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.team_dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/lineup/index.blade.php ENDPATH**/ ?>