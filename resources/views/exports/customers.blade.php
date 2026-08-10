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
border:1px solid black;
padding:8px;
}

th{
background:#eee;
}

</style>

</head>

<body>

<h2 align="center">Customers Report</h2>

<table>

<thead>

<tr>

<th>#</th>
<th>Name</th>
<th>Phone</th>
<th>Email</th>

</tr>

</thead>

<tbody>

@foreach($customers as $customer)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $customer->name }}</td>

<td>{{ $customer->phone }}</td>

<td>{{ $customer->email }}</td>

</tr>

@endforeach

</tbody>

</table>

</body>

</html>