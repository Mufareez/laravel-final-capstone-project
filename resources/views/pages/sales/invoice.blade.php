<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body onload="window.print()">

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header">
                    <h1>Sales Invoice No {{ $sales->invoice_number }}</h1>
                    <h1>Sales Date {{ $sales->sale_date }}</h1>
                    <h1>Customer Name {{ $sales->customer->customer_name }}</h1>
                    <h1>Total {{ $sales->total }}</h1>
                    <h1>Final Discount {{ $sales->final_discount }}</h1>
                    <h1>Final Total {{ $sales->final_total }}</h1>
                </div>
            </div>
        </div>
    <table class="datatable table table-stripped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Selling Price</th>
                <th>Discount</th>
                <th>Final Total</th>
            </tr>
        </thead>
        @foreach ($sales->saleItems as $index=> $item)
            <tbody>
                <tr>
                    <td>{{ $index +1}}</td>
                    <td>{{ $item->product->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->selling_price }}</td>
                    <td>{{ $item->discount }}</td>
                    <td>{{ $item->final_price }}</td>
                </tr>
            </tbody>
        @endforeach
    </table>


    <script>
        window.onafterprint = function() {
            window.location.href = "{{ route('sales.create') }}";
        };
    </script>
</body>

</html>
