<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | Customer Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f1f3f5;
            min-height: 100vh;
            display: flex;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        .sidebar {
            width: 220px;
            background-color:rgb(246, 193, 81);
            color: black;
            min-height: 100vh;
            padding: 1rem;
            flex-shrink: 0;
        }

        .sidebar h4 {
            font-size: 1.5rem;
            font-weight:  550;
            margin-bottom: 1rem;
            text-align: left;
        }

        .sidebar a {
            color:rgb(4, 5, 5);
            text-decoration: none;
            display: block;
            padding: 0.5rem 1rem;
            border-radius: 0.3rem;
            margin-bottom: 0.75rem;
            transition: background-color 0.2s ease
        }

        .sidebar a.active,
        .sidebar a:hover {
            background-color:rgb(242, 117, 8);
            color: #fff;
        }

        .content {
            flex-grow: 1;
            padding: 2rem;
        }

        .fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .feedback-box {
            background: #fff;
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <nav class="sidebar">
         <h4 class="mb-4">🧑‍💼 Admin Panel</h4>

        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">Users</a>
        <a href="{{ route('admin.orders') }}" class="{{ request()->routeIs('admin.orders') ? 'active' : '' }}">Orders</a>
        <a href="{{ route('admin.menu-items.index') }}" class="{{ request()->routeIs('admin.menu-items.index') ? 'active' : '' }}">Menu Items</a>
        <a href="{{ route('admin.feedback') }}" class="{{ request()->routeIs('admin.feedback') ? 'active' : '' }}">Reviews</a>

        <form method="POST" action="{{ route('admin.logout') }}" class="mt-8 flex justify-center">
            @csrf
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-20 rounded text-sm">
                Logout
            </button>
        </form>
    </nav>

    <!-- Main Content -->
    <div class="content">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 fade-in">⭐⭐⭐⭐⭐ Customer Feedback</h1>

        <div class="grid gap-6 fade-in">
            @forelse($orders as $order)
                @if($order->feedback)
                    <div class="feedback-box">
                        <div class="flex justify-between items-center mb-2">
                            <h2 class="text-xl font-semibold text-gray-800">{{ $order->name }}</h2>
                            <span class="text-sm text-gray-500">Ticket No: {{ $order->ticket }}</span>
                        </div>
                        <p class="text-gray-700">{{ $order->feedback }}</p>
                    </div>
                @endif
            @empty
                <p class="text-gray-500">No feedback available yet.</p>
            @endforelse
        </div>
    </div>

</body>
</html>
