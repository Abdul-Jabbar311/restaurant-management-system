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

<h2 align="center">Menu Items Report</h2>

<table>

<thead>

<tr>

<th>#</th>
<th>Name</th>
<th>Category</th>
<th>Price</th>

</tr>

</thead>

<tbody>

@foreach($menuItems as $item)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $item->name }}</td>

<td>{{ $item->category->name ?? '-' }}</td>

<td>Rs {{ number_format($item->price,2) }}</td>

</tr>

@endforeach

</tbody>

</table>

</body>

</html>