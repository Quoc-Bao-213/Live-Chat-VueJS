@extends('layouts.general')
{{--  --}}

@section('sweetalert')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>
@endsection

{{--  --}}
@section('layout')
<div class="layout">
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
    <div class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center no-gutters min-vh-100">

            <div class="col-12 col-md-5 col-lg-4 py-8 py-md-11">

                <!-- Heading -->
                <h1 class="font-bold text-center">Sign up</h1>

                <!-- Text -->
                <p class="text-center mb-6">Welcome to the official Chat web-client.</p>

                <!-- Form -->
                <form class="mb-6" method="POST" action="">
                    @csrf
                    <!-- Name -->   
                    <div class="form-group">
                        <label for="name" class="sr-only">Name</label>
                        <input type="text" class="form-control form-control-lg" name="username" id="name" placeholder="Enter your name">
                        <span style="color: red;">{{ $errors->first('username') }}</span>
                    </div>

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

                    <!-- Submit -->
                    <button class="btn btn-lg btn-block btn-primary" type="submit">Sign up</button>
                </form>

                <!-- Text -->
                <p class="text-center">
                Already have an account? <a href="{{ route("signin") }}">Sign in</a>.
                </p>

            </div>
        </div> <!-- / .row -->
    </div>

</div><!-- .layout -->
@endsection