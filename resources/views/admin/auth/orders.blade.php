<!DOCTYPE html>
<html>
<head>
    <title>Order Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 190px;
            background-color:rgb(246, 193, 81);
            color: black;
            padding: 1rem;
            flex-shrink: 0;
        }

        .sidebar a {
            color:rgb(4, 4, 5);
            text-decoration: none;
            display: block;
            padding:  0.75rem;
            border-radius: 0.3rem;
            margin-bottom: 0.30rem;
            transition: background-color 0.2s ease;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background-color:rgb(242, 117, 8);
            color: #fff;
        }

        .container {
            flex: 1;
            padding: 30px;
            background: #fff;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #f0f0f0;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            color: white;
            border-radius: 5px;
            font-size: 0.85em;
        }

        .badge-success {
            background: #28a745;
        }

        .badge-pending {
            background: rgb(19, 255, 7);
            color: black;
        }

        .badge-failed {
            background: #dc3545;
        }

        button.btn {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            font-size: 0.9em;
            cursor: pointer;
        }
        .sidebar h4 {
            font-size: 1.5rem;
            font-weight: 550;
            margin-top: 0;
            margin-bottom: 2rem;
            text-align: center; /* Center the text */
}
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .w-100 {
            width: 100%;
        }

        .mt-5 {
            margin-top: 2rem;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

<div class="layout">
    <!-- Sidebar -->
    <nav class="sidebar">
        <h4 class="mb-4">🧑‍💼 Admin Panel</h4>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">Users</a>
        <a href="#">Orders</a>
        <a href="{{ route('admin.menu-items.index') }}" class="{{ request()->routeIs('admin.menu-items.index') ? 'active' : '' }}">Menu Items</a>
       <a href="{{ route('admin.feedback') }}" class="{{ request()->routeIs('admin.feedback') ? 'active' : '' }}">Reviews</a>
        <form method="POST" action="{{ route('admin.logout') }}" class="mt-5">
            @csrf
            <button type="submit" class="btn btn-danger w-100">Logout</button>
        </form>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <h2>🧾 Online Orders</h2>

      <div style="display: flex; justify-content: flex-end; margin-bottom: 15px;">
    <a href="{{ route('admin.orders.weekly-report') }}" 
       target="_blank" 
       title="View Weekly Report"
       style="
        text-decoration: none;
        background-color: #28a745;
        color: white;
        padding: 8px 14px;
        border-radius: 5px;
        font-weight: 600;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 6px;
    ">
        <span>📄 Weekly Report (View)</span>
    </a>
</div>

<!-- Add Cash Order Button -->

        @if($orders->isEmpty())
            <p>No orders found.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Ticket</th>
                        <th>Phone</th>
                        <th>Seat</th>
                        <th>Class</th>
                        <th>Compart name</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Ordered At</th>
                        <th>Payment Status</th>
                        <th>Order Status</th>
                        <th>Received Status</th>
                    </tr>
                </thead>
               <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->name }}</td>
            <td>{{ $order->ticket }}</td>
            <td>{{ $order->phone }}</td>
            <td>{{ $order->seat }}</td>
            <td>{{ $order->train_class }}</td>
            <td>{{ $order->class_name }}</td>
                            <td>
                                <ul>
                                    @foreach(json_decode($order->items, true) as $item)
                                        <li>{{ $item['name'] }} (x{{ $item['quantity'] }}) - Rs.{{ $item['price'] }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>Rs. {{ number_format($order->total, 2) }}</td>
                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                            <td>
    @if($order->payment_status === 'Success')
        <span class="badge badge-success">Success</span>
    @elseif($order->payment_status === 'Pending')
        <span class="badge badge-pending">Done</span>
    @else
        <span class="badge badge-failed">{{ $order->payment_status ?? 'N/A' }}</span>
    @endif
</td>
<td>
    <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}">
        @csrf
        @method('PUT')
        <select name="order_status" onchange="this.form.submit()">
            <option value="Pending" {{ $order->order_status === 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Preparing" {{ $order->order_status === 'Preparing' ? 'selected' : '' }}>Preparing</option>
            <option value="Delivering" {{ $order->order_status === 'Delivering' ? 'selected' : '' }}>Delivering</option>
            <option value="Cancelled" {{ $order->order_status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
    </form>
</td>
<td>
    @if($order->order_status === 'Received')
        <span class="badge badge-success" style="background-color: #28a745; color: white; padding: 5px 10px; border-radius: 5px;">
            Received
        </span>
    @else
        <span class="badge badge-secondary" style="background-color: #6c757d; color: white; padding: 5px 10px; border-radius: 5px;">
            Not Received
        </span>
    @endif
</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif


</div>


<script>
document.getElementById('openModalBtn').onclick = () => {
    document.getElementById('cashOrderModal').style.display = 'block';
};
document.getElementById('closeModalBtn').onclick = () => {
    document.getElementById('cashOrderModal').style.display = 'none';
};

// Modal Item Handling
const modalSelect = document.getElementById('modalMenuItemSelect');
const modalQty = document.getElementById('modalQuantityInput');
const modalAddBtn = document.getElementById('modalAddItemBtn');
const modalTableBody = document.querySelector('#modalItemsTable tbody');
const modalItemsJsonInput = document.getElementById('modalItemsJsonInput');

let modalItems = [];

function renderModalItems() {
    modalTableBody.innerHTML = '';
    let total = 0;

    modalItems.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;

        modalTableBody.innerHTML += `
            <tr>
                <td>${item.name}</td>
                <td>Rs.${item.price}</td>
                <td>${item.quantity}</td>
                <td>Rs.${itemTotal}</td>
                <td><button type="button" onclick="removeModalItem(${index})" style="background:red;color:white;border:none;border-radius:4px;padding:4px 8px;">X</button></td>
            </tr>`;
    });

    // Add a total row at the bottom if items exist
    if (modalItems.length > 0) {
        modalTableBody.innerHTML += `
            <tr style="font-weight:bold; background:#f0f0f0;">
                <td colspan="3" style="text-align:right;">Grand Total:</td>
                <td>Rs.${total}</td>
                <td></td>
            </tr>`;
    }

    modalItemsJsonInput.value = JSON.stringify(modalItems);
}

function removeModalItem(index) {
    modalItems.splice(index, 1);
    renderModalItems();
}

modalAddBtn.onclick = () => {
    const selected = modalSelect.options[modalSelect.selectedIndex];
    const id = modalSelect.value;
    const name = selected.getAttribute('data-name');
    const price = parseFloat(selected.getAttribute('data-price'));
    const qty = parseInt(modalQty.value);

    if (!id || !qty || qty < 1 || isNaN(price)) {
        alert('Select a valid item and quantity.');
        return;
    }

    const existing = modalItems.findIndex(i => i.id === id);
    if (existing >= 0) {
        modalItems[existing].quantity += qty;
    } else {
        modalItems.push({id, name, price, quantity: qty});
    }

    renderModalItems();
    modalSelect.value = '';
    modalQty.value = '';
}

// Before form submit: validate and serialize items
function prepareModalItems() {
    if (modalItems.length === 0) {
        alert("Please add at least one item.");
        return false;
    }
    modalItemsJsonInput.value = JSON.stringify(modalItems);
    return true;
}
</script>

</body>
</html>
