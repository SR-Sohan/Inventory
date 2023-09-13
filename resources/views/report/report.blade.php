<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <style>
        .container{
            width: 95%;
            margin: 10px auto;
        }
        table{
            width: 100%;
            border-collapse: collapse;
        }
        table,td,th{
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
       table tr:nth-child(even){background-color: #f2f2f2;}

        table tr:hover {background-color: #ddd;}

        table th {
        padding-top: 12px;
        padding-bottom: 12px;
        background-color: #04AA6D;
        color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div>
        <h1>Sales Summary</h1>
        <table>
            <thead>
                <tr>
                    <th>Report</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Discount</th>
                    <th>Vat</th>
                    <th>Payable</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Sales Report</td>
                    <td>{{$fromDate}} To {{$toDate}}</td>
                    <td>${{$total}}</td>
                    <td>${{$discount}}</td>
                    <td>${{$vat}}</td>
                    <td>${{$payable}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="margin-top: 35px">
        <h1>Sales Details</h1>
        <table>
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Total</th>
                    <th>Discount</th>
                    <th>Vat</th>
                    <th>Payable</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($list as $item)
                <tr>
                    <td>{{$item->customer->name}}</td>
                    <td>{{$item->customer->mobile}}</td>
                    <td>${{$item->total}}</td>
                    <td>${{$item->discount}}</td>
                    <td>${{$item->vat}}</td>
                    <td>${{$item->payable}}</td>
                    <td>{{$item->created_at}}</td>
                </tr>
                @empty
                    
                @endforelse
               
            </tbody>
        </table>
    </div>
    </div>
    
</body>
</html>