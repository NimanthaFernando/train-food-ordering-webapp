<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Train Eats - Reset Password</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}" />
    <style>
        body {
            background-image: url('{{ asset('images/forgetpassword.png') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            margin: 60px auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.25);
        }
        h2 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 25px;
            color: #333;
        }
        label {
            font-weight: 600;
            color: #555;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0 20px 0;
            border: none;
            border-radius: 8px;
            background: #f1f1f1;
            font-weight: bold;
            color: #333;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background: linear-gradient(to right, #ff105f, #ffad06);
            border: none;
            border-radius: 30px;
            font-size: 18px;
            font-weight: bold;
            color: #fff;
            cursor: pointer;
            transition: background 0.4s ease;
        }
        input[type="submit"]:hover {
            background: linear-gradient(to left, #ff105f, #ffad06);
        }
        .alert {
            margin-bottom: 20px;
        }
        .text-center a {
            color: #ff105f;
            font-weight: 600;
            text-decoration: none;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Reset Password</h2>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('password.reset.simple') }}" method="POST">
        @csrf
        <label for="email">Email Address</label>
        <input id="email" type="email" name="email" required placeholder="Enter your email" />

        <label for="password">New Password</label>
        <input id="password" type="password" name="password" required placeholder="New password" />

        <label for="password_confirmation">Confirm New Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Confirm password" />

        <input type="submit" value="Reset Password" />
    </form>

    <p class="text-center mt-3">
        Remember your password? <a href="{{ route('login') }}">Login here</a>
    </p>
</div>
</body>
</html>
