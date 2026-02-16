<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Train Food Ordering System</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body, html {
      height: 100%;
      font-family: 'Poppins', sans-serif;
    }

    .main-container {
      position: relative;
      height: 100vh;
      background-image: url('images/back.jpg');
      background-size: cover;
      background-position: center;
      color: black;
      text-align: right;
      overflow: hidden;
    }
.content {
  position: absolute;
  top: 300px; /* Adjust top distance */
  right: 60px; /* Adjust right distance */
  text-align: right;
  animation: fadeInUp 1.5s ease-out forwards;
  opacity: 0;
  transform: none; /* Remove vertical centering */
}

   .welcome-text {
  font-size: 4em;
  font-weight: 600;
  animation: fadeInUp 1.5s ease-out forwards;
  opacity: 0;
  margin-bottom: 1px; /* Reduce space between lines */
  line-height: 1; /* Tight line spacing */
}

.brand-text {
  font-size: 4em;
  font-weight: 600;
  color:rgb(5, 5, 9);
  text-transform: uppercase;
  animation: popUp 1.8s ease-out forwards;
  opacity: 0;
  margin-top: 0; /* Prevent extra gap */
  line-height: 1.1;
}
    .login-btn {
      position: absolute;
      top: 20px;
      right: 30px;
      padding: 10px 25px;
      background-color: #ff6347;
      color: white;
      font-size: 1.2em;
      border: none;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s ease, transform 0.3s ease;
      animation: fadeInRight 1s ease-out forwards;
      opacity: 0;
    }

    .login-btn:hover {
      background-color: #ff4500;
      transform: scale(1.05);
    }

    @keyframes fadeInUp {
      from {
        transform: translateY(50%);
        opacity: 0;
      }
      to {
        transform: translateY(-50%);
        opacity: 1;
      }
    }

    @keyframes fadeInRight {
      from {
        transform: translateX(100px);
        opacity: 0;
      }
      to {
        transform: translateX(0);
        opacity: 1;
      }
    }

    @keyframes popUp {
      0% {
        transform: scale(0.5);
        opacity: 0;
      }
      100% {
        transform: scale(1);
        opacity: 1;
      }
    }

    @keyframes glow {
      from {
        text-shadow: 0 0 5px #ff6347, 0 0 10px #ff6347;
      }
      to {
        text-shadow: 0 0 20px #ff4500, 0 0 30px #ff4500;
      }
    }
  </style>
</head>
<body>
  <div class="main-container">
    <a href="{{ route('login') }}" class="login-btn">Login</a>
    <div class="content">
      <h1 class="welcome-text">Welcome to the</h1>
      <h1 class="brand-text">Train Eats</h1>
    </div>
  </div>
</body>
</html>
