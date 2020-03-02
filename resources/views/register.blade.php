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
        <input type="text" name="username" id="username" placeholder="Username" required="">
        <input type="password" name="password" id="password" placeholder="Password" required="">
        <input type="text" name="email" id="email" placeholder="Email" required="">
        <input type="text" name="avatar" id="avatar" placeholder="Avatar" required="">
        <button class="btn btn-danger btn-block" type="submit"> Register </button>
    </form>
</body>
</html>
