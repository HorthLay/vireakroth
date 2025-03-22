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

    <a href="{{url('/report')}}" class="btn btn-secondary mb-3">Back to Reports</a>

    <div class="card">
        <div class="card-body">
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
                    @if ($orders && $orders->count() > 0)
                        @php
                            $groupedOrders = $orders->groupBy('order_number');
                        @endphp
                
                        @foreach ($groupedOrders as $orderNumber => $group)
                            <tr>
                                <td>{{ $orderNumber }}</td>
                                <td>
                                    {{ $group->pluck('name')->unique()->implode(', ') }}
                                </td>
                                <td>
                                    <a href="{{ url('/order_details', ['order_number' => $orderNumber]) }}" class="btn btn-info">View</a>
                                </td>
                                <td>${{ number_format($group->sum('total_price'), 2) }}</td>
                                <td>
                                    @if ($group->first()->status === 'success')
                                        <span class="badge bg-success">Completed</span>
                                    @elseif ($group->first()->status === 'canceled')
                                        <span class="badge bg-danger">Canceled</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">No orders found for this date.</td>
                        </tr>
                    @endif
                </tbody>
                
                
                
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>