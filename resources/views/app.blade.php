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

    <style>

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        ul {
            margin: 0;
            padding: 0;
        }

        li {
            list-style: none;
        }

        .user-wrapper {
            border: 1px solid #dddddd;
            overflow-y: auto;
        }

        .user-wrapper {
            height: 58.8vh;
        }

        .room {
            cursor: pointer;
            padding: 5px 0;
            position: relative;
        }

        .room:hover {
            background: #eeeeee;
        }

        .room:last-child {
            margin-bottom: 0;
        }

        .pending {
            position: absolute;
            left: 13px;
            top: 9px;
            background: #b600ff;
            margin: 0;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            line-height: 18px;
            padding-left: 5px;
            color: #ffffff;
            font-size: 12px;
        }

        .media-left {
            margin: 0 10px;
        }

        .media-left img {
            width: 64px;
            border-radius: 64px;
        }

        .media-body p {
            margin: 6px 15px;
        }

        .media-body {
            margin-top: 14px;
        }

        .active {
            background: #eeeeee;
        }

        .card-body {
            height: 500px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <a class="navbar-brand" href="#">{{ Str::upper(Auth::user()->name) }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <div class="top-right links">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                Leave Chat Room
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
      </li>
    </ul>

  </div>
</nav>

    <div id="app" class="flex-center position-ref full-height">
        <div class="container">
            <div class="row">
                <div class="col-md-4">

                    <div class="card">
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
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">Current Chat With: {{ $friendName }}</div>
                        <chatfr user-id='{{ $id_pusher }}' room-id='{{ $room_Id }}' :initial-messages='@json($messages)'> </chatfr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
