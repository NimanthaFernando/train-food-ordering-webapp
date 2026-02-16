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

        .navbar {
            background: linear-gradient(to left, rgb(245, 242, 156), #ffad06);
            padding: 1rem;
            color: black;
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            align-items: center;
        }

        .navbar ul li {
            margin-left: 20px;
        }

        .navbar ul li a {
            color: black;
            text-decoration: none;
            font-size: 1rem;
            transition: color 0.3s;
        }

        .navbar ul li a:hover {
            color: #ff6347;
        }

        .logout-form {
            display: inline;
        }

        .logout-button {
            background-color: #e3342f;
            color: white;
            padding: 6px 14px;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background-color: #cc1f1a;
        }

        /* Slideshow Styles */
        .slideshow-container {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            display: none;
            background-size: cover;
            background-position: center;
        }

        .slide.active {
            display: block;
            animation: fade 1s ease-in-out;
        }

        @keyframes fade {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        video.slide-video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .slideshow-content, .welcome-text {
            position: absolute;
            background: rgba(255, 255, 255, 0.7);
            padding: 20px 40px;
            border-radius: 12px;
            font-size: 2rem;
            font-weight: bold;
            color: #000;
            z-index: 10;
        }

        .slideshow-content {
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 48px;
        }

        .welcome-text {
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 20px;
        }

        .gallery {
            display: flex;
            overflow: hidden;
            height: 350px;
        }

        .gallery img {
            width: 33.33%;
            object-fit: cover;
            height: 100%;
        }

        .section-text {
            text-align: center;
            padding: 90px 20px;
            background: #f9f9f9;
        }

        .section-text h2 {
            color: #5E2D79;
            font-size: 36px;
            margin-bottom: 10px;
            font-family: 'Cursive', sans-serif;
        }

        .section-text p {
            color: #555;
            font-size: 18px;
            max-width: 800px;
            margin: auto;
            line-height: 1.6;
        }

        .subheading {
            color: #333;
            font-size: 20px;
            letter-spacing: 2px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 3rem;
            font-weight: 600;
        }

        .footer {
    background-color:rgb(230, 169, 38);
    color: #ffffff;
    text-align: center;
    padding: 15px 0;
    font-size: 16px;
    position: relative;
    bottom: 0;
    width: 100%;
}

.footer p {
    margin: 0;
}
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="navbar-container">
        <h1 class="text-3xl font-semibold">Train Eats</h1>
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('menu.index') }}">Menu</a></li>
            <li><a href="{{ route('cart') }}">Cart</a></li>
            <li><a href="{{ route('track-order') }}">Track Order</a></li>
         <li><a href="{{ route('feedback.index') }}" class="hover:text-orange-100 transition">Reviews</a></li>
            @auth
            <li>
                <form method="POST" action="{{ route('logout') }}" class="logout-form ms-3">
                    @csrf
                    <button type="submit" class="logout-button">Logout</button>
                </form>
            </li>
            @endauth
        </ul>
    </div>
</nav>

<!-- Slideshow with Video and Images -->
<div class="slideshow-container">

    <!-- Shared Text Overlays -->
    @auth
        <div class="welcome-text">Welcome, {{ Auth::user()->name }}!</div>
    @endauth
    <div class="slideshow-content">Enjoying Your Train Ride</div>

    <!-- Slides -->
    <div class="slide active">
        <video id="trainVideo" class="slide-video" muted>
            <source src="{{ asset('videos/train video.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <div class="slide" style="background-image: url('{{ asset('images/home.jpg') }}');"></div>
    <div class="slide" style="background-image: url('{{ asset('images/train1.jpg') }}');"></div>
    <div class="slide" style="background-image: url('{{ asset('images/train2.webp') }}');"></div>
</div>

<!-- Section Text -->
<div class="section-text">
    <div class="subheading">RELISH EXQUISITE FLAVOURS RIGHT AT TRAIN</div>
    <h2><i>Fresh meals delivered onboard – wherever you're headed.</i></h2>
    <p>
        Train Eats brings gourmet comfort to your journey – one track at a time.
        Whether you're craving a hearty breakfast, a quick snack, or a satisfying meal, 
        our curated menu offers freshly prepared dishes delivered right to your seat.
        Enjoy restaurant-quality food on wheels, sourced from trusted kitchens and served with care 
        throughout your train ride.
        We believe that travel should be delicious, and with Train Eats, your next destination comes 
        with a taste of home.
    </p>
</div>

<!-- Gallery -->
<div class="gallery">
    <img src="{{ asset('images/home1.jpg') }}" alt="Steak">
    <img src="{{ asset('images/home3.jpg') }}" alt="Pool">
    <img src="{{ asset('images/home2.jpg') }}" alt="Pizza">
</div>
<br>
 <footer class="footer">
        <p>© 2025 TRAIN EATS</p>
    </footer>

<!-- Slideshow Script -->
<script>
    const slides = document.querySelectorAll('.slide');
    const video = document.getElementById('trainVideo');
    let index = 0;

    function showSlide(i) {
        slides.forEach(slide => slide.classList.remove('active'));
        slides[i].classList.add('active');
    }

    function nextSlide() {
        const currentSlide = slides[index];
        const isVideo = currentSlide.querySelector('video');

        if (isVideo) {
            video.currentTime = 0;
            video.play();
            video.onended = () => {
                index = (index + 1) % slides.length;
                showSlide(index);
                setTimeout(nextSlide, 5000);
            };
        } else {
            index = (index + 1) % slides.length;
            showSlide(index);
            setTimeout(nextSlide, 5000);
        }
    }

    setTimeout(nextSlide, 5000);
</script>

</body>
</html>
