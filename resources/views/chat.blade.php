  <!-- resources/views/chat.blade.php -->
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

      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

      <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
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
        ul{
            margin: 0;
            padding: 0;
        }

        li{
            list-style: none;
        }

        .user-wrapper{
            border: 1px solid #dddddd;
            overflow-y: auto;
        }

        .user-wrapper{
            height: 58.8vh;
        }

        .room{
            cursor: pointer;
            padding: 5px 0;
            position: relative;
        }

        .room:hover{
            background: #eeeeee;
        }

        .room:last-child{
            margin-bottom: 0;
        }

        .pending{
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

        .media-left{
            margin: 0 10px;
        }

        .media-left img{
            width: 64px;
            border-radius: 64px;
        }

        .media-body p{
            margin: 6px 0;
        }
      </style>
  </head>
  <body>
      <div id="app" class="flex-center position-ref full-height">
        <div class="top-right links">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                Leave Chat Room
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
          <div class="container">
              <div class="row">
                <div class="col-md-4">
                    <div class="user-wrapper">
                        <ul class="rooms">
                            <li class="room" id="">
                                <span class="pending"></span>
                                <div class="media">
                                    <div class="media-left">
                                        <img src="https://via.placeholder.com/150" alt="" class="media-object">
                                    </div>
                                    <div class="media-body">
                                        <p class="name">Room 1</p>
                                    </div>
                                </div>
                            </li>
                            <li class="room" id="">
                                <span class="pending"></span>
                                <div class="media">
                                    <div class="media-left">
                                        <img src="https://via.placeholder.com/150" alt="" class="media-object">
                                    </div>
                                    <div class="media-body">
                                        <p class="name">Room 2</p>
                                    </div>
                                </div>
                            </li>
                            <li class="room" id="">
                                <span class="pending"></span>
                                <div class="media">
                                    <div class="media-left">
                                        <img src="https://via.placeholder.com/150" alt="" class="media-object">
                                    </div>
                                    <div class="media-body">
                                        <p class="name">Room 3</p>
                                    </div>
                                </div>
                            </li>
                            <li class="room" id="">
                                <span class="pending"></span>
                                <div class="media">
                                    <div class="media-left">
                                        <img src="https://via.placeholder.com/150" alt="" class="media-object">
                                    </div>
                                    <div class="media-body">
                                        <p class="name">Room 4</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                  <div class="col-md-7">
                      <div class="card">
                        <div class="card-header"> Live Chat Room {{ $roomName }}</div>
                        <chatbox user-id='{{ $userId }}' room-id='{{ $roomId }}' :initial-messages='@json($messages)'> </chatbox>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </body>
  </html>
