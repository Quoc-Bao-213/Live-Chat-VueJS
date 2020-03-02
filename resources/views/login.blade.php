<!DOCTYPE html>
<html>
<head>
    <title>Admin - CMS</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.css">
    <style>
        form{
            background: black;
            background-color: #00000087;
        }
        a{
            text-decoration: none;
            color: white;
            transition: 0.5s;
        }
        a:hover{
            color: #2ecc71
        }
    </style>
</head>
<body>
    @if(session('notify'))
        <script type="text/javascript">Swal.fire('Email or Password doesn\'t exits', '{{session('notify')}}', 'error')</script>
    @endif
    <form class="box" method="POST" action="" >
        @csrf
        <h1>Login</h1>
        <input type="text" name="email" id="tai_khoan" placeholder="Email" required="">
        <input type="password" name="password" id="mat_khau" placeholder="Password" required="">
        <button class="btn btn-danger btn-block" type="submit"> Login </button>
        <a href="{{ url('fr/register') }}">Register Here!</a>
    </form>
</body>
</html>

