<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Feedback</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-pAPX0dV+G9qR8QvAewYQ4IsuylIm+N2klp+6iq8Cd6xw6r+j5FQ/cchZmwP4Q/Yn7uYTG+O9ef+I+X8XBzZV1g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-image: url('{{ asset("images/feedback.jpg") }}');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            font-family: 'Poppins', sans-serif;
        }

        .fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .glass {
            background: rgba(251, 246, 246, 0.85);
            backdrop-filter: blur(10px);
        }

        .star {
            color: #fbbf24;
        }

        .footer {
    background-color: rgb(230, 169, 38);
    color: #ffffff;
    text-align: center;
    padding: 15px 0;
    font-size: 16px;
    position: fixed;    /* Change from relative to fixed */
    bottom: 0;
    left: 0;           /* add left */
    width: 100%;
    z-index: 100;
}
.footer p {
    margin: 0;
}
    </style>
</head>
<body class="min-h-screen flex flex-col items-center pt-32 p-6">

    <!-- Diagonal Navbar -->
<!-- Diagonal Navbar -->
<nav class="fixed top-0 left-0 w-full z-50 bg-gradient-to-br from-yellow-400 via-yellow-300 to-orange-400 backdrop-blur-md shadow-sm">
    <div class="max-w-7xl mx-auto px-6 py-8 flex justify-between items-center">
        <!-- Logo moved slightly to the right -->
        <div class="text-4xl font-extrabold text-black ml-10">Train Eats</div>
        <!-- Links + Logout -->
        <div class="flex items-center space-x-3">
            <ul class="flex space-x-6 text-black text-md font-medium">
                <li><a href="/home" class="hover:text-orange-100 transition">Home</a></li>
                <li><a href="/menu" class="hover:text-orange-100 transition">Menu</a></li>
                <li><a href="{{ route('cart') }}" class="hover:text-orange-100 transition">Cart</a></li>
                <li><a href="{{ route('track-order') }}" class="hover:text-orange-100 transition">Track Order</a></li>
               <li><a href="{{ route('feedback.index') }}" class="hover:text-orange-100 transition">Reviews</a></li>
            </ul>

            @auth
                <form method="POST" action="{{ route('logout') }}" class="ml-4">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded transition duration-300">Logout</button>
                </form>
            @endauth
        </div>
    </div>
</nav>


    <!-- Page Title -->
<!-- Page Title -->
<h1 class="text-4xl font-bold text-white mb-12 shadow-md fade-in text-left self-end w-full">Customer Feedback</h1>


    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-8 w-full max-w-2xl text-center fade-in">
            {{ session('success') }}
        </div>
    @endif

    <!-- Instruction for User -->
    <div class="bg-blue-100 text-blue-800 p-4 rounded mb-8 w-full max-w-2xl text-center fade-in shadow-md">
        <p class="font-semibold text-lg">Want to leave a review?</p>
        <p>Go to <a href="{{ route('track-order') }}" class="underline text-blue-600 hover:text-blue-800">Track Order</a>, enter your ticket number, and share your experience!</p>
    </div>

    <!-- Feedback Entries -->
    <div class="w-full max-w-3xl space-y-6">
        @forelse($feedbacks as $item)
            @php
                $randomRating = rand(3, 5); // Auto-generate rating between 3-5
            @endphp
            <div class="glass p-6 rounded-xl shadow-xl fade-in">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-semibold text-gray-800">{{ $item->name }}</h3>
                    <div>
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $randomRating ? 'star' : 'text-gray-300' }}"></i>
                        @endfor
                    </div>
                </div>
                <p class="text-gray-700 mt-4 text-lg">{{ $item->feedback }}</p>
                <p class="text-sm text-gray-500 mt-2">Ticket No: {{ $item->ticket }}</p>
            </div>
        @empty
            <p class="text-white text-center text-lg fade-in">No feedback submitted yet.</p>
        @endforelse
    </div>

    <br>
 <footer class="footer">
        <p>© 2025 TRAIN EATS</p>
    </footer>

</body>
</html>
