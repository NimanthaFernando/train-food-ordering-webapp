<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Payment Interface</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <style>
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
            font-size: 2.5em;
            font-weight: bold;
            color: #000;
            margin-left: 150px;
        }
        .navbar ul {
            list-style: none;
            display: flex;
            margin-right: 100px;
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
        }
        .navbar ul li a:hover {
            color: #ff6600;
        }
        [x-cloak] {
            display: none;
        }
        .animate-fade-in {
            animation: fadeIn 0.4s ease-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
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
    background-color:rgb(230, 169, 38);
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
<body class="bg-yellow-100">

<div class="navbar">
    <div class="logo">Train Eats</div>
    <div style="display: flex; align-items: center; gap: 5px; margin-right: 30px;">
        <ul style="list-style: none; display: flex; gap: 4px; margin: 0; padding: 0;">
            <li><a href="/home">Home</a></li>
            <li><a href="/menu">Menu</a></li>
            <li><a href="/cart">Cart</a></li>
            <li><a href="/track-order">Track Order</a></li>
          <li><a href="{{ route('feedback.index') }}" class="hover:text-orange-100 transition">Reviews</a></li>
        </ul>

        @auth
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="logout-button">Logout</button>
            </form>
        @endauth
    </div>
</div>


<div class="pt-28"></div>

<main class="min-h-screen flex items-center justify-center px-4">
    <section 
        class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-lg"
        x-data="paymentApp()"
    >
        <!-- Stylish Success Message -->
        <template x-if="successMessage">
            <div class="flex justify-center mb-6 animate-fade-in">
                <div class="bg-green-100 border border-green-300 text-green-900 px-6 py-4 rounded-2xl shadow-md w-full text-center max-w-md">
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="font-bold text-lg" x-text="successMessage"></span>
                    </div>
                    <p class="text-sm text-green-700 mt-2">You can now proceed to track your order or return to the menu.</p>
                </div>
            </div>
        </template>

        <h2 class="text-3xl font-bold mb-8 text-center text-gray-700">Choose Payment Method</h2>

        <div class="flex justify-center space-x-4 mb-8">
            <button 
                class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition"
                @click="method = 'bank'; cardType = ''; successMessage = ''"
                :class="method === 'bank' ? 'ring-4 ring-indigo-300' : ''"
            >
                Card Deposit
            </button>
            <button
                class="flex-1 bg-pink-500 hover:bg-pink-600 text-white font-semibold py-3 rounded-xl transition"
                @click="method = 'online'; successMessage = ''"
                :class="method === 'online' ? 'ring-4 ring-pink-300' : ''"
            >
                Bank app Transfer
            </button>
        </div>

        <!-- Bank Deposit Form -->
        <div x-show="method === 'bank'" x-transition class="space-y-6" x-cloak>
            <h3 class="text-xl font-semibold text-gray-700 text-center">Bank Deposit - Card Details</h3>

            <div class="flex justify-center space-x-6">
                <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Visa.svg" 
                    alt="Visa" class="w-16 h-10 cursor-pointer hover:scale-110 transition"
                    @click="cardType = 'visa'"
                    :class="cardType === 'visa' ? 'ring-4 ring-indigo-400 rounded' : ''"
                >
                <img src="{{ asset('images/master.png') }}" 
                    alt="MasterCard" class="w-16 h-10 cursor-pointer hover:scale-110 transition"
                    @click="cardType = 'mastercard'"
                    :class="cardType === 'mastercard' ? 'ring-4 ring-pink-400 rounded' : ''"
                >
            </div>

            <form @submit.prevent="submitBankDeposit" class="space-y-4 mt-6">
                @csrf
                <input type="text" x-model="form.card_name" placeholder="Cardholder Name" required
                    class="w-full p-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <input type="text" x-model="form.card_number" placeholder="Card Number" required
                    class="w-full p-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-400">
                <div class="flex space-x-4">
                    <input type="text" x-model="form.expiry" placeholder="Expiry Date (MM/YY)" required
                        class="w-1/2 p-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    <input type="text" x-model="form.cvv" placeholder="CVV" required
                        class="w-1/2 p-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-400">
                </div>
                <button type="submit"
                    class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 rounded-xl mt-4 transition">
                    Pay Now
                </button>
                <button type="button"
                    @click="window.location.href='/track-order'"
                    class="w-full bg-gray-400 hover:bg-gray-500 text-white font-semibold py-3 rounded-xl mt-4 transition">
                    Track Your Order
                </button>
            </form>
        </div>

        <!-- Online Transfer Form -->
        <div x-show="method === 'online'" x-transition class="space-y-4" x-cloak>
           <h3 class="text-xl font-semibold text-gray-700 text-center">Bank app Transferr</h3>

<div class="text-center mt-2 mb-4">
    <p class="text-gray-700"><strong>Bank Name:</strong> BOC Bank</p>
    <p class="text-gray-700"><strong>Account Number:</strong> 123456789</p>
    <p class="text-gray-700"><strong>Account Name:</strong> Train Eats Pvt Ltd</p>
    <p class="text-gray-700"><strong>Bank Branch:</strong> Colombo 10</p>
</div>

<p class="text-gray-600 text-center">Transfer to our bank and upload your transaction receipt.</p>


            <form class="space-y-4 mt-6" @submit.prevent="
                successMessage = 'Your receipt has been submitted successfully!';
                setTimeout(() => successMessage = '', 5000);
            ">
                <input type="text" placeholder="Transaction ID" required
                    class="w-full p-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-400">
                <input type="file" required
                    class="w-full p-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-400">
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-xl mt-4 transition">
                    Submit Receipt
                </button>
                <button type="button"
                    @click="window.location.href='/track-order'"
                    class="w-full bg-gray-400 hover:bg-gray-500 text-white font-semibold py-3 rounded-xl mt-4 transition">
                    Track Your Order
                </button>
            </form>
        </div>
    </section>
</main>

<script>
    function paymentApp() {
        return {
            method: 'bank',
            cardType: '',
            successMessage: '',
            form: {
                card_name: '',
                card_number: '',
                expiry: '',
                cvv: ''
            },
            submitBankDeposit() {
                // Always show success message on click
                this.successMessage = 'Payment Successful!';
                this.form = { card_name: '', card_number: '', expiry: '', cvv: '' };
                setTimeout(() => this.successMessage = '', 5000);
            }
        }
    }
</script>

<br>
 <footer class="footer">
        <p>© 2025 TRAIN EATS</p>
    </footer>

</body>
</html>
