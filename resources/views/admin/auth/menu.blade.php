<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Our Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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
            color:rgb(13, 14, 15);
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
        .card {
            height: 380px;
            display: flex;
            flex-direction: column;
        }

        .card-img-top {
            height: 180px;
            object-fit: cover;
        }

        .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .card-body button {
            margin-top: auto;
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

<div class="container py-5">
    <h2 class="mb-4">🍽️ Our Menu</h2>

    <div class="mb-4">
    <strong>Categories:</strong>
    @foreach ($categories as $cat)
        <a href="{{ route('admin.menu-items.index', ['category' => $cat]) }}"
           class="btn btn-sm mx-1 {{ ($category ?? 'All') === $cat ? 'btn-primary' : 'btn-outline-primary' }}">
            {{ $cat }}
        </a>
    @endforeach
</div>

    <div class="row">
        @foreach ($menuItems as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('images/' . $item->image) }}" class="card-img-top" alt="{{ $item->name }}" />
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        <p class="card-text">{{ $item->description }}</p>
                        <h6 class="text-success">Rs. {{ number_format($item->price, 2) }}</h6>

                        @auth('admin')
                            <form method="POST" action="{{ route('admin.menu-items.toggle', $item->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $item->available ? 'btn-success' : 'btn-secondary' }}">
                                    {{ $item->available ? 'Available' : 'Unavailable' }}
                                </button>
                            </form>
                        @else
                            @if ($item->available)
                                <button class="btn btn-sm btn-success mt-2">Add to Cart</button>
                            @else
                                <button class="btn btn-sm btn-secondary mt-2" disabled>Unavailable</button>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
