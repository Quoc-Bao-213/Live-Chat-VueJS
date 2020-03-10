<!DOCTYPE html>
<html lang="en">

<!-- Head -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, shrink-to-fit=no">
    <title>Sign In</title>

    <!-- Template core CSS -->

    <link href="{{ asset('assets/template.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/template_002.css') }}" rel="stylesheet" media="(prefers-color-scheme: dark)">



</head>
<!-- Head -->

<body>

    <div class="layout">

        <div class="container d-flex flex-column">
            <div class="row align-items-center justify-content-center no-gutters min-vh-100">

                <div class="col-12 col-md-5 col-lg-4 py-8 py-md-11">

                    @if(session('notify'))
                        <div class="alert alert-danger" style="text-align: center;" role="alert">
                            {{ session('notify') }}
                        </div>
                    @endif

                    <!-- Heading -->
                    <h1 class="font-bold text-center">Sign in</h1>

                    <!-- Text -->
                    <p class="text-center mb-6">Welcome to the official Chat web-client.</p>

                    <!-- Form -->
                    <form class="mb-6" method="post" action="{{ route('actionLogin') }}">
                        @csrf
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

                        {{-- Comming Soon --}}
                        <div class="form-group d-flex justify-content-between">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" checked="" id="checkbox-remember">
                                <label class="custom-control-label" for="checkbox-remember">Remember me</label>
                            </div>
                            <a href="#">Reset password</a>
                        </div>
                        {{-- Comming Soon --}}

                        <!-- Submit -->
                        <button class="btn btn-lg btn-block btn-primary" type="submit">Sign in</button>
                    </form>

                    <!-- Text -->
                    <p class="text-center">
                        Don't have an account yet <a href="{{ route('signup') }}">Sign up</a>.
                    </p>

                </div>
            </div> <!-- / .row -->
        </div>

    </div><!-- .layout -->

    <!-- Scripts -->
    <script src="{{ asset('assets/jquery.js') }}"></script>
    <script src="{{ asset('assets/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/plugins.js') }}"></script>
    <script src="{{ asset('assets/template.js') }}"></script>
    <!-- Scripts -->

</body>

</html>
