@extends('layouts.general')
{{--  --}}

@section('sweetalert')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>
@endsection

{{--  --}}
@section('layout')
<div class="layout">
   
    <div class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center no-gutters min-vh-100">

            <div class="col-12 col-md-5 col-lg-4 py-8 py-md-11">
                @if(session('notify'))
                    <div class="alert alert-success" role="alert">
                        {{ session('notify') }}
                    </div>
                @endif
                <!-- Heading -->
                <h1 class="font-bold text-center">Sign in</h1>

                <!-- Text -->
                <p class="text-center mb-6">Welcome to the official Chat web-client.</p>

                <!-- Form -->
                <form class="mb-6" method="POST" action="">
                    @csrf
                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="sr-only">Email Address</label>
                        <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="Enter your email">
                        <span style="color: red;">{{ $errors->first('email') }}</span>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="sr-only">Password</label>
                        <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Enter your password">
                        <span style="color: red;">{{ $errors->first('password') }}</span>
                    </div>

                    <div class="form-group d-flex justify-content-between">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" checked="" id="checkbox-remember">
                            <label class="custom-control-label" for="checkbox-remember">Remember me</label>
                          
                        </div>
                        {{-- <a href="./password-reset.html">Reset password</a> --}}
                    </div>

                    <!-- Submit -->
                    <button class="btn btn-lg btn-block btn-primary" type="submit">Sign in</button>
                </form>

                <!-- Text -->
                <p class="text-center">
                    Don't have an account yet <a href="{{ route("signup") }}">Sign up</a>.
                </p>

            </div>
        </div> <!-- / .row -->
    </div>

</div><!-- .layout -->
@endsection