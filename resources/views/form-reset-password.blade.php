<!DOCTYPE html>
<html lang="en">

<!-- Head -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, shrink-to-fit=no">
    <title>Change Password</title>

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
                    <h1 class="font-bold text-center">Change Password</h1>
                    {{-- for {{ '@'.$name ??  }} --}}
                    <!-- Text -->
                    <p class="text-center mb-6">Enter your new password.</p>

                    <!-- Form -->
                    <form class="mb-6" method="post" action="#">
                        @if(session('notify'))
                        <div class="alert alert-success" style="text-align: center;" role="alert">
                            {{ session('notify') }}
                        </div>
                        @endif
                        @csrf
                        <!-- Email -->

                        <!-- Password -->
                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Enter your password">
                            <span class="text-danger" style="display:block; margin-left: 10px;">{{ $errors->first('password') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="password" class="sr-only">Confirm Password</label>
                            <input type="password" name="confirmpassword" class="form-control form-control-lg" id="password" placeholder="Confirm your password">
                            <span class="text-danger" style="display:block; margin-left: 10px;">{{ $errors->first('confirmpassword') }}</span>
                        </div>

                        <!-- Submit -->
                        <button class="btn btn-lg btn-block btn-primary" type="submit">Reset password</button>
                    </form>

                    <p class="text-center">
                        Click here to <a href="{{ route('signin')}}">Sign in</a>.
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
