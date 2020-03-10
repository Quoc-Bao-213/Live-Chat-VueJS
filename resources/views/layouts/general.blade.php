
<!DOCTYPE html>
<html lang="en">

    <!-- Head -->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, shrink-to-fit=no">
        <title>Messenger - Responsive Bootstrap Application</title>

        <!-- Template core CSS -->
       @yield('sweetalert')
       @include('layouts.css')
       

        
    </head>
    <!-- Head -->

    <body>
        @yield('layout')
    
        <!-- Scripts -->
        @include('layouts.js')
        <!-- Scripts -->
      

    </body>
</html>