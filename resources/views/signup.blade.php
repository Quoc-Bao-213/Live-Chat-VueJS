<!DOCTYPE html>
<html lang="en">

<!-- Head -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, shrink-to-fit=no">
    <title>Sign Up</title>

    <!-- Template core CSS -->

    <link href="assets/template.css" rel="stylesheet">
    <link href="assets/template_002.css" rel="stylesheet" media="(prefers-color-scheme: dark)">


</head>
<!-- Head -->

<body>

    <div class="layout">

        <div class="container d-flex flex-column">
            <div class="row align-items-center justify-content-center no-gutters min-vh-100">

                <div class="col-12 col-md-5 col-lg-4 py-8 py-md-11">

                    @if(session('notifyRegister'))
                        <div class="alert alert-success" style="text-align: center;" role="alert">
                            {{ session('notifyRegister') }}
                        </div>
                        @elseif (session('error'))
                            <div class="alert alert-error" style="text-align: center;" role="alert">
                                {{ session('error') }}
                            </div>
                    @endif


                    <!-- Heading -->
                    <h1 class="font-bold text-center">Sign up</h1>

                    <!-- Text -->
                    <p class="text-center mb-6">Welcome to the official Chat web-client.</p>

                    <!-- Form -->
                <form class="mb-6" method="post" action="{{ route('actionRegister') }}">
                    @csrf
                        <!-- Name -->
                        <div class="form-group">
                            <label for="name" class="sr-only">Name</label>
                            <input type="text" name="username" class="form-control form-control-lg" id="name" placeholder="Enter your name">
                            <span class="text-danger" style="margin-left: 10px;">{{ $errors->first('username') }}</span>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email" class="sr-only">Email Address</label>
                            <input type="text" name="email" class="form-control form-control-lg" id="email" placeholder="Enter your email">
                            <span class="text-danger" style="margin-left: 10px;">{{ $errors->first('email') }}</span>
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Enter your password">
                            <span class="text-danger" style="margin-left: 10px;">{{ $errors->first('password') }}</span>
                        </div>

                        <!-- Submit -->
                        <button class="btn btn-lg btn-block btn-primary" type="submit">Sign up</button>
                    </form>

                    <!-- Text -->
                    <p class="text-center">
                        Already have an account? <a href="{{ route('signin') }}">Sign in</a>.
                    </p>

                </div>
            </div> <!-- / .row -->
        </div>

    </div><!-- .layout -->

    <!-- Scripts -->
    <script src="assets/jquery.js"></script>
    <script src="assets/bootstrap.js"></script>
    <script src="assets/plugins.js"></script>
    <script src="assets/template.js"></script>
    <!-- Scripts -->


</body>

</html>
