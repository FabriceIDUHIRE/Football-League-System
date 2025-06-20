<!DOCTYPE html>
<html lang="en">
<head>
    <title>RPL Team Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
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
            background: #f4f4f4;
        }
        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset("storage/logos/soccer-player.jpeg") }}');
            background-size: cover;
            background-position: center;
            opacity: 0.3;
            z-index: 0;
        }
        .wrap-login100 {
            background: rgba(255, 255, 255, 0.95);
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
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
            height: 80px;
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
        .alert {
            text-align: center;
            font-size: 14px;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="background-image"></div>
    <div class="wrap-login100">
        <form class="login100-form" method="POST" action="{{ route('team.login.submit') }}">
            @csrf
            <span class="login100-form-logo">
                <i class="fas fa-shield-alt"></i>
            </span>

            <span class="login100-form-title">Team Login</span>

            <!-- ✅ Show success message after logout -->
            @if(session('success'))
                <div class="alert alert-success" id="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <!-- ✅ Show error messages dynamically -->
            @if($errors->any())
                <div class="alert alert-danger" id="error-message">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <input class="input100" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
            </div>
            <div>
                <input class="input100" type="password" name="password" placeholder="Password" required>
            </div>

            <label>
                <input type="checkbox" name="remember"> Remember Me
            </label>

            <div>
                <button class="login100-form-btn" type="submit">Login</button>
            </div>

            <!-- ✅ Link to Forgot Password -->
            <a class="txt1" href="{{ route('password.request') }}">Forgot Password?</a>
        </form>
    </div>

    <!-- ✅ JavaScript to Auto-Dismiss Messages -->
    <script>
        setTimeout(() => {
            let successMessage = document.getElementById('success-message');
            let errorMessage = document.getElementById('error-message');
            if (successMessage) successMessage.style.display = 'none';
            if (errorMessage) errorMessage.style.display = 'none';
        }, 5000); // ✅ Hide messages after 5 seconds
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
