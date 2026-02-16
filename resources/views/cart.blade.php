
<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <style>
        body {
    background-image: url('{{ asset("images/cart.jpg") }}');
    background-size: cover;           
    background-position: center center; 
    background-repeat: no-repeat;     
    background-attachment: fixed;      
    min-height: 100vh;                 
    margin: 0;                          
    font-family: Arial, sans-serif;
    color: #fff;
}
        .navbar {
    display: flex;
    align-items: center;
    background: linear-gradient(to left, rgb(245, 242, 156), #ffad06);
    padding: 25px 55px;
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

.navbar ul {
    list-style: none;
    display: flex;
    margin-left: 500px; /* This pushes the list to the right */
    margin-right: 50px; /* Optional: add spacing from the edge */
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

        .cart-container {
            background-color: rgba(0, 0, 0, 0.7);
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 15px;
        }

        table {
            width: 100%;
            color: white;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            border-bottom: 1px solid #ccc;
        }

        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 20px;
        }

        .btn-checkout {
            background: #ff9900;
            padding: 10px 20px;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
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

       .btn-back {
    background: #28a745; /* green */
    padding: 10px 20px;
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-back:hover {
    background: #218838;
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
<body>

<div class="container my-5">
<div class="navbar">
        <div class="logo">Train Eats</div>
        <ul>
            <li><a href="/home">Home</a></li>
            <li><a href="/menu">Menu</a></li>
            <li><a href="/cart">Cart</a></li>
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
<br>
<br>
<br>

<br>
    <div class="cart-container">
        <h2>🛒 Your Cart</h2>
        <table>
            <thead>
                <tr>
                    <th>Food Item</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @if(session('cart'))
                    @foreach(session('cart') as $id => $details)
                        @php
                            $subtotal = $details['price'] * $details['quantity'];
                            $total += $subtotal;
                        @endphp
                        <tr>
    <td>{{ $details['name'] }}</td>
    <td>
        <form action="{{ route('cart.update', $id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div style="display: flex; gap: 5px;">
                <button type="submit" name="action" value="decrease">-</button>
                <input type="text" name="quantity" value="{{ $details['quantity'] }}" readonly style="width: 40px; text-align: center;">
                <button type="submit" name="action" value="increase">+</button>
            </div>
        </form>
    </td>
    <td>Rs. {{ $details['price'] }}</td>
    <td>Rs. {{ $subtotal }}</td>
    <td>
        <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Remove this item?');">
            @csrf
            @method('DELETE')
            <button type="submit" style="background: none; border: none; color: red; font-size: 20px; cursor: pointer;">🗑️</button>
        </form>
    </td>
</tr>

                    @endforeach
                @else
                    <tr>
                        <td colspan="4">Your cart is empty.</td>
                    </tr>
                @endif
            </tbody>
        </table>

       <div class="total">
    Total: Rs. {{ number_format($total, 2) }}
</div>
<br>

<div style="display: flex; justify-content: space-between;">
    <a href="/menu">
        <button class="btn-back">⬅ Back to Menu</button>
    </a>
    
    <a href="{{ route('checkout') }}">
        <button class="btn-checkout">Proceed to Checkout</button>
    </a>
</div>

</div>
<br>
 <footer class="footer">
        <p>© 2025 TRAIN EATS</p>
    </footer>

</body>
</html>
