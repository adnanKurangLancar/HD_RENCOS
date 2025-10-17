<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">

    {{-- Font & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>

    <div class="register-container">
        <button class="close-btn" onclick="window.history.back()">×</button>
        <h2>Register</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-group">
                <i class="ri-user-3-line"></i>
                <input type="text" name="name" placeholder="Full Name" required>
            </div>

            <div class="input-group">
                <i class="ri-mail-line"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="input-group">
                <i class="ri-phone-line"></i>
                <input type="tel" name="phone" placeholder="Phone Number" required>
            </div>

            <div class="input-group">
                <i class="ri-lock-2-line"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="input-group">
                <i class="ri-lock-password-line"></i>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
            </div>

            <button type="submit" class="register-btn">Register</button>

            <p class="login-text">
                Already have an account? <a href="{{ route('login.form') }}">Login</a>
            </p>
        </form>
    </div>

</body>
</html>
