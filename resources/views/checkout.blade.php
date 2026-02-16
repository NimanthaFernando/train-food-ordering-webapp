<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <style>
        body {
            background-image: url('{{ asset("images/checkout.jpg") }}');
            background-size: cover;
            background-position: center;
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
            font-size: 2.5em;
            font-weight: bold;
            color: #000;
            margin-left: 120px;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            margin-left: 600px;
            margin-right: 60px;
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

        .checkout-container {
            background-color: rgba(0, 0, 0, 0.7);
            max-width: 700px;
            margin: 100px auto;
            padding: 30px;
            border-radius: 15px;
        }

        input, textarea ,select{
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 8px;
            border: none;
            font-size: 16px;
        }

        label {
            margin-top: 15px;
            display: block;
            font-weight: bold;
        }

        table {
            width: 100%;
            margin-top: 20px;
            color: white;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
        }

        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 20px;
        }

        .btn-place-order {
            background: #28a745;
            padding: 12px 20px;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 20px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
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
.modal {
    display: none;
    position: fixed;
    z-index: 999;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: white;
    color:black;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
    width: 90%;
    max-width: 400px;
    animation: fadeIn 0.3s ease-in-out;
}

.modal-buttons {
    margin-top: 20px;
    display: flex;
    justify-content: space-around;
}

.btn-cancel, .btn-go-payment {
    padding: 10px 20px;
    border: none;
    border-radius: 6px;
    font-size: 1rem;
    cursor: pointer;
}

.btn-cancel {
    background-color: #e3342f;
    color: white;
}

.btn-go-payment {
    background-color: #38c172;
    color: white;
}

@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
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
    <div class="navbar">
        <div class="logo">Train Eats</div>
        <ul>
            <li><a href="/home">Home</a></li>
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
    <br>

    <div class="checkout-container">
        <h2>Checkout</h2>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if(count($cartItems) > 0)
          <form method="POST" action="{{ route('checkout.store') }}" id="orderForm">
                @csrf

                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>

                <label for="ticket">Ticket Number</label>
                <input type="text" id="ticket" name="ticket" required>

                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" required>

                <label for="seat">Seat No</label>
                <select id="seat" name="seat" required>
    <option value="" disabled selected>Select Seat No</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16">16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    <option value="19">19</option>
    <option value="20">20</option>
</select>

                <label for="train_class">Train Class</label>
                <select id="train_class" name="train_class" required>
                <option value="" disabled selected>Select Train Class</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>

                <label for="class_name">Compartment</label>
                <select id="class_name" name="class_name" required>
    <option value="" disabled selected>Select Compartment name</option>
    <option value="A">A</option>
    <option value="B">B</option>
    <option value="C">C</option>
    <option value="D">D</option>
</select>


                <h3>Order Summary</h3>

                <table>
                    <thead>
                        <tr>
                            <th>Food</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($cartItems as $item)
                            @php
                                $subtotal = $item['price'] * $item['quantity'];
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>Rs. {{ number_format($item['price'], 2) }}</td>
                                <td>Rs. {{ number_format($subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="total">
                    Total: Rs. {{ number_format($total, 2) }}
                </div>

                <button type="button" class="btn-place-order" onclick="openModal()">Place Order</button>

                <!-- Modal inside form -->
    <div id="orderModal" class="modal">
        <div class="modal-content">
            <h2>Confirm Your Order</h2>
            <p>Do you want to proceed to payment or cancel the order?</p>
            <div class="modal-buttons">
                <button type="button" onclick="closeModal()" class="btn-cancel">Cancel Order</button>
                <button type="submit" class="btn-go-payment">Go to Payment</button>
                <!-- Note: This is now type="submit", not JS submit() -->
            </div>
        </div>
    </div>
            </form>
          
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>

    <br>
 <footer class="footer">
        <p>© 2025 TRAIN EATS</p>
    </footer>


    <script>
    function openModal() {
        document.getElementById('orderModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('orderModal').style.display = 'none';
    }
</script>
</body>
</html>
