<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Live Chat</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/chatbox.css') }}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>

<body>
    @include('nav.nav')
    <div id="app" class="appchat">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card max-height">
                        <div class="card-header">List Friends</div>
                        <div class="card-body">
                            <div id="chatbox">
                                <ul class="rooms">
                                    @foreach ($listFriends as $friend)
                                    @if ($friend->id_pusher != Auth::user()->id_pusher )
                                    <li class="room" name="roomid" id="">
                                         {{-- <span class="pending"></span> --}}
                                        <div class="media">
                                            <div class="media-left">
                                                <img src="{{ $friend->avatar }}" alt="" class="media-object">
                                            </div>
                                            <div class="media-body">
                                                <a href="/fr/{{ $friend->id_pusher }}">
                                                    <p class="name">{{ $friend->name }}</p>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card max-height">
                        <div class="card-header">Friend</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
