<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | Users</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
            font-weight: 550;
            margin-bottom: 1rem;
        }

        .sidebar a {
            color:rgb(5, 8, 11);
            text-decoration: none;
            display: block;
            padding: 0.5rem 1rem;
            border-radius: 0.3rem;
            margin-bottom: 0.75rem;
            transition: background-color 0.2s ease;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background-color:rgb(242, 117, 8);
            color: #fff;
        }

        .logout-button {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        .logout-button button {
            background-color: #dc3545;
            color: white;
            padding:  0.1rem 5rem;
            border: none;
            border-radius: 0.350rem;
            font-weight: 200;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .logout-button button:hover {
            background-color: #c82333;
        }

        .content {
            flex-grow: 1;
            padding: 2rem;
        }

        table th {
            background-color: #e2e8f0;
        }

        table tr:hover {
            background-color: #f8fafc;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<nav class="sidebar">
    <h4>🧑‍💼 Admin Panel</h4>
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
    <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">Users</a>
    <a href="{{ route('admin.orders') }}" class="{{ request()->routeIs('admin.orders') ? 'active' : '' }}">Orders</a>
    <a href="{{ route('admin.menu-items.index') }}" class="{{ request()->routeIs('admin.menu-items.index') ? 'active' : '' }}">Menu Items</a>
    <a href="{{ route('admin.feedback') }}" class="{{ request()->routeIs('admin.feedback') ? 'active' : '' }}">Reviews</a>

    <form method="POST" action="{{ route('admin.logout') }}" class="logout-button">
        @csrf
        <button type="submit">Logout</button>
    </form>
</nav>

<!-- Main Content -->
<div class="content">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">👩‍💼👨‍💼 Registered Users</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <table class="min-w-full table-auto border-collapse text-sm">
            <thead>
                <tr class="bg-gray-200 text-left text-gray-700">
                    <th class="py-3 px-5 border">No</th>
                    <th class="py-3 px-5 border">Name</th>
                    <th class="py-3 px-5 border">Email</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-5 border">{{ $index + 1 }}</td>
                        <td class="py-3 px-5 border">{{ $user->name }}</td>
                        <td class="py-3 px-5 border">{{ $user->email }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-4 px-4 text-center text-gray-500">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
