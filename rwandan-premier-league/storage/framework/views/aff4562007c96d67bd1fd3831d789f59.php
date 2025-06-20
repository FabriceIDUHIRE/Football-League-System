

<?php $__env->startSection('content'); ?>
<div class="container">
    <h3>Edit Match</h3>

    <!-- Display Errors -->
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <strong>Whoops! Something went wrong:</strong>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('matches.update', $match->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- Match Date -->
        <div class="form-group">
            <label for="match_date">Match Date</label>
            <input 
                type="datetime-local" 
                name="match_date" 
                id="match_date" 
                class="form-control" 
                value="<?php echo e(old('match_date', $match->match_date instanceof \Carbon\Carbon ? $match->match_date->format('Y-m-d\TH:i') : $match->match_date)); ?>">
        </div>

        <!-- Stadium -->
        <div class="form-group">
            <label for="stadium_id">Stadium</label>
            <select name="stadium_id" id="stadium_id" class="form-control">
                <?php $__currentLoopData = $stadiums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stadium): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($stadium->id); ?>" <?php echo e($match->stadium_id == $stadium->id ? 'selected' : ''); ?>>
                        <?php echo e($stadium->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Referee -->
        <div class="form-group">
            <label for="referee_id">Referee</label>
            <select name="referee_id" id="referee_id" class="form-control">
                <?php $__currentLoopData = $referees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($referee->id); ?>" <?php echo e($match->referee_id == $referee->id ? 'selected' : ''); ?>>
                        <?php echo e($referee->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Assistant Referee 1 -->
        <div class="form-group">
            <label for="assistant_referee1_id">Assistant Referee 1</label>
            <select name="assistant_referee1_id" id="assistant_referee1_id" class="form-control">
                <?php $__currentLoopData = $referees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($referee->id); ?>" <?php echo e($match->assistant_referee1_id == $referee->id ? 'selected' : ''); ?>>
                        <?php echo e($referee->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Assistant Referee 2 -->
        <div class="form-group">
            <label for="assistant_referee2_id">Assistant Referee 2</label>
            <select name="assistant_referee2_id" id="assistant_referee2_id" class="form-control">
                <?php $__currentLoopData = $referees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($referee->id); ?>" <?php echo e($match->assistant_referee2_id == $referee->id ? 'selected' : ''); ?>>
                        <?php echo e($referee->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Fourth Referee -->
        <div class="form-group">
            <label for="fourth_referee_id">Fourth Referee</label>
            <select name="fourth_referee_id" id="fourth_referee_id" class="form-control">
                <?php $__currentLoopData = $referees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($referee->id); ?>" <?php echo e($match->fourth_referee_id == $referee->id ? 'selected' : ''); ?>>
                        <?php echo e($referee->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Match Commissioner -->
        <div class="form-group">
            <label for="match_commissioner_id">Match Commissioner</label>
            <select name="match_commissioner_id" id="match_commissioner_id" class="form-control">
                <?php $__currentLoopData = $commissioners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commissioner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($commissioner->id); ?>" <?php echo e($match->match_commissioner_id == $commissioner->id ? 'selected' : ''); ?>>
                        <?php echo e($commissioner->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Home Team -->
        <div class="form-group">
            <label for="home_team_id">Home Team</label>
            <select name="home_team_id" id="home_team_id" class="form-control">
                <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($team->id); ?>" <?php echo e($match->home_team_id == $team->id ? 'selected' : ''); ?>>
                        <?php echo e($team->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Away Team -->
        <div class="form-group">
            <label for="away_team_id">Away Team</label>
            <select name="away_team_id" id="away_team_id" class="form-control">
                <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($team->id); ?>" <?php echo e($match->away_team_id == $team->id ? 'selected' : ''); ?>>
                        <?php echo e($team->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Match Category -->
        <div class="form-group">
            <label for="category_id">Match Category</label>
            <select name="category_id" id="category_id" class="form-control">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php echo e($match->match_category_id == $category->id ? 'selected' : ''); ?>>
                        <?php echo e($category->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Submit Button -->
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Update Match</button>
        </div>

    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/matches/edit.blade.php ENDPATH**/ ?>