<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buns | Train Eats</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .body, html {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(to left,rgb(245, 242, 156), #ffad06);
            padding: 20px 50px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .navbar .logo {
            font-size: 2.5em;
            font-weight: bold;
            color: #000;
        margin-left:120px;

        }

        .navbar ul {
            list-style: none;
            display: flex;
            margin-right: 100px;
            margin-bottom:5px;
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
        
        .card-img-top {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }
        .order-now {
            background-color: red;
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            cursor: pointer;
            border: none;
            width: 100%;
        }
        .quantity-control button {
            width: 30px;
            height: 30px;
        }
    </style>
</head>
<body>


<div class="navbar">
        <div class="logo">Train Eats</div>
        <ul>
            <li><a href="/home">Home</a></li>
            <li><a href="/menu">Menu</a></li>
            <li><a href="/cart">Cart</a></li>
            <li><a href="/track-order">Track Order</a></li>
            <li><a href="/contactus">Contact Us</a></li>
        </ul>
    </div>
<br>
<br>
<br>

<div class="container my-5">
    <h1 class="text-center mb-4">Sweets</h1>

    <div class="row g-4">
        @foreach ($sweets as $sweet)
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <!-- Access image as an array index -->
                    <img src="{{ asset('images/' . $sweet['image']) }}" class="card-img-top" alt="{{ $sweet['name'] }}">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $sweet['name'] }}</h5>
                        <h6>Rs. {{ $sweet['price'] }}</h6>
                        <form action="{{ route('cart.add') }}" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="name" value="{{ $sweet['name'] }}">
                        <input type="hidden" name="quantity" value="1" class="quantity-input">
                        <button type="submit" class="btn btn-primary w-100">Order Now</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    function increaseQuantity(button) {
        let input = button.parentElement.querySelector('input');
        input.value = parseInt(input.value) + 1;
        syncQuantityToForm(button);
    }

    function decreaseQuantity(button) {
        let input = button.parentElement.querySelector('input');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
            syncQuantityToForm(button);
        }
    }

    function syncQuantityToForm(button) {
        const cardBody = button.closest('.card-body');
        const qty = cardBody.querySelector('.quantity-control input').value;
        const qtyInput = cardBody.querySelector('input[name="quantity"]');
        if (qtyInput) qtyInput.value = qty;
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.quantity-control').forEach(control => {
            syncQuantityToForm(control.querySelector('button'));
        });
    });
</script>