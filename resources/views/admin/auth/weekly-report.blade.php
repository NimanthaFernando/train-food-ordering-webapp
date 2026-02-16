<!DOCTYPE html>
<html>
<head>
    <title>Weekly Orders Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: white;
            padding: 40px;
            color: #000;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }
        th {
            background-color: #f0f0f0;
        }
        tr:nth-child(even) {
            background-color: #fcfcfc;
        }
        ul {
            margin: 0;
            padding-left: 18px;
        }
    </style>
</head>
<body>

<h2>📄 Weekly Orders Report</h2>

@if($orders->isEmpty())
    <p>No orders found in the last 7 days.</p>
@else
    <table>
        <thead>
            <tr>
                <th>Customer</th>
                <th>Ticket</th>
                <th>Phone</th>
                <th>Items</th>
                <th>Total</th>
                <th>Ordered At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->ticket }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>
                        <ul>
                            @foreach($order->items as $item)
                                <li>{{ $item['name'] }} (x{{ $item['quantity'] }}) - Rs.{{ $item['price'] }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>Rs. {{ number_format($order->total, 2) }}</td>
                    <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

</body>
</html>
