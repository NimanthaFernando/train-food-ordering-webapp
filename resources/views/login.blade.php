<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Eats - Login</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <style>
        .body {
            background-image: url('{{ asset('images/login.jpeg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
        }
        .container {
            text-align: center;
            padding-top: 20px;
            font-size: large;
        }
        .wrap {
            background: rgba(255, 255, 255, 0.9);
            max-width: 400px;
            margin: auto;
            margin-top: 10px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 0px 10px 2px rgba(0,0,0,0.2);
        }
        input[type=email], input[type=password] {
            width: 100%;
            box-sizing: border-box;
            padding: 12px 15px;
            margin: 10px 0;
            background: rgba(0,0,0,0.05);
            border: none;
            border-radius: 8px;
            font-weight: bold;
            color: #333;
        }
        input[type=submit] {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background: linear-gradient(to right, #ff105f, #ffad06);
            border: none;
            border-radius: 30px;
            font-size: 18px;
            font-weight: bold;
            color: #fff;
            cursor: pointer;
            transition: login 0.5s;
        }
        input[type=submit]:hover {
            background: linear-gradient(to left, #ff105f, #ffad06);
        }
        h1, h2 {
            font-weight: bold;
        }
        .forgot-password {
            text-align: right;
            font-size: 14px;
            margin-top: -2px;
            margin-bottom: 10px;
        }
        .forgot-password a {
            color: #007bff;
            text-decoration: none;
        }
        .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>TRAIN EATS</h1>
    <h2>Order your favorite meals while traveling!</h2>
    <div class="wrap">
        <h2>Login</h2>
        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>

            <div class="forgot-password">
                <a href="{{ route('password.request') }}">Forgot Password?</a>
            </div>

            <input type="submit" value="Login">
            <h5>Don't Have an Account? <a href="{{ route('signup') }}">Sign Up</a></h5>
        </form>
    </div>
</div>
</body>
</html>
