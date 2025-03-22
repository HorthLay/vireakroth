{{-- <!DOCTYPE html>
<html>
<head>
    <title>Order Report</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 10px; text-align: center; }
        th { background-color: #f2f2f2; }
        h2 { color: #007bff; }
    </style>
</head>
<body>

    <h2>Order Report</h2>
    <p>Date Range: {{ request('start_date') }} - {{ request('end_date') }}</p>

    <table>
        <thead>
            <tr>
                <th>Order Date</th>
                <th>Total Orders</th>
                <th>Total Sales</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->order_date }}</td>
                <td>{{ $order->total_orders }}</td>
                <td>${{ number_format($order->total_sales, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html> --}}





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Report</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.5;
            color: #333;
            background-color: #f5f5f5;
            font-weight: 400;
        }
        
        .container {
            width: 210mm;
            min-height: 297mm;
            margin: 20px auto;
            padding: 25mm 20mm;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            border-bottom: 2px solid #eee;
            padding-bottom: 15px;
        }
        
        .header-left {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        
        .logo {
            flex-shrink: 0;
        }
        
        #company-logo {
            max-width: 120px;
            height: auto;
            display: block;
        }
        
        .company-info {
            padding-left: 15px;
            border-left: 1px solid #eee;
        }
        
        .company-info h1 {
            color: #2c3e50;
            font-size: 20px;
            margin-bottom: 8px;
            font-weight: 600;
        }
        
        .company-info p {
            color: #666;
            font-size: 12px;
            margin-bottom: 4px;
            font-weight: 300;
        }
        
        .report-info h2 {
            color: #2c3e50;
            font-size: 18px;
            margin-bottom: 8px;
            font-weight: 600;
        }
        
        .report-info p {
            color: #666;
            font-size: 12px;
            margin-bottom: 4px;
            font-weight: 400;
        }
        
        h3 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 16px;
            font-weight: 500;
        }
        
        .customer-details {
            margin-bottom: 30px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        
        .info-item {
            display: flex;
            flex-direction: column;
        }
        
        .info-item label {
            font-weight: 500;
            color: #666;
            font-size: 12px;
            margin-bottom: 4px;
        }
        
        .info-item span {
            color: #333;
            font-weight: 400;
            font-size: 13px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            font-size: 13px;
        }
        
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        
        th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #2c3e50;
        }
        
        tfoot tr {
            font-weight: 500;
        }
        
        tfoot td {
            border-top: 2px solid #eee;
        }
        
        .notes {
            margin-bottom: 30px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }
        
        .notes p {
            color: #666;
            font-weight: 300;
            font-size: 12px;
        }
        
        footer {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        
        .signature {
            text-align: center;
        }
        
        .sign-line {
            width: 160px;
            height: 1px;
            background-color: #333;
            margin-bottom: 8px;
        }
        
        .terms {
            color: #666;
            font-size: 11px;
            font-weight: 300;
        }
        
        .download-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #2c3e50;
            color: white;
            padding: 12px 24px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .download-button:hover {
            background-color: #34495e;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        @media print {
            body {
                background: white;
                margin: 0;
                padding: 0;
            }
            .container {
                width: 100%;
                min-height: auto;
                margin: 0;
                padding: 15mm;
                box-shadow: none;
            }
            .download-button {
                display: none;
            }
            @page {
                size: A4;
                margin: 0;
            }
        }
    </style>
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
                        <th>Total Items</th>
                        <th>Total Order</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                @foreach($orders as $order)
            <tbody>
                    <tr>
                        <td>{{ $order->order_date }}</td>
                        <td>{{ $order->total_items }}</td>
                        <td>{{ $order->unique_orders }}</td>
                        <td>${{ number_format($order->total_sales, 2) }}</td>
                    </tr>
                </tbody>
                @endforeach
                <tfoot>
                   
                    <tr>
                        <td colspan="3">Total</td>
                        <td>${{ number_format($grandTotalSales, 2) }}</td>
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
