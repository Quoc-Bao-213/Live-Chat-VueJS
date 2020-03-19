<!DOCTYPE html>
<html lang="en">

<!-- Head -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, shrink-to-fit=no">
    <title>Messenger - Responsive Bootstrap Application</title>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Template core CSS -->

    <link href="{{ asset('assets/template.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/template_002.css') }}" rel="stylesheet" media="(prefers-color-scheme: dark)">

</head>
<!-- Head -->

<body>
    <div id="app" class="layout">

        <!-- Navigation -->
        @include('nav.nav')
        <!-- Navigation -->

        <!-- Sidebar -->
        @include('sideBar.sideBar')
        <!-- Sidebar -->

        <!-- Main Content -->


        <div class="main main-visible" data-mobile-height="">

            <!-- Chat -->
            <div id="chat-2" class="chat dropzone-form-js" data-dz-url="#">
                <!-- Chat: body -->
                <chatfr user-id='{{ $curentPusherID }}'
                 friend-name="{{ $FriendName }}" 
                 img-friend='{{ $avatar }}' 
                 img-sender='{{ Auth::user()->avatar }}' 
                 room-id= '{{ $room_Id }}' 
                 :initial-messages='@json($messages)'> </chatfr>
                <!-- Chat: body -->
            </div>
            <!-- Chat -->

        </div>
        <!-- Main Content -->

    </div>
    <!-- Layout -->

    <!-- DropzoneJS: Template -->
   
    <!-- DropzoneJS: Template -->

    <!-- Scripts -->
    <script src="{{ asset('assets/jquery.js') }}"></script>
    <script src="{{ asset('assets/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/plugins.js') }}"></script>
    <script src="{{ asset('assets/template.js') }}"></script>
    <!-- Scripts -->

</body>

</html>
