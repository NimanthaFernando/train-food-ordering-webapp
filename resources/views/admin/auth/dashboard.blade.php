<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f1f3f5;
            min-height: 100vh;
            display: flex;
            margin: 0;
        }
        .sidebar {
            width: 220px;
            background-color:rgb(246, 193, 81);
            color:black;
            min-height: 100vh;
            padding: 1rem;
            flex-shrink: 0;
        }
        .sidebar a {
            color:rgb(12, 13, 15);
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
        .content {
            flex-grow: 1;
            padding: 2rem;
        }
        .navbar {
            background-color:rgb(246, 193, 81);
            color: black;
            padding: 0.75rem 1.5rem;
            margin-bottom: 1.5rem;
            border-radius: 0.3rem;
        }
        .sidebar-dropdown {
    margin-bottom: 0.3rem;
    margin-left:0.3rem;
}

.sidebar-link {
    color:rgb(7, 9, 10);
    cursor: pointer;
    padding: 0.55rem;
    border-radius: 0.3rem;
    transition: background-color 0.2s ease;
}

.sidebar-link:hover {
    background-color:rgb(254, 119, 16);
    color: white;
}

.sidebar-submenu a {
    padding-left: 2rem;
    font-size: 0.95rem;
}

    
    </style>
</head>
<body>
    <nav class="sidebar">
        <h4 class="mb-4">🧑‍💼 Admin Panel</h4>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">Users</a>
    <a href="{{ route('admin.orders') }}" class="{{ request()->routeIs('admin.orders') ? 'active' : '' }}">Orders</a>
        <a href="{{ route('admin.menu-items.index') }}" class="{{ request()->routeIs('admin.menu-items.index') ? 'active' : '' }}">Menu Items</a>
        <a href="{{ route('admin.feedback') }}" class="{{ request()->routeIs('admin.feedback') ? 'active' : '' }}">Reviews</a>

        <form method="POST" action="{{ route('admin.logout') }}" class="mt-5">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm w-100">Logout</button>
        </form>
    </nav>

    <main class="content">
    <div class="navbar">
        <span>Welcome, {{ auth('admin')->user()->name ?? 'Admin' }}</span>
    </div>

    <h2>Dashboard</h2>
    <p>Manage your application using the options on the left.</p>

    <div class="row mt-4">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm p-3 bg-white rounded">
                <h5 class="text-gray-700">👩‍💼👨‍💼 Users</h5>
                <p class="display-6 text-3xl font-bold text-blue-600">{{ $usersCount }}</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm p-3 bg-white rounded">
                <h5 class="text-gray-700">🧾 Orders</h5>
                <p class="display-6 text-3xl font-bold text-blue-600">{{ $ordersCount }}</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm p-3">
                <h5>🍽️ Menu Items</h5>
                <p class="display-6">{{ $menuItemsCount ?? '12' }}</p>
            </div>
        </div>
    </div>

    <!-- 📊 Orders Per Day Chart -->
    <div class="mt-5">
        <h2 class="text-3xl font-bold mb-4">📊 Orders Per Day</h2>
        <div class="bg-white p-4 rounded shadow-lg w-100">
            <canvas id="orderChart" height="100"></canvas>
        </div>
    </div>
</main>
    
<script>
    const ctx = document.getElementById('orderChart').getContext('2d');

    // Define colors based on number of dates
    const barColors = {!! json_encode($labels) !!}.map((label, index) => {
        const colors = [
            'rgba(255, 99, 132, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            'rgba(255, 206, 86, 0.7)',
            'rgba(75, 192, 192, 0.7)',
            'rgba(153, 102, 255, 0.7)',
            'rgba(255, 159, 64, 0.7)',
            'rgba(100, 255, 218, 0.7)',
        ];
        return colors[index % colors.length]; // loop through colors
    });

    const borderColors = barColors.map(color => color.replace('0.7', '1'));

    const orderChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Orders',
                data: {!! json_encode($data) !!},
                backgroundColor: barColors,
                borderColor: borderColors,
                borderWidth: 1,
                borderRadius: 8,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

  
function toggleDropdown(id) {
    const el = document.getElementById(id);
    el.style.display = (el.style.display === 'block') ? 'none' : 'block';
}


</script>

</body>
</html>
