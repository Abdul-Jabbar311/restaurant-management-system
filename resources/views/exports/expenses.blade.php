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

<h2 align="center">Expenses Report</h2>

<table>

<thead>

<tr>

<th>#</th>
<th>Title</th>
<th>Amount</th>
<th>Date</th>

</tr>

</thead>

<tbody>

@foreach($expenses as $expense)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $expense->title }}</td>

<td>Rs {{ number_format($expense->amount,2) }}</td>

<td>{{ $expense->expense_date }}</td>

</tr>

@endforeach

</tbody>

</table>

</body>

</html>