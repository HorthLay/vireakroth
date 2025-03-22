<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details | Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h1 class="mb-4">Order Details ({{ \Carbon\Carbon::parse($order_date)->format('d-m-Y') }})</h1>

    <a href="{{ route('order.reports') }}" class="btn btn-secondary mb-3">Back to Reports</a>

    <!-- Order Details Table -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Orders on {{ \Carbon\Carbon::parse($order_date)->format('d-m-Y') }}</h5>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Order Number</th>
                        <th>Customer Name</th>
                        <th>Items</th>
                        <th>Total Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->name }}</td>
                        <td>
                            <ul>
                                @foreach ($order->items as $item)
                                    <li>{{ $item->product_name }} ({{ $item->quantity }})</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>${{ number_format($order->total_price, 2) }}</td>
                        <td>
                            @if ($order->status === 'completed')
                                <span class="badge bg-success">Completed</span>
                            @else
                                <span class="badge bg-warning">Pending</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
