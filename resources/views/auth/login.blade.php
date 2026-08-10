<!DOCTYPE html>
<html>
<head>

    <title>Restaurant Management System</title>

    <style>

        body{
            font-family:Arial;
            background:#f4f4f4;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .login-box{
            width:350px;
            background:white;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,.1);
        }

        input{
            width:100%;
            padding:10px;
            margin-top:10px;
            margin-bottom:15px;
        }

        button{
            width:100%;
            padding:10px;
            background:#0d6efd;
            color:white;
            border:none;
            cursor:pointer;
        }

        .error{
            color:red;
            margin-bottom:15px;
        }

    </style>

</head>
<body>

<div class="login-box">

<h2>Restaurant Login</h2>

@if($errors->any())

<div class="error">
{{ $errors->first() }}
</div>

@endif

<form method="POST" action="{{ route('login.submit') }}">

@csrf

<input
type="email"
name="email"
placeholder="Email"
required>

<input
type="password"
name="password"
placeholder="Password"
required>

<button type="submit">

Login

</button>

</form>

</div>

</body>
</html>