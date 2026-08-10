<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<style>

body{

font-family: DejaVu Sans;

font-size:12px;

}

table{

width:100%;

border-collapse:collapse;

}

th,td{

border:1px solid #000;

padding:8px;

text-align:left;

}

th{

background:#eeeeee;

}

h2{

text-align:center;

}

</style>

</head>

<body>

<h2>Restaurant Orders Report</h2>

<table>

<thead>

<tr>

<th>#</th>

<th>Order</th>

<th>Customer</th>

<th>Total</th>

<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($orders as $order)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $order->order_number }}</td>

<td>{{ $order->customer->name ?? '-' }}</td>

<td>Rs {{ number_format($order->total_amount,2) }}</td>

<td>{{ $order->status }}</td>

</tr>

@endforeach

</tbody>

</table>

</body>

</html>