<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Font Awesome CDN -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<style>
		body {
			margin: 0;
			height: 100vh;
			display: flex;
			justify-content: center;
			align-items: center;
			font-family: 'Arial', sans-serif;
			overflow: hidden;
		}

		/* Background image container */
		.background-image {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-image: url('<?php echo e(asset('storage/logos/soccer-player.jpeg')); ?>');
			background-size: cover;
			background-position: center;
			opacity: 0.5; /* Adjust the opacity here */
			z-index: 0;
		}

		.wrap-login100 {
			background: rgba(255, 255, 255, 0.9);
			padding: 30px;
			border-radius: 15px;
			box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
			width: 100%;
			max-width: 400px;
			z-index: 1;
			position: relative;
		}

		.login100-form-logo {
			font-size: 60px;
			color: #4e54c8;
			display: flex; /* Flexbox for centering */
			justify-content: center; /* Horizontal centering */
			align-items: center; /* Vertical centering */
			margin-bottom: 20px; /* Space below the logo */
			height: 80px; /* Add a specific height for vertical centering */
		}

		.login100-form-title {
			font-size: 24px;
			text-align: center;
			margin-bottom: 20px;
			color: #333;
			font-weight: bold;
		}

		.input100 {
			border: 1px solid #ccc;
			border-radius: 25px;
			padding: 10px 20px;
			width: 100%;
			margin-bottom: 15px;
		}

		.login100-form-btn {
			background-color: #4e54c8;
			color: white;
			border: none;
			border-radius: 25px;
			padding: 10px 20px;
			width: 100%;
			font-weight: bold;
			transition: 0.3s;
			margin-top: 2rem;
		}

		.login100-form-btn:hover {
			background-color: #8f94fb;
			box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
		}

		.txt1 {
			font-size: 14px;
			text-align: center;
			display: block;
			margin-top: 15px;
			color: #666;
		}

		.txt1:hover {
			color: #4e54c8;
			text-decoration: underline;
		}

		.error-message {
			color: red;
			font-size: 14px;
			margin-top: 10px;
		}
	</style>
</head>
<body>
	<!-- Background image -->
	<div class="background-image"></div>

	<!-- Login form -->
	<div class="wrap-login100">
		<form class="login100-form" method="POST" action="<?php echo e(route('login.submit')); ?>">
			<?php echo csrf_field(); ?>
			<span class="login100-form-logo">
				<i class="fas fa-user-circle"></i>
			</span>

			<span class="login100-form-title">Log in</span>

			<!-- Email Field -->
			<div>
				<input class="input100" type="email" name="email" placeholder="Email Address" required>
			</div>

			<!-- Password Field -->
			<div>
				<input class="input100" type="password" name="password" placeholder="Password" required>
			</div>

			<!-- Remember me Checkbox -->
			<div>
				<input class="form-check-input" type="checkbox" name="remember" id="remember">
				<label class="form-check-label" for="remember">Remember me</label>
			</div>

			<!-- Error Messages -->
			<?php if($errors->any()): ?>
				<div class="error-message">
					<ul>
						<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li><?php echo e($error); ?></li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
				</div>
			<?php endif; ?>

			<!-- Submit Button -->
			<div>
				<button class="login100-form-btn" type="submit">Login</button>
			</div>

			
		</form>
	</div>

	<!-- Bootstrap JS and Dependencies -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\rwandan-premier-league\resources\views/auth/login.blade.php ENDPATH**/ ?>