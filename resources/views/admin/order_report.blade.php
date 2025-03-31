

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Report</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  @include('admin.reportcss')
</head>
<body>
    <div class="container">
        <header>
            <div class="header-left">
                <div class="logo">
                    <img src="{{asset('pic/vireakroth.png')}}" alt="Company Logo" id="company-logo">
                </div>
                <div class="company-info">
                    <h1>VireakRoth</h1>
                    <p>123 Business Street</p>
                    <p>City, Country</p>
                    <p>Phone: (123) 456-7890</p>
                </div>
            </div>
            <div class="report-info">
                <h2>Order Report</h2>
                <p>Date: <span>{{ request('start_date') }} - {{ request('end_date') }}</span></p>
            </div>
        </header>


        <section class="order-details">
            <h3>Order Details</h3>
            <table>
                <thead>
                    <tr>
                        <th>Order Date</th>
                        <th style="text-align: center;">Total Order</th>
                        <th style="text-align: center;">Total Items</th>
                        <th style="text-align: right;">Total Price</th>
                    </tr>
                </thead>
                @foreach($orders as $order)
            <tbody>
                    <tr>
                        <td>{{ $order->order_date }}</td>
                        <td style="text-align: center;">{{ $order->unique_orders }}</td>
                        <td style="text-align: center;">{{ $order->total_items }}</td>
                        <td style="text-align: right;">${{ number_format($order->total_sales, 2) }}</td>
                    </tr>
                </tbody>
                @endforeach
                <tfoot>
                   
                    <tr>
                        <td colspan="3" style="text-align: right;">Total:</td>
                        <td style="text-align: right;">${{ number_format($grandTotalSales, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </section>

        <section class="notes">
            <h3>Additional Notes</h3>
            <p>Thank you for your business! Payment is due within 30 days.</p>
        </section>

        <footer>
            <div class="signature">
                <div class="sign-line"></div>
                <p>Authorized Signature</p>
            </div>
            <div class="terms">
                <p>Terms & Conditions Apply</p>
            </div>
        </footer>
    </div>
    <a href="#" class="download-button" onclick="window.print(); return false;">Print</a>
</body>
</html>
