<h1>Order Successful!</h1>
@foreach ($orders as $order)
    <p>Your order number is: {{ $order->order_number }}</p>
@endforeach
