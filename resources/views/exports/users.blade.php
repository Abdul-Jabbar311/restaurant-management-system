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

<h2>Users Report</h2>

<table>

<thead>

<tr>

<th>#</th>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($users as $user)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $user->name }}</td>

<td>{{ $user->email }}</td>

<td>{{ $user->role->name }}</td>

<td>{{ $user->is_active ? 'Active' : 'Inactive' }}</td>

</tr>

@endforeach

</tbody>

</table>

</body>
</html>