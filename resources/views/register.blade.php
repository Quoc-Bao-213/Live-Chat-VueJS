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
        <script type="text/javascript">Swal.fire('{{session('notify')}}')</script>
    @elseif(session('error'))
        <script type="text/javascript">
            Swal.fire({
                icon: 'Error',
                title: 'Oops...',
                text: 'Your email already exists!',})
        </script>
    @endif
    <form class="box" method="POST" action="" >
        @csrf
        <h1>Register</h1>
        <input type="text" name="username" id="username" placeholder="Username">
        <span style="color: red;">{{ $errors->first('username') }}</span>
        <input type="text" name="email" id="email" placeholder="Email">
        <span style="color: red;">{{ $errors->first('email') }}</span>
        <input type="password" name="password" id="password" placeholder="Password">
        <span style="color: red;">{{ $errors->first('password') }}</span>
        <input type="text" name="avatar" id="avatar" placeholder="Avatar">
        {{-- <span style="color: red;">{{ $errors->first('avatar') }}</span> --}}
        <button class="btn btn-danger btn-block" type="submit"> Register </button>
        <a href="{{ url('fr/login') }}">Login Here!</a>
    </form>
</body>
</html>
