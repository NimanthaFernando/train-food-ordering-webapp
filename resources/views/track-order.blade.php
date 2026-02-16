<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Tracking - Train Eats</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
        }

        .overlay {
            background: linear-gradient(to bottom right, rgba(255, 255, 255, 0.8), rgba(248, 210, 97, 0.9));
            backdrop-filter: blur(6px);
        }

        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logout-form {
            margin-left: 5px;
        }

        .logout-button {
            background-color: #e3342f;
            color: white;
            padding: 3px 12px;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background-color: #cc1f1a;
        }

        .footer {
            background-color: rgb(230, 169, 38);
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

<body class="flex flex-col">

    <!-- Background Video -->
    <video autoplay muted loop id="backgroundVideo"
        style="position: fixed; right: 0; bottom: 0; min-width: 100%; min-height: 50%; z-index: -1; object-fit: cover;">
        <source src="{{ asset('videos/track video.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Your page content here -->
    <div class="content">
        <!-- Rest of your page -->
    </div>
    <!-- Navbar -->
    <!-- Navbar -->
    <nav
        class="bg-gradient-to-r from-yellow-400 via-yellow-400 to-orange-500 shadow-md py-6 px-8 flex justify-between items-right">
        <!--  Left : logo  -->
        <div class="text-5xl font-bold text-black-500 ml-28">Train Eats</div>

        <!--  Right : links + logout  -->
        <div class="flex items-center space-x-7 mr-28">
            <ul class="flex space-x-6 text-black-700 text-[17px]">
                <li><a href="/home"class="hover:text-orange-500 transition">Home</a></li>
                <li><a href="/menu"class="hover:text-orange-500 transition">Menu</a></li>
                <li><a href="{{ route('cart') }}"class="hover:text-orange-500 transition">Cart</a></li>
                <li><a href="{{ route('track-order') }}"class="hover:text-orange-500 transition">Track Order</a></li>
                <li><a href="{{ route('feedback.index') }}" class="hover:text-orange-100 transition">Reviews</a></li>
            </ul>

            @auth
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-button">Logout</button>
                </form>
            @endauth
        </div>
    </nav>


    <!-- Main Content -->
    <div class="flex-1 flex items-center justify-center p-6">
        <div class="overlay fade-in p-10 rounded-2xl shadow-2xl w-full max-w-2xl space-y-10">

            @if (!isset($order))
                <form method="GET" action="{{ route('track-order') }}" class="space-y-4">
                    <label class="block text-gray-700 font-semibold">Enter Your Ticket Number:</label>
                    <input type="text" name="ticket" class="w-full border p-3 rounded" placeholder="e.g. TICKET123"
                        required>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded">Track
                        Order</button>
                </form>
            @endif

            @if (session('error') || isset($error))
                <div class="bg-red-100 text-red-700 p-3 text-center rounded">
                    {{ session('error') ?? $error }}
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-3 text-center rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('feedback_success'))
                <div class="bg-green-100 text-green-700 p-3 text-center rounded">
                    {{ session('feedback_success') }}
                </div>
            @endif

            @if (isset($order) && $order)
                <h2 class="text-2xl font-bold text-center">Tracking Ticket: {{ $order->ticket }}</h2>

                <!-- Progress Bar -->
                <div class="mt-6 flex justify-between items-center">
                    <div class="text-center">
                        <div
                            class="w-10 h-10 rounded-full {{ $order->order_status == 'Pending' ? 'bg-yellow-500' : (in_array($order->order_status, ['Preparing', 'Delivering']) ? 'bg-green-500' : 'bg-gray-300') }} text-white flex items-center justify-center">
                            1</div>
                        <p>Pending</p>
                    </div>
                    <div
                        class="h-1 flex-1 mx-2 {{ in_array($order->order_status, ['Preparing', 'Delivering']) ? 'bg-green-400' : 'bg-gray-300' }}">
                    </div>
                    <div class="text-center">
                        <div
                            class="w-10 h-10 rounded-full {{ $order->order_status == 'Preparing' ? 'bg-green-400' : ($order->order_status == 'Delivering' ? 'bg-green-500' : 'bg-gray-300') }} text-white flex items-center justify-center">
                            2</div>
                        <p>Preparing</p>
                    </div>
                    <div
                        class="h-1 flex-1 mx-2 {{ $order->order_status == 'Delivering' ? 'bg-green-400' : 'bg-gray-300' }}">
                    </div>
                    <div class="text-center">
                        <div
                            class="w-10 h-10 rounded-full {{ $order->order_status == 'Delivering' ? 'bg-green-600' : 'bg-gray-300' }} text-white flex items-center justify-center">
                            3</div>
                        <p>Delivering</p>
                    </div>
                </div>

                <!-- Confirm Received -->
                @if ($order->order_status !== 'Received')
                    <form action="{{ route('order.confirm') }}" method="POST" class="mt-6 text-center">
                        @csrf
                        <input type="hidden" name="ticket" value="{{ $order->ticket }}">
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded">Confirm
                            Received</button>
                    </form>
                @endif

                <!-- Feedback -->
                <div class="mt-10">
                    <form action="{{ route('order.feedback') }}" method="POST">
                        @csrf
                        <input type="hidden" name="ticket" value="{{ $order->ticket }}">
                        <textarea name="feedback" class="w-full border p-3 rounded" placeholder="Write your feedback..." required></textarea>
                        <button type="submit" class="mt-3 bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">
                            Submit Feedback
                        </button>
                    </form>
                </div>

            @endif

        </div>
    </div>

    <br>
    <footer class="footer">
        <p>© 2025 TRAIN EATS</p>
    </footer>

</body>

</html>