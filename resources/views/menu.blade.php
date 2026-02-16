<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Our Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
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

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(to left, rgb(245, 242, 156), #ffad06);
            padding: 20px 50px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .navbar .logo {
            font-size: 3em;
            font-weight: bold;
            color: #000;
            margin-left: 120px;
        }

        .navbar-content {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .navbar ul li {
            margin-left: 20px;
        }

        .navbar ul li a {
            text-decoration: none;
            color: #000;
            font-size: 17px;
            font-weight: 400;
            transition: color 0.3s;
        }

        .navbar ul li a:hover {
            color: #ff6600;
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
.animated-heading {
  font-size: 2rem;
  font-weight: bold;
  color:rgb(10, 6, 13);
  overflow: hidden;
  white-space: nowrap;
  border-right: 3px solidrgb(15, 11, 17); /* cursor effect */
  width: 0;
  animation: slideIn 2s forwards;
}

@keyframes slideIn {
  from {
    width: 0;
  }
  to {
    width: 10ch; /* approx width of "Our Menu" */
  }
}

.footer p {
    margin: 0;
}
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <div class="logo">Train Eats</div>
    <div class="navbar-content">
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="/menu">Menu</a></li>
            <li><a href="{{ route('cart') }}">Cart</a></li>
            <li><a href="/track-order">Track Order</a></li>
            <li><a href="{{ route('feedback.index') }}" class="hover:text-orange-100 transition">Reviews</a></li>
        </ul>
        @auth
            <form method="POST" action="{{ route('logout') }}" class="logout-form ms-3">
                @csrf
                <button type="submit" class="logout-button">Logout</button>
            </form>
        @endauth
    </div>
</div>

<br><br><br><br>

<div class="container py-5">
  <h2 class="animated-heading">Our Menu</h2>

    {{-- Category Buttons --}}
    <div class="mb-4">
        <strong>Categories:</strong>
        @foreach ($categories as $cat)
            <a href="{{ route('menu.index', ['category' => $cat]) }}"
               class="btn btn-sm mx-1 {{ ($category ?? 'All') === $cat ? 'btn-primary' : 'btn-outline-primary' }}">
                {{ $cat }}
            </a>
        @endforeach
    </div>

    {{-- Menu Items --}}
    <div class="row">
        @forelse ($menuItems as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('images/' . $item->image) }}" class="card-img-top" alt="{{ $item->name }}" />
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        <p class="card-text">{{ $item->description }}</p>
                        <h6 class="text-success">Rs. {{ number_format($item->price, 2) }}</h6>

                        @if ($item->available)
                            <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="name" value="{{ $item->name }}">
                                <input type="hidden" name="price" value="{{ $item->price }}">
                                <button type="submit" class="btn btn-sm btn-success mt-2">Add to Cart</button>
                            </form>
                        @else
                            <button class="btn btn-sm btn-secondary mt-2" disabled>Unavailable</button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p>No items found in this category.</p>
        @endforelse
    </div>
</div>

<br>
 <footer class="footer">
        <p>© 2025 TRAIN EATS</p>
    </footer>

</body>
</html>
