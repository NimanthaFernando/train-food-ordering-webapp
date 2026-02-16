
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: linear-gradient(rgba(170, 169, 169, 0.8), rgba(0, 0, 0, 0.8)), url('{{ asset('images/signup.webp') }}');
            background-repeat: no-repeat;    
            background-size: cover;
            box-sizing: border-box;
            height: 100vh;
        }
        a {
            text-decoration: none;
        }
        a:hover {
            text-decoration: none;
        }
        .wrap {
            top: 5%;
            position: relative;
            max-width: 350px;
            border-radius: 20px;
            margin: auto;
            background: rgba(0,0,0,0.8);
            padding: 20px 40px;
            color: #fff;
            box-sizing: border-box;
            z-index: 999;
        }
        h2 {
            text-align: center;
        }
        h6 {
            text-align: center;
            padding: 5px 1px;
        }
        input[type=text], input[type=number], input[type=email], textarea, input[type=password] {
            width: 100%;
            box-sizing: border-box;
            padding: 12px 5px;
            background: rgba(0,0,0,0.10);
            outline: none;
            border: none;
            border-bottom: 1px solid #fff;
            color: #fff;
            border-radius: 5px;
            margin: 5px 0;
            font-weight: bold;
        }
        input[type=submit] {
            width: 100%;
            box-sizing: border-box;
            padding: 10px 0;
            margin-top: 30px;
            outline: none;
            border: none;
            background: linear-gradient(to right, #ff105f, #ffad06);
            border-radius: 20px;
            font-size: 20px;
            color: #fff;
        }
        input[type=submit]:hover {
            background: linear-gradient(to left, #ff105f, #ffad06);
        }
        @media screen and (max-width: 579px) {
            .wrap {
                top: 10%;
            }
        }
    </style>
</head>

<body>

    <div class="wrap">
        <h2>Register</h2>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('signup') }}" method="POST">
            @csrf

            <input type="text" name="name" placeholder="Name" required>

            <input type="number" name="mobile" placeholder="Mobile Number" required>

            <input type="email" name="email" placeholder="Email" required>

            <textarea name="address" placeholder="Address" required></textarea>

            <input type="password" name="password" placeholder="Password" required>

            <input type="password" name="cpassword" placeholder="Confirm Password" required>

            <input type="submit" value="Register">

            <h6>Already Have an Account? <a href="{{ route('login') }}">Login</a></h6>
        </form>
    </div>

    <script src="{{ asset('bootstrap/js/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

</body>
</html>
